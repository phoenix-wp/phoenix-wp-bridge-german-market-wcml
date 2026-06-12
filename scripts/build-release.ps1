# Build a distributable ZIP for GitHub Release / wordpress.org trunk.
# Usage: .\scripts\build-release.ps1 [-Version 1.0.0]

param(
	[string]$Version = ''
)

$ErrorActionPreference = 'Stop'
$root = Split-Path -Parent $PSScriptRoot
$pluginSlug = 'phoenix-wp-bridge-german-market-wcml'

if ($Version -eq '') {
	$mainFile = Join-Path $root "$pluginSlug.php"
	$content = Get-Content $mainFile -Raw
	if ($content -match "Version:\s*([0-9.]+)") {
		$Version = $Matches[1]
	} else {
		throw "Could not detect plugin version in $mainFile"
	}
}

$distDir = Join-Path $root 'dist'
$stageDir = Join-Path $distDir $pluginSlug
$zipPath = Join-Path $distDir "$pluginSlug-$Version.zip"

if (Test-Path $distDir) {
	Remove-Item -Recurse -Force $distDir
}
New-Item -ItemType Directory -Path $stageDir -Force | Out-Null

Get-ChildItem -Path $root -Force | Where-Object {
	$name = $_.Name
	$name -notin @('.git', '.github', 'dist', 'scripts', 'wp-org-assets', 'composer.lock', 'composer.phar', 'vendor', '.DS_Store', 'Thumbs.db')
} | ForEach-Object {
	Copy-Item -Path $_.FullName -Destination $stageDir -Recurse -Force
}

if (Test-Path $zipPath) {
	Remove-Item -Force $zipPath
}

Push-Location $distDir
try {
	tar -a -c -f "$pluginSlug-$Version.zip" $pluginSlug
} finally {
	Pop-Location
}

Write-Host "Built $zipPath"
