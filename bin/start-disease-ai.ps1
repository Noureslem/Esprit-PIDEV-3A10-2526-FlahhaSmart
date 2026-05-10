Param(
    [int]$Port = 8010,
    [switch]$Reload
)

$ErrorActionPreference = 'Stop'

$projectRoot = Split-Path -Parent $PSScriptRoot
$serviceDir = Join-Path $projectRoot 'microservices\plant_disease_ai'

if (-not (Test-Path $serviceDir)) {
    throw "Microservice directory not found: $serviceDir"
}

function Get-Python312 {
    $list = py -0p 2>$null
    if ($LASTEXITCODE -ne 0) {
        $list = @()
    }

    foreach ($line in $list) {
        if ($line -match '^-V:3\.12\b') {
            return @('py', '-3.12')
        }
    }

    $direct = Join-Path $env:LocalAppData 'Programs\Python\Python312\python.exe'
    if (Test-Path $direct) {
        return ,$direct
    }

    return $null
}

$pyCmd = @(Get-Python312)
if (-not $pyCmd) {
    Write-Host 'Python 3.12 not found. Installing via winget...' -ForegroundColor Yellow
    winget install -e --id Python.Python.3.12 --source winget
    $pyCmd = @(Get-Python312)
    if (-not $pyCmd) {
        throw 'Python 3.12 installation failed or not detected. Please restart your terminal and re-run this script.'
    }
}

Push-Location $serviceDir

try {
    if (Test-Path '.venv') {
        $existing = Join-Path (Get-Location) '.venv\Scripts\python.exe'
        if (-not (Test-Path $existing)) {
            Remove-Item -Recurse -Force '.venv'
        }
    }

    if (-not (Test-Path '.venv')) {
        Write-Host 'Creating venv (.venv)...'
        if ($pyCmd.Count -ge 2) {
            & $pyCmd[0] $pyCmd[1] -m venv .venv
        } else {
            & $pyCmd[0] -m venv .venv
        }
    }

    $venvPy = Join-Path (Get-Location) '.venv\Scripts\python.exe'

    Write-Host 'Upgrading pip...'
    & $venvPy -m pip install --upgrade pip

    Write-Host 'Installing dependencies (this can take a while the first time)...'
    & $venvPy -m pip install -r requirements.txt

    $env:DEVICE = 'cpu'
    $env:TOP_K = '3'
    $env:ENABLE_FALLBACK_MODEL = 'true'
    $env:REQUIRE_MODEL = 'false'

    $args = @('app.main:app', '--host', '127.0.0.1', '--port', "$Port")
    if ($Reload.IsPresent) {
        $args += '--reload'
    }

    Write-Host "Starting Disease AI microservice on http://127.0.0.1:$Port ..." -ForegroundColor Green
    & $venvPy -m uvicorn @args
}
finally {
    Pop-Location
}
