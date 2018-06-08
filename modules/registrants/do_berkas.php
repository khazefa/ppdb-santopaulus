<?php
if (empty($_SESSION['isSession'])){
    $url = $baseurl.'?page=enroll';
    echo "<script type='text/javascript'>alert('Harap login terlebih dahulu!');window.location.href = '".$url."';</script>";
    exit();
}else{    
    $furl = isset($_POST["furl"]) ? filter_var($_POST['furl'], FILTER_SANITIZE_STRING) : null;
    
    $random = rand(000000,999999);
    $fnisn = $_SESSION['vcUid'];
    $query = "SELECT reg_id FROM registrasi WHERE cs_nisn = '$fnisn'";
    if( $database->num_rows( $query ) > 0 )
    {
        list( $regid ) = $database->get_row( $query );
    }
    $fupload = $_FILES['fupload'];
    
    $arrValue = array();

    if(empty($fupload['tmp_name'])){
        $arrValue = array(
            'cs_nisn' => $fnisn,
            'berkas_status' => 1
        );
    }else{
        uploadDoc($fupload, $regid."_", "confi_docs");
        $arrValue = array(
            'cs_nisn' => $fnisn,
            'berkas_file' => $regid."_".$fupload['name'],
            'berkas_status' => 1
        );
    }

    $add_query = $database->insert( 'berkas_docs', $arrValue );
    if( $add_query )
    {
        $url = $baseurl;
        echo "<script type='text/javascript'>alert('Upload berkas sukses!');window.location.href = '".$url."';</script>";
        exit();
    }
}
?>