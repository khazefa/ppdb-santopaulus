<?php
session_start();
$isLoggedIn = $_SESSION['isLoggedin'];

if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
    header('HTTP/1.1 403 Forbidden.', TRUE, 403);
    echo 'You dont have permissions to access this page! <a href="javascript:history.back()">Back</a>';
    exit(1); // EXIT_ERROR
}else{
    require("../../../includes/constants.php");
    require("../../../includes/common_helper.php");
    require_once("../../../includes/class.db.php");
    $database = DB::getInstance();

    $getpage = htmlspecialchars($_GET["page"], ENT_QUOTES, 'UTF-8');
    $getact = htmlspecialchars($_GET["act"], ENT_QUOTES, 'UTF-8');

    // Save data
    if ($getpage == "list-agenda" AND $getact == "save"){
        $ftitle = isset($_POST["ftitle"]) ? filter_var($_POST['ftitle'], FILTER_SANITIZE_STRING) : null;
        $fpredate = isset($_POST["fpredate"]) ? filter_var($_POST['fpredate'], FILTER_SANITIZE_STRING) : null;
        $fpostdate = isset($_POST["fpostdate"]) ? filter_var($_POST['fpostdate'], FILTER_SANITIZE_STRING) : null;
        $fjam = isset($_POST["fjam"]) ? filter_var($_POST['fjam'], FILTER_SANITIZE_STRING) : null;
        $fkonten = isset($_POST["fkonten"]) ? filter_var($_POST['fkonten'], FILTER_SANITIZE_STRING) : null;
        
        $qpredate = formatDatepickerToMySql($fpredate);
        $qpostdate = formatDatepickerToMySql($fpostdate);
        $curdate = date("Y-m-d");
        
        $arrValue = array(
            'ag_tgl_posting' => $curdate,
            'ag_judul' => $ftitle,
            'ag_tgl_mulai' => $qpredate,
            'ag_tgl_selesai' => $qpostdate,
            'ag_jam' => $fjam,
            'ag_konten' => $fkonten,
            'ag_tipe' => "agenda",
            'ag_publish' => "Y"
        );
        $add_query = $database->insert( 'agenda', $arrValue );
        if( $add_query )
        {
            header('location:../../?page='.$getpage);
        }
    }
    // Update data
    elseif ($getpage == "list-agenda" AND $getact == "update"){
        $fid = isset($_POST["fid"]) ? filter_var($_POST['fid'], FILTER_SANITIZE_NUMBER_INT) : 0;
        $ftitle = isset($_POST["ftitle"]) ? filter_var($_POST['ftitle'], FILTER_SANITIZE_STRING) : null;
        $fpredate = isset($_POST["fpredate"]) ? filter_var($_POST['fpredate'], FILTER_SANITIZE_STRING) : null;
        $fpostdate = isset($_POST["fpostdate"]) ? filter_var($_POST['fpostdate'], FILTER_SANITIZE_STRING) : null;
        $fjam = isset($_POST["fjam"]) ? filter_var($_POST['fjam'], FILTER_SANITIZE_STRING) : null;
        $fkonten = isset($_POST["fkonten"]) ? filter_var($_POST['fkonten'], FILTER_SANITIZE_STRING) : null;
        $fpublish = isset($_POST["fpublish"]) ? filter_var($_POST['fpublish'], FILTER_SANITIZE_STRING) : null;
        
        $qpredate = formatDatepickerToMySql($fpredate);
        $qpostdate = formatDatepickerToMySql($fpostdate);
        
        $update = array(
            'ag_judul' => $ftitle,
            'ag_tgl_mulai' => $qpredate,
            'ag_tgl_selesai' => $qpostdate,
            'ag_jam' => $fjam,
            'ag_konten' => $fkonten,
            'ag_publish' => $fpublish
        );
        //Add the WHERE clauses
        $where_clause = array(
            'ag_id' => $fid
        );
        $updated = $database->update( 'agenda', $update, $where_clause, 1 );
        if( $updated )
        {
            header('location:../../?page='.$getpage);
        }
    }

}
?>