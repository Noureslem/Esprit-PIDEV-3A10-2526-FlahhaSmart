$keyLine = Get-Content .env.local | Where-Object { $_ -match ''^GEMINI_API_KEY='' } | Select-Object -First 1
if (-not $keyLine) { Write-Output ''GEMINI_API_KEY line not found in .env.local''; exit 1 }
$key = ($keyLine -replace ''^GEMINI_API_KEY='','''').Trim().Trim(''"'')

$endpointLine = Get-Content .env | Where-Object { $_ -match ''^GEMINI_API_ENDPOINT='' } | Select-Object -First 1
if (-not $endpointLine) { Write-Output ''GEMINI_API_ENDPOINT line not found in .env''; exit 1 }
$endpoint = ($endpointLine -replace ''^GEMINI_API_ENDPOINT='','''').Trim().Trim(''"'')

$url = "$endpoint?key=$key"

$payload = @{
  contents = @(
    @{ parts = @(
        @{ text = ''Comment irriguer les tomates en serre ?'' }
      )
    }
  )
  systemInstruction = @{ parts = @(@{ text = ''You are an expert agricultural assistant.'' }) }
  generationConfig = @{ temperature = 0.7; topP = 0.95; topK = 64; maxOutputTokens = 128 }
}

$body = $payload | ConvertTo-Json -Depth 20

try {
  $resp = Invoke-WebRequest -Method Post -Uri $url -ContentType ''application/json'' -Body $body -TimeoutSec 30
  "HTTP_STATUS=$($resp.StatusCode)"
  $content = $resp.Content
  if ($null -eq $content) { $content = '' }
  if ($content.Length -gt 600) { $content = $content.Substring(0,600) }
  "BODY_EXCERPT=$content"
} catch {
  $status = $null
  if ($_.Exception.Response -and $_.Exception.Response.StatusCode) { $status = [int]$_.Exception.Response.StatusCode }
  if (-not $status -and $_.Exception.Status) { $status = $_.Exception.Status }
  "HTTP_STATUS=$status"
  if ($_.ErrorDetails -and $_.ErrorDetails.Message) {
    $msg = $_.ErrorDetails.Message
    if ($msg.Length -gt 800) { $msg = $msg.Substring(0,800) }
    "ERROR_BODY_EXCERPT=$msg"
  } else {
    "ERROR_TYPE=$($_.Exception.GetType().FullName)"
  }
}
