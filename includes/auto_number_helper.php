<?php
function member_id($param='M') {
    $dataMax = mysqli_fetch_assoc(mysqli_query("SELECT SUBSTR(MAX(cs_id),-4) AS Mid FROM calon_siswa"));
    if($dataMax['Mid']=='') { // bila data kosong
        $Daftar = $param."0001";
    }else {
        $MaksDaftar = $dataMax['Mid'];
        $MaksDaftar++;
        if($MaksDaftar < 10){ $Daftar = $param."000".$MaksDaftar;} // nilai kurang dari 10
        else if($MaksDaftar < 100){ $Daftar = $param."00".$MaksDaftar;} // nilai kurang dari 100
        else if($MaksDaftar < 1000){ $Daftar = $param."0".$MaksDaftar;} // nilai kurang dari 1000
        else {$Daftar = $MaksDaftar;} // lebih dari 1000
    }
    return $Daftar;
}
		
function register_id($param='R') {
    $dataMax = mysqli_fetch_assoc(mysqli_query("SELECT SUBSTR(MAX(reg_id),-3) AS key FROM registrasi"));
    if($dataMax['key']=='') { // bila data kosong
        $Output = $param.date("y").date("m")."001";
    }else {
        $MaksOrder = $dataMax['Oid'];
        $MaksOrder++;
        if($MaksOrder < 10){ $Output = $param.date("y").date("m")."00".$MaksOrder;} // nilai kurang dari 10
        else if($MaksOrder < 10){ $Output = $param.date("y").date("m")."0".$MaksOrder;} // nilai kurang dari 10
        else if($MaksOrder < 100){ $Output = $param.date("y").date("m").$MaksOrder;} // nilai kurang dari 100
        else {$Output = $MaksOrder;} // lebih dari 100
    }
    return $Output;
}
?>