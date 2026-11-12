[xml]$doc = Get-Content 'C:\proyectos\sistema-tescha\docx_extracted\word\document.xml' -Encoding UTF8

$ns = New-Object System.Xml.XmlNamespaceManager($doc.NameTable)
$ns.AddNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main')

$body = $doc.SelectSingleNode('//w:body', $ns)

function Get-TextFromNode($node) {
    $text = ""
    foreach ($child in $node.ChildNodes) {
        if ($child.LocalName -eq 't') {
            $text += $child.InnerText
        }
        elseif ($child.LocalName -eq 'tab') {
            $text += "`t"
        }
        elseif ($child.LocalName -eq 'br') {
            $text += "`n"
        }
        elseif ($child.LocalName -eq 'p') {
            $text += "`n" + (Get-TextFromNode $child)
        }
        elseif ($child.LocalName -eq 'tbl') {
            $text += "`n[TABLA]`n"
            foreach ($row in $child.SelectNodes('.//w:tr', $ns)) {
                $cells = @()
                foreach ($cell in $row.SelectNodes('./w:tc', $ns)) {
                    $cellText = ""
                    foreach ($p in $cell.SelectNodes('.//w:p', $ns)) {
                        $cellText += (Get-TextFromNode $p) + " "
                    }
                    $cells += $cellText.Trim()
                }
                $text += ($cells -join ' | ') + "`n"
            }
            $text += "[/TABLA]`n"
        }
        else {
            $text += (Get-TextFromNode $child)
        }
    }
    return $text
}

$fullText = Get-TextFromNode $body
$fullText | Out-File 'C:\proyectos\sistema-tescha\document_text.txt' -Encoding UTF8
Write-Output "Texto extraído guardado en document_text.txt"
Write-Output "Longitud: $($fullText.Length) caracteres"
