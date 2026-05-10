Param(
    [int]$Port = 8010
)

$ErrorActionPreference = 'Stop'

$projectRoot = Split-Path -Parent $PSScriptRoot

function Test-Url {
    Param(
        [Parameter(Mandatory=$true)][string]$Url,
        [int]$TimeoutSeconds = 2,
        [int]$Retries = 3,
        [int]$RetryDelayMs = 250
    )

    for ($attempt = 1; $attempt -le $Retries; $attempt++) {
        if (Get-Command curl.exe -ErrorAction SilentlyContinue) {
            try {
                $null = curl.exe -fsS --max-time $TimeoutSeconds $Url 2>$null
                if ($LASTEXITCODE -eq 0) {
                    return $true
                }
            } catch {
                # keep trying
            }
        } else {
            try {
                Invoke-WebRequest -Uri $Url -Method Get -TimeoutSec $TimeoutSeconds -UseBasicParsing | Out-Null
                return $true
            } catch {
                # keep trying
            }
        }

        if ($attempt -lt $Retries -and $RetryDelayMs -gt 0) {
            Start-Sleep -Milliseconds $RetryDelayMs
        }
    }

    return $false
}

$aiHealth = "http://127.0.0.1:$Port/health"

if (Test-Url -Url $aiHealth) {
    Write-Host "[ensure-disease-ai] Disease AI already running ($aiHealth)." -ForegroundColor Green
    exit 0
}

$aiLogDir = Join-Path $projectRoot 'var\log'
$aiStdoutLog = Join-Path $aiLogDir 'disease-ai-dev.log'
$aiStderrLog = Join-Path $aiLogDir 'disease-ai-dev.error.log'

if (-not (Test-Path $aiLogDir)) {
    New-Item -ItemType Directory -Force -Path $aiLogDir | Out-Null
}

Write-Host "[ensure-disease-ai] Starting Disease AI microservice..." -ForegroundColor Yellow
Write-Host "[ensure-disease-ai] Logs: $aiStdoutLog (stderr: $aiStderrLog)" -ForegroundColor DarkGray

$aiArgs = @(
    '-NoProfile',
    '-ExecutionPolicy', 'Bypass',
    '-File', (Join-Path $projectRoot 'bin\start-disease-ai.ps1'),
    '-Port', $Port
)

Start-Process -FilePath 'powershell' -ArgumentList $aiArgs -WorkingDirectory $projectRoot -RedirectStandardOutput $aiStdoutLog -RedirectStandardError $aiStderrLog | Out-Null

Write-Host "[ensure-disease-ai] Disease AI start requested on port $Port." -ForegroundColor Cyan
exit 0
