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
    if ($getpage == "ppdb-config" AND $getact == "save"){
        $fpredate = isset($_POST["fpredate"]) ? filter_var($_POST['fpredate'], FILTER_SANITIZE_STRING) : null;
        $fpostdate = isset($_POST["fpostdate"]) ? filter_var($_POST['fpostdate'], FILTER_SANITIZE_STRING) : null;
        $fquota = isset($_POST["fquota"]) ? filter_var($_POST['fquota'], FILTER_SANITIZE_NUMBER_INT) : null;
        
        $qpredate = formatDatepickerToMySql($fpredate);
        $qpostdate = formatDatepickerToMySql($fpostdate);
        
        $arrValue = array(
            'setup_date_pre' => $qpredate,
            'setup_date_post' => $qpostdate,
            'setup_quota' => $fquota
        );
        $add_query = $database->insert( 'ppdb_setup', $arrValue );
        if( $add_query )
        {
            header('location:../../?page='.$getpage);
        }
    }
    // Update data
    elseif ($getpage == "ppdb-config" AND $getact == "update"){
        $fid = isset($_POST["fid"]) ? filter_var($_POST['fid'], FILTER_SANITIZE_NUMBER_INT) : 1;
        $fpredate = isset($_POST["fpredate"]) ? filter_var($_POST['fpredate'], FILTER_SANITIZE_STRING) : null;
        $fpostdate = isset($_POST["fpostdate"]) ? filter_var($_POST['fpostdate'], FILTER_SANITIZE_STRING) : null;
        $fquota = isset($_POST["fquota"]) ? filter_var($_POST['fquota'], FILTER_SANITIZE_NUMBER_INT) : null;
        
        $qpredate = formatDatepickerToMySql($fpredate);
        $qpostdate = formatDatepickerToMySql($fpostdate);
        
        $update = array(
            'setup_date_pre' => $qpredate,
            'setup_date_post' => $qpostdate,
            'setup_quota' => $fquota
        );
        //Add the WHERE clauses
        $where_clause = array(
            'setup_id' => $fid
        );
        $updated = $database->update( 'ppdb_setup', $update, $where_clause, 1 );
        if( $updated )
        {
            header('location:../../?page='.$getpage);
        }
    }

}
?>