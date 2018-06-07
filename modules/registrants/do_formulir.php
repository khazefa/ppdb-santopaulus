<?php
if (empty($_SESSION['isSession'])){
    $url = $baseurl.'?page=enroll';
    echo "<script type='text/javascript'>alert('Harap login terlebih dahulu!');window.location.href = '".$url."';</script>";
    exit();
}else{    
    $furl = isset($_POST["furl"]) ? filter_var($_POST['furl'], FILTER_SANITIZE_STRING) : null;
    
    if(isset($_POST["download"])){
        $zipname = UPLOADS_DIR . "docs". DIRECTORY_SEPARATOR ."berkas_pendaftaran.zip";

//        if (file_exists($filename)) {
//            header('Content-Type: application/zip');
//            header('Content-Disposition: attachment; filename="'.basename($filename).'"');
//            header('Content-Length: ' . filesize($filename));
//
//            flush();
//            readfile($filename);
//        }
        
//        if (headers_sent()) {
//            echo "HTTP header already sent";
//        } else {
//            if (!is_file($filename)) {
//                header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found");
//                echo "File not found";
//            } else if (!is_readable($filename)) {
//                header($_SERVER['SERVER_PROTOCOL'] . " 403 Forbidden");
//                echo "File not readable";
//            } else {
//                header($_SERVER['SERVER_PROTOCOL'] . " 200 OK");
//                header("Content-Type: application/zip");
//                header("Content-Length: " . filesize($filename));
//                header("Content-Disposition: attachment; filename=" . basename($filename));
//                header("Pragma: no-cache"); 
//                $handle = fopen($filename, "rb");
//                fpassthru($handle);
//                fclose($handle);
//            }
//        }

        //download file from temporary file on server as '$filename.zip'
        if (file_exists($zipname)) {

            header('Content-Type: application/zip');
            header("Content-Length: " . filesize($zipname));
            header("Content-Disposition: attachment; filename=" . basename($zipname));
            header("Pragma: no-cache"); 
            $handle = fopen($zipname, "rb");
            fpassthru($handle);
            fclose($handle);
        } else {
            exit("Could not find Zip file to download");
        }
        
//        $url = $baseurl.'?page=upload-berkas';
//        echo "<script type='text/javascript'>window.location.href = '".$url."';</script>";
//        exit();
    }
}
?>