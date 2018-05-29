
    <?php
    // Checking if the string contains parent directory
    if (strstr($_GET['page'], '../') !== false) {
        throw new \Exception("Directory traversal attempt!");
    }

    // Checking remote file inclusions
    if (strstr($_GET['page'], 'file://') !== false) {
        throw new \Exception("Remote file inclusion attempt!");
    }

    if (empty($_SESSION['isSession'])){
        $page_files = array(
            'static'=>'modules/pages/page_content.php',
            'kontak-kami'=>'modules/contact/vform.php',
            'do_contact'=>'modules/contact/do_vform.php',
            'enroll'=>'modules/customers/page_enroll.php',
            'do_registrasi'=>'modules/customers/do_register.php',
            'do_auth'=>'digi_auth.php',
            'profil-akun'=>'modules/customers/page_enroll.php',
            'do_update_profile'=>'modules/customers/page_enroll.php',
            'do_update_password'=>'modules/customers/page_enroll.php',
            'konfirmasi-pembayaran'=>'modules/customers/page_enroll.php',
            'do_save_payment'=>'modules/customers/page_enroll.php',
            'home'=>'modules/home.php'
        );
    }else{
        $page_files = array( 
            'static'=>'modules/pages/page_content.php',
            'kontak-kami'=>'modules/contact/vform.php',
            'do_contact'=>'modules/contact/do_vform.php',
            'enroll'=>'modules/customers/page_enroll.php',
            'profil-akun'=>'modules/customers/page_profile.php',
            'do_update_profile'=>'modules/customers/do_profile.php',
            'do_update_password'=>'modules/customers/do_password.php',
            'konfirmasi-pembayaran'=>'modules/payment/page_payment.php',
            'do_save_payment'=>'modules/payment/do_payment.php',
            'home'=>'modules/home.php'
        );
    }

    if (in_array($_GET['page'],array_keys($page_files))) {
        include $page_files[$_GET['page']];
    } else {
        include $page_files['home'];
    }
    ?>