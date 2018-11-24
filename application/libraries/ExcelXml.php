<?php

class ExcelXML
{

    private $header = "<?xml version=\"1.0\" encoding=\"UTF-8\"?\>
<Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\"
 xmlns:x=\"urn:schemas-microsoft-com:office:excel\"
 xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\"
 xmlns:html=\"http://www.w3.org/TR/REC-html40\">";


    private $footer = "</Workbook>";

    private $lines = array ();

    private $worksheet_title = "Table1";

    private function addRow ($array)
    {

        $cells = "";

        foreach ($array as $k => $v):

//            $cells .= "<Cell><Data ss:Type=\"String\">" . utf8_encode($v) . "</Data></Cell>\n"; 
			$cells .= "<Cell><Data ss:Type=\"String\">" . ($v) . "</Data></Cell>\n"; 

        endforeach;

        $this->lines[] = "<Row>\n" . $cells . "</Row>\n";

    }


    public function addArray ($array)
    {
        foreach ($array as $k => $v):
            $this->addRow ($v);
        endforeach;

    }

    public function setWorksheetTitle ($title)
    {

        $title = preg_replace ("/[\\\|:|\/|\?|\*|\[|\]]/", "", $title);

        $title = substr ($title, 0, 31);

        $this->worksheet_title = $title;

    }

    function generateXML ($filename)
    {

        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: inline; filename=\"" . $filename . ".xls\"");

        echo stripslashes ($this->header);
        echo "\n<Worksheet ss:Name=\"" . $this->worksheet_title . "\">\n<Table>\n";
        echo "<Column ss:Index=\"1\" ss:AutoFitWidth=\"0\" ss:Width=\"110\"/>\n";
        echo implode ("\n", $this->lines);
        echo "</Table>\n</Worksheet>\n";
        echo $this->footer;

    }

}

?>