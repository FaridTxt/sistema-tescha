Add-Type -AssemblyName System.IO.Compression.FileSystem
$zip = [System.IO.Compression.ZipFile]::OpenRead('C:\proyectos\sistema-tescha\docs\AvancePro GPS 4701.docx')

# Extract and format document.xml
$entry = $zip.Entries | Where-Object { $_.FullName -eq 'word/document.xml' }
$reader = New-Object System.IO.StreamReader($entry.Open())
$content = $reader.ReadToEnd()
$reader.Close()

$xml = [xml]$content
$xml.Save('C:\proyectos\sistema-tescha\docs\document_formatted.xml')

# Extract and format header1.xml
$entry = $zip.Entries | Where-Object { $_.FullName -eq 'word/header1.xml' }
$reader = New-Object System.IO.StreamReader($entry.Open())
$content = $reader.ReadToEnd()
$reader.Close()

$xml = [xml]$content
$xml.Save('C:\proyectos\sistema-tescha\docs\header1_formatted.xml')

# Extract and format footer1.xml
$entry = $zip.Entries | Where-Object { $_.FullName -eq 'word/footer1.xml' }
$reader = New-Object System.IO.StreamReader($entry.Open())
$content = $reader.ReadToEnd()
$reader.Close()

$xml = [xml]$content
$xml.Save('C:\proyectos\sistema-tescha\docs\footer1_formatted.xml')

$zip.Dispose()
Write-Output "Done"
