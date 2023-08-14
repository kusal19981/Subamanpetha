<?php
if (!empty($_GET['file'])) {
    $Filename  = basename($_GET['file']);
    $upload_to  = "uploads/" . $Filename;

    if (!empty($Filename) && file_exists($upload_to)) {
        //define header
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$Filename");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");

        //read file 
        readfile($upload_to);
        exit;
    } else {
        echo "file not exit";
    }
}
