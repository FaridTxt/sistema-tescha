[xml]$doc = Get-Content 'C:\proyectos\sistema-tescha\docs\document_formatted.xml' -Encoding UTF8

$ns = New-Object System.Xml.XmlNamespaceManager($doc.NameTable)
$ns.AddNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main')

$paragraphs = $doc.SelectNodes('//w:p', $ns)
$output = @()

foreach ($p in $paragraphs) {
    $texts = $p.SelectNodes('.//w:t', $ns)
    $line = ($texts | ForEach-Object { $_.InnerText }) -join ''
    $style = $p.SelectSingleNode('./w:pPr/w:pStyle', $ns)
    $styleName = if ($style) { $style.GetAttribute('val', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main') } else { 'Normal' }
    
    # Check if it's in a table
    $inTable = $p.SelectSingleNode('ancestor::w:tbl', $ns) -ne $null
    
    if ($line.Trim() -or $styleName -ne 'Normal') {
        $prefix = if ($inTable) { '[TABLE] ' } else { '' }
        $output += "$prefix[$styleName] $line"
    }
}

$output | Out-File 'C:\proyectos\sistema-tescha\docs\document_text.txt' -Encoding UTF8
Write-Output "Extracted $($output.Count) lines"
