Add-Type -AssemblyName System.IO.Compression.FileSystem

# Buscar el archivo con comodín
$docxFile = Get-ChildItem 'C:\proyectos\sistema-tescha\docs\*.docx' | Where-Object { $_.Name -like '*Instrumentaci*' } | Select-Object -First 1

if (-not $docxFile) {
    Write-Output "No se encontró el archivo"
    exit 1
}

Write-Output "Archivo encontrado: $($docxFile.FullName)"
Write-Output "Nombre: $($docxFile.Name)"

$extractPath = 'C:\proyectos\sistema-tescha\docx_extracted'

if (Test-Path $extractPath) {
    Remove-Item -Recurse -Force $extractPath
}

[System.IO.Compression.ZipFile]::ExtractToDirectory($docxFile.FullName, $extractPath)

Write-Output ""
Write-Output "=== ARCHIVOS EXTRAÍDOS ==="
Get-ChildItem -Recurse $extractPath | Select-Object FullName, Length | Format-Table -AutoSize
