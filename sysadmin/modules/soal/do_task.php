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
    if ($getpage == "list-soal" AND $getact == "save"){
        $fquestion = isset($_POST["fquestion"]) ? filter_var($_POST['fquestion'], FILTER_SANITIZE_STRING) : null;
        $fopsi1 = isset($_POST["fopsi1"]) ? filter_var($_POST['fopsi1'], FILTER_SANITIZE_STRING) : null;
        $fopsi2 = isset($_POST["fopsi2"]) ? filter_var($_POST['fopsi2'], FILTER_SANITIZE_STRING) : null;
        $fopsi3 = isset($_POST["fopsi3"]) ? filter_var($_POST['fopsi3'], FILTER_SANITIZE_STRING) : null;
        $fopsi4 = isset($_POST["fopsi4"]) ? filter_var($_POST['fopsi4'], FILTER_SANITIZE_STRING) : null;
        $fanswer = isset($_POST["fanswer"]) ? filter_var($_POST['fanswer'], FILTER_SANITIZE_STRING) : null;
        
        $arrOpsi = array($fopsi1,$fopsi2,$fopsi3,$fopsi4);
        $fopsi = implode(";", $arrOpsi);
        
        $arrValue = array(
            'bs_pertanyaan' => $fquestion,
            'bs_opsi_jawaban' => $fopsi,
            'bs_jawaban' => $fanswer,
            'bs_publish' => 'Y'
        );
        $add_query = $database->insert( 'bank_soal', $arrValue );
        if( $add_query )
        {
            header('location:../../?page='.$getpage);
        }
    }
    // Update data
    elseif ($getpage == "list-soal" AND $getact == "update"){
        $fid = isset($_POST["fid"]) ? filter_var($_POST['fid'], FILTER_SANITIZE_NUMBER_INT) : 0;
        $fquestion = isset($_POST["fquestion"]) ? filter_var($_POST['fquestion'], FILTER_SANITIZE_STRING) : null;
        $fopsi1 = isset($_POST["fopsi1"]) ? filter_var($_POST['fopsi1'], FILTER_SANITIZE_STRING) : null;
        $fopsi2 = isset($_POST["fopsi2"]) ? filter_var($_POST['fopsi2'], FILTER_SANITIZE_STRING) : null;
        $fopsi3 = isset($_POST["fopsi3"]) ? filter_var($_POST['fopsi3'], FILTER_SANITIZE_STRING) : null;
        $fopsi4 = isset($_POST["fopsi4"]) ? filter_var($_POST['fopsi4'], FILTER_SANITIZE_STRING) : null;
        $fanswer = isset($_POST["fanswer"]) ? filter_var($_POST['fanswer'], FILTER_SANITIZE_STRING) : null;
        $fpublish = isset($_POST["fpublish"]) ? filter_var($_POST['fpublish'], FILTER_SANITIZE_STRING) : null;
        
        $arrOpsi = array($fopsi1,$fopsi2,$fopsi3,$fopsi4);
        $fopsi = implode(";", $arrOpsi);
        
        $update = array(
            'bs_pertanyaan' => $fquestion,
            'bs_opsi_jawaban' => $fopsi,
            'bs_jawaban' => $fanswer,
            'bs_publish' => $fpublish
        );
        //Add the WHERE clauses
        $where_clause = array(
            'bs_id' => $fid
        );
        $updated = $database->update( 'bank_soal', $update, $where_clause, 1 );
        if( $updated )
        {
            header('location:../../?page='.$getpage);
        }
    }
    // Delete data
    elseif ($getpage == "list-soal" AND $getact == "delete"){
        $key = htmlspecialchars($_GET["key"], ENT_QUOTES, 'UTF-8');
        $where_clause = array(
            'bs_id' => $key
        );
        //Query delete
        $deleted = $database->delete( 'bank_soal', $where_clause);
        if( $deleted )
        {
            header('location:../../?page='.$getpage);
        }
    }
}
?>