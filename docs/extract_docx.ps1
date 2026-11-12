Add-Type -AssemblyName System.IO.Compression.FileSystem
$zip = [System.IO.Compression.ZipFile]::OpenRead('C:\proyectos\sistema-tescha\docs\AvancePro GPS 4701.docx')

# Extract document.xml
$entry = $zip.Entries | Where-Object { $_.FullName -eq 'word/document.xml' }
$reader = New-Object System.IO.StreamReader($entry.Open())
$content = $reader.ReadToEnd()
$reader.Close()
$content | Out-File -FilePath 'C:\proyectos\sistema-tescha\docs\document_raw.xml' -Encoding UTF8

# Extract header1.xml
$entry = $zip.Entries | Where-Object { $_.FullName -eq 'word/header1.xml' }
$reader = New-Object System.IO.StreamReader($entry.Open())
$content = $reader.ReadToEnd()
$reader.Close()
$content | Out-File -FilePath 'C:\proyectos\sistema-tescha\docs\header1_raw.xml' -Encoding UTF8

# Extract footer1.xml
$entry = $zip.Entries | Where-Object { $_.FullName -eq 'word/footer1.xml' }
$reader = New-Object System.IO.StreamReader($entry.Open())
$content = $reader.ReadToEnd()
$reader.Close()
$content | Out-File -FilePath 'C:\proyectos\sistema-tescha\docs\footer1_raw.xml' -Encoding UTF8

# Extract footnotes.xml
$entry = $zip.Entries | Where-Object { $_.FullName -eq 'word/footnotes.xml' }
$reader = New-Object System.IO.StreamReader($entry.Open())
$content = $reader.ReadToEnd()
$reader.Close()
$content | Out-File -FilePath 'C:\proyectos\sistema-tescha\docs\footnotes_raw.xml' -Encoding UTF8

# Extract endnotes.xml
$entry = $zip.Entries | Where-Object { $_.FullName -eq 'word/endnotes.xml' }
$reader = New-Object System.IO.StreamReader($entry.Open())
$content = $reader.ReadToEnd()
$reader.Close()
$content | Out-File -FilePath 'C:\proyectos\sistema-tescha\docs\endnotes_raw.xml' -Encoding UTF8

$zip.Dispose()
Write-Output "Done"
