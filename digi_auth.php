<?php
function anti_injection($data){
    $filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
    return $filter;
}

$email  = filter_var($_POST['femail'], FILTER_VALIDATE_EMAIL);
$pass   = anti_injection(md5($_POST['fpassword']));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($pass)){
    header('HTTP/1.1 403 Forbidden.', TRUE, 403);
    echo 'You dont have permissions to access this page! <a href="javascript:history.back()">Back</a>';
    exit(1); // EXIT_ERROR
}else{
    
    require_once('includes/class.db.php');
    $database = DB::getInstance();

    $query = "SELECT user_keyname, user_fullname, user_email FROM users WHERE user_keyname='$email' "
            . "AND user_keypass='$pass' AND role_id NOT IN (1,2)";
    if( $database->num_rows( $query ) > 0 )
    {
        list( $ukey, $uname, $umail ) = $database->get_row( $query );
        session_start();

        $_SESSION['isSession']	= TRUE;
        $_SESSION['vcUser']	= $ukey;
        $_SESSION['vcName']	= $uname;
        $_SESSION['vcMail']	= $umail;
        
        $query_c = "SELECT cs_nisn FROM calon_siswa WHERE cs_email='$email'";
        if( $database->num_rows( $query_c ) > 0 )
        {
            list( $ukey ) = $database->get_row( $query_c );
            $_SESSION['vcUid']	= $ukey;
        }else{
            $_SESSION['vcUid'] = "";
        }
        
        $url = $baseurl;
        echo "<script type='text/javascript'>window.location.href = '".$url."';</script>";
        exit();
    }
    else
    {
        $url = $baseurl."?page=error_401";
        echo "<script type='text/javascript'>window.location.href = '".$url."';</script>";
        exit();
    }
}
?>