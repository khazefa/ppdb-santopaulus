<?php
$ts = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: $ts");
header("Last-Modified: $ts");
header("Pragma: no-cache");
header("Cache-Control: no-cache, must-revalidate");

if (empty($_SESSION['isSession'])){
    $url = $baseurl.'?page=enroll';
    echo "<script type='text/javascript'>alert('Harap login terlebih dahulu!');window.location.href = '".$url."';</script>";
    exit();
}else{
    $fname = isset($_POST["fname"]) ? filter_var($_POST['fname'], FILTER_SANITIZE_STRING) : null;
    $fjkel = isset($_POST["fjkel"]) ? filter_var($_POST['fjkel'], FILTER_SANITIZE_STRING) : "L";
    $fnisn = isset($_POST["fnisn"]) ? filter_var($_POST['fnisn'], FILTER_SANITIZE_STRING) : null;
    $fnis = isset($_POST["fnis"]) ? filter_var($_POST['fnis'], FILTER_SANITIZE_STRING) : null;
    $ftempat = isset($_POST["ftempat"]) ? filter_var($_POST['ftempat'], FILTER_SANITIZE_STRING) : null;
    $ftgl = isset($_POST["ftgl"]) ? filter_var($_POST['ftgl'], FILTER_SANITIZE_STRING) : "1900-01-01";
    $fagama = isset($_POST["fagama"]) ? filter_var($_POST['fagama'], FILTER_SANITIZE_STRING) : "Katholik";
    $fagama = isset($_POST["fagama"]) ? filter_var($_POST['fagama'], FILTER_SANITIZE_STRING) : "Katholik";
    $femail = isset($_POST["remail"]) ? filter_var($_POST['remail'], FILTER_SANITIZE_EMAIL) : null;
    //$funiqid = strtoupper(generateRandomString(6));
    /**
     * Checking to see if a value exists
     */
    $check_column = 'user_email';
    $check_for = array( 'user_email' => $femail );
    $exists = $database->exists( 'users', $check_column,  $check_for );
    if( $exists )
    {
        $url = $baseurl.'?page=enroll';
        echo "<script type='text/javascript'>alert('Alamat email sudah ada!');window.location.href = '".$url."';</script>";
        exit();
    }else{
        $arrValue = array(
            'user_keyname' => $femail,
            'user_keypass' => $fpass,
            'user_fullname' => $fname,
            'user_email' => $femail,
            'role_id' => 3,
            'user_status' => 1
        );

        $add_query = $database->insert( 'users', $arrValue );
        if( $add_query )
        {
            $url = $baseurl.'?page=enroll';
            echo "<script type='text/javascript'>alert('Registrasi sukses!');window.location.href = '".$url."';</script>";
            exit();
        }
    }
}
?>