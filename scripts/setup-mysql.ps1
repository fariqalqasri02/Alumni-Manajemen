$mysql = "C:\xampp\mysql\bin\mysql.exe"

if (-not (Test-Path $mysql)) {
    Write-Error "mysql.exe tidak ditemukan di $mysql"
    exit 1
}

& $PSScriptRoot\start-mysql.ps1
& $mysql -u root -e "CREATE DATABASE IF NOT EXISTS portal_alumni CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

Write-Output "Database portal_alumni siap digunakan."
