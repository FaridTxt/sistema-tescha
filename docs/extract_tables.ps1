[xml]$doc = Get-Content 'C:\proyectos\sistema-tescha\docs\document_formatted.xml' -Encoding UTF8

$ns = New-Object System.Xml.XmlNamespaceManager($doc.NameTable)
$ns.AddNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main')

$tables = $doc.SelectNodes('//w:tbl', $ns)
$tableNum = 0
$output = @()

foreach ($tbl in $tables) {
    $tableNum++
    $output += "=== TABLA $tableNum ==="
    
    $rows = $tbl.SelectNodes('./w:tr', $ns)
    $rowNum = 0
    
    foreach ($row in $rows) {
        $rowNum++
        $cells = $row.SelectNodes('./w:tc', $ns)
        $cellNum = 0
        $rowData = @()
        
        foreach ($cell in $cells) {
            $cellNum++
            $texts = $cell.SelectNodes('.//w:t', $ns)
            $cellText = ($texts | ForEach-Object { $_.InnerText }) -join ' '
            $rowData += "C$cellNum`: $cellText"
        }
        
        $output += "  Fila ${rowNum}: $($rowData -join ' | ')"
    }
    
    $output += ""
}

$output | Out-File 'C:\proyectos\sistema-tescha\docs\tables_structure.txt' -Encoding UTF8
Write-Output "Extracted $tableNum tables"
