$mysqlBin = "C:\xampp\mysql\bin"
$mysqld = Join-Path $mysqlBin "mysqld.exe"
$defaults = Join-Path $mysqlBin "my.ini"

if (-not (Test-Path $mysqld)) {
    Write-Error "mysqld.exe tidak ditemukan di $mysqld"
    exit 1
}

$existing = Get-Process | Where-Object { $_.ProcessName -eq 'mysqld' } | Select-Object -First 1

if ($existing) {
    Write-Output "MySQL/MariaDB sudah berjalan dengan PID $($existing.Id)"
    exit 0
}

$process = Start-Process -FilePath $mysqld -ArgumentList "--defaults-file=$defaults","--standalone","--console" -PassThru
Start-Sleep -Seconds 3

Write-Output "MySQL/MariaDB dijalankan dengan PID $($process.Id)"
