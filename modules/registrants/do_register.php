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
    $faddress = isset($_POST["faddress"]) ? filterInput($_POST["faddress"]) : null;
    $fphone = isset($_POST["fphone"]) ? filter_var($_POST['fphone'], FILTER_SANITIZE_STRING) : null;
    $fnama_ayah = isset($_POST["fnama_ayah"]) ? filter_var($_POST['fnama_ayah'], FILTER_SANITIZE_STRING) : null;
    $fnama_ibu = isset($_POST["fnama_ibu"]) ? filter_var($_POST['fnama_ibu'], FILTER_SANITIZE_STRING) : null;
    $fnama_wali = isset($_POST["fnama_wali"]) ? filter_var($_POST['fnama_wali'], FILTER_SANITIZE_STRING) : null;
    $fasal_sekolah = isset($_POST["fasal_sekolah"]) ? filter_var($_POST['fasal_sekolah'], FILTER_SANITIZE_STRING) : null;
    $femail = isset($_POST["femail"]) ? filter_var($_POST['femail'], FILTER_SANITIZE_EMAIL) : null;
    
    $furl = isset($_POST["furl"]) ? filter_var($_POST['furl'], FILTER_SANITIZE_STRING) : null;
    $fregid = register_id();
    /**
     * Checking to see if a value exists
     */
    $check_column = 'cs_nisn';
    $check_for = array( 'cs_nisn' => $fnisn );
    $exists = $database->exists( 'calon_siswa', $check_column,  $check_for );
    if( $exists )
    {
        $url = $baseurl.'?page='.$furl;
        echo "<script type='text/javascript'>alert('NISN sudah ada dalam sistem, Anda tidak dapat mendaftar lebih dari 1 kali.');window.location.href = '".$url."';</script>";
        exit();
    }else{
        $arrValue = array(
            'cs_nisn' => $fnisn,
            'cs_nis' => $fnis,
            'cs_nama_lengkap' => $fname,
            'cs_tmpt_lahir' => $ftempat,
            'cs_tgl_lahir' => $ftgl,
            'cs_jkel' => $fjkel,
            'cs_agama' => $fagama,
            'cs_no_tlp' => $fphone,
            'cs_alamat_lengkap' => $faddress,
            'cs_nama_ayah' => $fnama_ayah,
            'cs_nama_ibu' => $fnama_ibu,
            'cs_nama_wali' => $fnama_wali,
            'cs_asal_sekolah' => $fasal_sekolah,
            'cs_email' => $femail
        );
        
        $arrValue_r = array(
            'reg_id' => $fregid,
            'reg_date' => date("Y-m-d"),
            'cs_nisn' => $fnisn,
            'reg_status' => 1
        );

        $add_query = $database->insert( 'calon_siswa', $arrValue );
        if( $add_query )
        {
            $add_query_r = $database->insert( 'registrasi', $arrValue_r );
            
            $_SESSION['vcUid'] = $fnisn;
            $url = $baseurl.'?page=download-formulir';
            echo "<script type='text/javascript'>alert('Registrasi sukses!');window.location.href = '".$url."';</script>";
            exit();
        }
    }
}
?>