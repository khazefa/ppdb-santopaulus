<?php
    $to = INFO_EMAIL;
    $firstname = isset($_POST["fname"]) ? filter_var($_POST['fname'], FILTER_SANITIZE_STRING) : null;
    $email = isset($_POST["email"]) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : null;
    $text= $_POST["message"];
    $phone = isset($_POST["phone"]) ? filter_var($_POST['phone'], FILTER_SANITIZE_STRING) : null;
    
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "From: " . $email . "\r\n"; // Sender's E-mail
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $message ='<table style="width:100%">
        <tr>
            <td>'.$firstname.'  '.$laststname.'</td>
        </tr>
        <tr><td>Email: '.$email.'</td></tr>
        <tr><td>phone: '.$phone.'</td></tr>
        <tr><td>Text: '.$text.'</td></tr>
        
    </table>';

    if (@mail($to, $email, $message, $headers))
    {
        $url = $baseurl.'?page=kontak-kami';
        echo "<script type='text/javascript'>alert('The message has been sent.');window.location.href = '".$url."';</script>";
        exit();
    }else{
        $url = $baseurl.'?page=kontak-kami';
        echo "<script type='text/javascript'>window.location.href = '".$url."';</script>";
        exit();
    }
?>