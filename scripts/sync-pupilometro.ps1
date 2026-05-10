# Sincroniza o pupilômetro Next.js para o Laravel (public/pupilometro).
# Na raiz do repo: powershell -ExecutionPolicy Bypass -File scripts/sync-pupilometro.ps1
$ErrorActionPreference = "Stop"
$Root = Split-Path $PSScriptRoot -Parent
$Pup = Join-Path $Root "PUPILOMETRO"
$Out = Join-Path $Pup "out"
$Dst = Join-Path $Root "public_html\public\pupilometro"

Set-Location $Pup
if (-not (Test-Path "package.json")) { throw "Pasta PUPILOMETRO nao encontrada: $Pup" }

npm run preexport:laravel
npm run build
if (-not (Test-Path $Out)) { throw "Build falhou: pasta out/ nao existe" }

if (Test-Path $Dst) { Remove-Item $Dst -Recurse -Force }
Copy-Item $Out $Dst -Recurse -Force
Write-Host "OK: pupilometro copiado para $Dst"
