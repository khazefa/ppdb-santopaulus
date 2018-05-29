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
//    include("../../../includes/verot_upload/class.upload.php");
    $database = DB::getInstance();

    $getpage = htmlspecialchars($_GET["page"], ENT_QUOTES, 'UTF-8');
    $getact = htmlspecialchars($_GET["act"], ENT_QUOTES, 'UTF-8');

    // Save data
    if ($getpage == "list-album" AND $getact == "save"){
        $random = rand(000000,999999);
        $ftitle = isset($_POST["ftitle"]) ? filter_var($_POST['ftitle'], FILTER_SANITIZE_STRING) : null;
        $fslug = strtolower(str_replace(" ", "-", $ftitle));
        $fdesc = isset($_POST["fdesc"]) ? $_POST['fdesc'] : null;
        $fupload = $_FILES['fupload'];
        
        $arrValue = array();
        
        if(empty($fupload['tmp_name'])){
            $arrValue = array(
                'album_title' => $ftitle,
                'album_slug' => $fslug,
                'album_desc' => $fdesc
            );
        }else{
            uploadFile($fupload, "album_".$random, "images");
            $arrValue = array(
                'album_title' => $ftitle,
                'album_slug' => $fslug,
                'album_desc' => $fdesc,
                'album_pict' => "album_".$random.$fupload['name']
            );
        }

        $add_query = $database->insert( 'album_foto', $arrValue );
        if( $add_query )
        {
            header('location:../../?page='.$getpage);
        }
    }
    // Update data
    elseif ($getpage == "list-album" AND $getact == "update"){
        $random = rand(000000,999999);
        $fkey = isset($_POST["fkey"]) ? filter_var($_POST['fkey'], FILTER_SANITIZE_STRING) : null;
        $ftitle = isset($_POST["ftitle"]) ? filter_var($_POST['ftitle'], FILTER_SANITIZE_STRING) : null;
        $fslug = isset($_POST["fslug"]) ? filter_var($_POST['fslug'], FILTER_SANITIZE_STRING) : null;
        $fdesc = isset($_POST["fdesc"]) ? $_POST['fdesc'] : null;
        $fupload = $_FILES['fupload'];
        
        $arrValue = array();
        
        if(empty($fupload['tmp_name'])){
            $arrValue = array(
                'album_title' => $ftitle,
                'album_slug' => $fslug,
                'album_desc' => $fdesc
            );
        }else{
            uploadFile($fupload, "album_".$random, "images");
            $arrValue = array(
                'album_title' => $ftitle,
                'album_slug' => $fslug,
                'album_desc' => $fdesc,
                'product_pict' => "album_".$random.$fupload['name']
            );
        }
        
        //Add the WHERE clauses
        $arrWhere = array(
            'album_id' => $fkey
        );
        $updated = $database->update( 'album_foto', $arrValue, $arrWhere, 1 );
        if( $updated )
        {
            header('location:../../?page='.$getpage);
        }
    }
    // Delete data
    elseif ($getpage == "list-album" AND $getact == "delete"){
        $key = htmlspecialchars($_GET["key"], ENT_QUOTES, 'UTF-8');
        $query = "SELECT album_pict FROM album_foto WHERE album_id = '$key' ";
        //Add the WHERE clauses
        $where_clause = array(
            'album_id' => $key
        );
        if( $database->num_rows( $query ) > 0 )
        {
            list( $pict ) = $database->get_row( $query );
        }
        if (!empty($pict)){
            //Query delete
            $deleted = $database->delete( 'album_foto', $where_clause);
            if( $deleted )
            {
                unlink("../../../uploads/images/$pict");
            }
             
        }
        else{
            //Query delete
            $deleted = $database->delete( 'album_foto', $where_clause);
        }
        header('location:../../?page='.$getpage);
    }
}
?>