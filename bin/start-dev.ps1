Param(
    [int]$SymfonyPort = 8000,
    [int]$DiseaseAiPort = 8010,
    [switch]$SymfonyTls,
    [switch]$SymfonyNoOpen
)

$ErrorActionPreference = 'Stop'

$projectRoot = Split-Path -Parent $PSScriptRoot

function Test-Url {
    Param(
        [Parameter(Mandatory=$true)][string]$Url
    )

    try {
        $null = curl.exe -fsS $Url
        return $true
    } catch {
        return $false
    }
}

$aiHealth = "http://127.0.0.1:$DiseaseAiPort/health"
$appUrl = "http://127.0.0.1:$SymfonyPort/"

$aiLogDir = Join-Path $projectRoot 'var\log'
$aiLog = Join-Path $aiLogDir 'disease-ai-dev.log'

if (-not (Test-Path $aiLogDir)) {
    New-Item -ItemType Directory -Force -Path $aiLogDir | Out-Null
}

$aiStartedByScript = $false
$aiProcess = $null

Write-Host "[start-dev] Symfony port: $SymfonyPort" -ForegroundColor Cyan
Write-Host "[start-dev] Disease AI port: $DiseaseAiPort" -ForegroundColor Cyan

if (Test-Url -Url $aiHealth) {
    Write-Host "[start-dev] Disease AI already running ($aiHealth)." -ForegroundColor Green
} else {
    $aiStartedByScript = $true
    Write-Host "[start-dev] Starting Disease AI microservice..." -ForegroundColor Yellow
    Write-Host "[start-dev] Logs: $aiLog" -ForegroundColor DarkGray

    $aiArgs = @(
        '-ExecutionPolicy', 'Bypass',
        '-File', (Join-Path $projectRoot 'bin\start-disease-ai.ps1'),
        '-Port', $DiseaseAiPort
    )

    $aiProcess = Start-Process -FilePath 'powershell' -ArgumentList $aiArgs -WorkingDirectory $projectRoot -PassThru -RedirectStandardOutput $aiLog -RedirectStandardError $aiLog

    $deadline = (Get-Date).AddSeconds(120)
    while ((Get-Date) -lt $deadline) {
        if (Test-Url -Url $aiHealth) {
            Write-Host "[start-dev] Disease AI is healthy." -ForegroundColor Green
            break
        }
        Start-Sleep -Milliseconds 500
    }

    if (-not (Test-Url -Url $aiHealth)) {
        Write-Host "[start-dev] Disease AI did not become healthy. Check logs: $aiLog" -ForegroundColor Red
    }
}

try {
    if (Test-Url -Url $appUrl) {
        Write-Host "[start-dev] Symfony already running ($appUrl)." -ForegroundColor Green
        Write-Host "[start-dev] Nothing to start for Symfony. Exiting." -ForegroundColor DarkGray
        return
    }

    $symfonyCmd = Get-Command symfony -ErrorAction SilentlyContinue

    if ($symfonyCmd) {
        Write-Host "[start-dev] Starting Symfony via symfony CLI..." -ForegroundColor Yellow

        $args = @('serve', '--port', "$SymfonyPort")
        if (-not $SymfonyTls.IsPresent) {
            $args += '--no-tls'
        }
        if ($SymfonyNoOpen.IsPresent) {
            $args += '--no-open'
        }

        Push-Location $projectRoot
        try {
            symfony @args
        } finally {
            Pop-Location
        }
    } else {
        Write-Host "[start-dev] symfony CLI not found, falling back to php -S..." -ForegroundColor Yellow
        Push-Location $projectRoot
        try {
            php -S "127.0.0.1:$SymfonyPort" -t public
        } finally {
            Pop-Location
        }
    }
}
finally {
    if ($aiStartedByScript -and $aiProcess -and -not $aiProcess.HasExited) {
        Write-Host "[start-dev] Stopping Disease AI (pid=$($aiProcess.Id))..." -ForegroundColor Yellow
        try {
            Stop-Process -Id $aiProcess.Id -Force
        } catch {
        }
    }
}
