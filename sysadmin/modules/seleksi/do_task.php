<?php
session_start();
$isLoggedIn = $_SESSION['isLoggedin'];

if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
    header('HTTP/1.1 403 Forbidden.', TRUE, 403);
    echo 'You dont have permissions to access this page! <a href="javascript:history.back()">Back</a>';
    exit(1); // EXIT_ERROR
}else{
    require("../../../includes/constants.php");
    require_once("../../../includes/class.db.php");
    $database = DB::getInstance();

    $getpage = htmlspecialchars($_GET["page"], ENT_QUOTES, 'UTF-8');
    $getact = htmlspecialchars($_GET["act"], ENT_QUOTES, 'UTF-8');

    // Save data
    if ($getpage == "list-seleksi" AND $getact == "save"){
        $fname = isset($_POST["fname"]) ? filter_var($_POST['fname'], FILTER_SANITIZE_STRING) : null;
        $fno = isset($_POST["fno"]) ? filter_var($_POST['fno'], FILTER_SANITIZE_STRING) : null;
        
        $arrValue = array(
            'bank_acc_no' => $fno,
            'bank_acc_name' => $fname
        );
        $add_query = $database->insert( 'berkas_docs', $arrValue );
        if( $add_query )
        {
            header('location:../../?page='.$getpage);
        }
    }
    // Update data
    elseif ($getpage == "list-seleksi" AND $getact == "update_reg"){
        $fnisn = isset($_POST["fnisn"]) ? filter_var($_POST['fnisn'], FILTER_SANITIZE_STRING) : null;
        $fstatus_reg = isset($_POST["fstatus_reg"]) ? filter_var($_POST['fstatus_reg'], FILTER_SANITIZE_NUMBER_INT) : 0;
        
        if($fstatus_reg != 0){   
            $update = array(
                'reg_status' => $fstatus_reg
            );
            //Add the WHERE clauses
            $where_clause = array(
                'cs_nisn' => $fnisn
            );
            $updated = $database->update( 'registrasi', $update, $where_clause, 1 );
            if( $updated )
            {
                header('location:../../?page='.$getpage);
            }
        }else{
            header('location:../../?page='.$getpage);
        }
    }

}
?>