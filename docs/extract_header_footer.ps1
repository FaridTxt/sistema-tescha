[xml]$header = Get-Content 'C:\proyectos\sistema-tescha\docs\header1_formatted.xml' -Encoding UTF8
[xml]$footer = Get-Content 'C:\proyectos\sistema-tescha\docs\footer1_formatted.xml' -Encoding UTF8

$ns = New-Object System.Xml.XmlNamespaceManager($header.NameTable)
$ns.AddNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main')

$output = @()

# Header
$texts = $header.SelectNodes('//w:t', $ns)
$output += "=== HEADER ==="
foreach ($t in $texts) {
    if ($t.InnerText.Trim()) {
        $output += $t.InnerText
    }
}

# Footer
$ns2 = New-Object System.Xml.XmlNamespaceManager($footer.NameTable)
$ns2.AddNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main')
$texts = $footer.SelectNodes('//w:t', $ns2)
$output += ""
$output += "=== FOOTER ==="
foreach ($t in $texts) {
    if ($t.InnerText.Trim()) {
        $output += $t.InnerText
    }
}

$output | Out-File 'C:\proyectos\sistema-tescha\docs\header_footer_text.txt' -Encoding UTF8
Write-Output "Done"
