
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
            'agenda'=>'modules/agenda/page_agenda.php',
            'detail-agenda'=>'modules/agenda/page_detail.php',
            'pengumuman'=>'modules/pengumuman/page_pengumuman.php',
            'kontak-kami'=>'modules/contact/vform.php',
            'do_contact'=>'modules/contact/do_vform.php',
            'enroll'=>'modules/registrants/page_enroll.php',
            'do_pra_registrasi'=>'modules/registrants/do_pre_register.php',
            'do_auth'=>'digi_auth.php',
            'registrasi'=>'modules/registrants/page_enroll.php',
            'do_registrasi'=>'modules/registrants/page_enroll.php',
            'download-formulir'=>'modules/registrants/page_enroll.php',
            'do_formulir'=>'modules/registrants/page_enroll.php',
            'upload-berkas'=>'modules/registrants/page_enroll.php',
            'do_berkas'=>'modules/registrants/page_enroll.php',
            'profil-akun'=>'modules/registrants/page_enroll.php',
            'do_print_formulir'=>'modules/registrants/page_enroll.php',
            'do_update_profile'=>'modules/registrants/page_enroll.php',
            'do_update_password'=>'modules/registrants/page_enroll.php',
            'gallery'=>'modules/gallery/page_gallery.php',
            'home'=>'modules/home.php',
            'error_404'=>'modules/errors/error_404.php',
            'error_401'=>'modules/errors/error_401.php'
        );
    }else{
        $page_files = array( 
            'static'=>'modules/pages/page_content.php',
            'agenda'=>'modules/agenda/page_agenda.php',
            'detail-agenda'=>'modules/agenda/page_detail.php',
            'pengumuman'=>'modules/pengumuman/page_pengumuman.php',
            'kontak-kami'=>'modules/contact/vform.php',
            'do_contact'=>'modules/contact/do_vform.php',
            'enroll'=>'modules/registrants/page_enroll.php',
            'registrasi'=>'modules/registrants/page_register.php',
            'do_registrasi'=>'modules/registrants/do_register.php',
            'download-formulir'=>'modules/registrants/page_formulir.php',
            'do_formulir'=>'modules/registrants/do_formulir.php',
            'upload-berkas'=>'modules/registrants/page_berkas.php',
            'do_berkas'=>'modules/registrants/do_berkas.php',
            'profil-akun'=>'modules/registrants/page_profil.php',
            'do_print_formulir'=>'modules/registrants/do_print_formulir.php',
            'do_update_profile'=>'modules/registrants/do_profile.php',
            'do_update_password'=>'modules/registrants/do_password.php',
            'gallery'=>'modules/gallery/page_gallery.php',
            'home'=>'modules/home.php',
            'error_404'=>'modules/errors/error_404.php'
        );
    }

    if (in_array($_GET['page'],array_keys($page_files))) {
        if (file_exists($page_files[$_GET['page']])) {
            include $page_files[$_GET['page']];
        }else{
            include $page_files['error_404'];
        }
    } else {
        include $page_files['home'];
    }
    ?>