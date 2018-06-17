    <!-- start banner Area -->
    <section class="banner-area relative" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row fullscreen d-flex align-items-center justify-content-center">
                <div class="banner-content col-lg-12 col-md-12">
                    <h1>
                        Sekolah Katolik Santo Paulus			
                    </h1>
                    <p class="text-white">
                        To create young generation who are intellectually, socially, emotionally and spiritually educated 
                        and also able to follow the changes in Science and Technology.
                        <br> To educate, teach, and train young generation in order to create an individual who is smart, competent, and well behaved.
                    </p>
                    <a href="#intro" class="primary-btn header-btn text-uppercase">Get Started</a>
                </div>												
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start intro Area -->
    <section class="pt-100" id="intro">
        <div class="container">
            <!--check for registration event date-->
            <?php
                $query = "SELECT setup_date_post FROM ppdb_setup WHERE CURDATE() BETWEEN setup_date_pre and setup_date_post ";
                if( $database->num_rows( $query ) > 0 )
                {
                    list( $datepost ) = $database->get_row( $query );
                    $postdate = tgl_indo($datepost);
                    echo '<div class="alert alert-warning alert-dismissible" role="alert">';
//                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        echo 'Pendaftaran sekolah telah dibuka! silahkan melakukan ';
                        echo '<a href="?page=registrasi" class="text-success">REGISTRASI</a> pendaftaran ditutup pada <strong>'.$postdate.'</strong>';
                    echo '</div>';
                }else{
                    $qry_setup = "SELECT setup_date_pre, setup_date_post FROM ppdb_setup";
                    if( $database->num_rows( $qry_setup ) > 0 )
                    {
                        list( $datepre, $datepost ) = $database->get_row( $qry_setup );
                        $predate = tgl_indo($datepre);
                        $postdate = tgl_indo($datepost);
                        echo '<div class="alert alert-warning alert-dismissible" role="alert">';
                            echo 'Pendaftaran sekolah dibuka kembali pada tanggal <strong>'.$predate.'</strong> ';
                            echo 'sampai dengan tanggal <strong>'.$postdate.'</strong>';
                        echo '</div>';
                    }
                }
            ?>
            
            <div class="row align-items-center countdown-wrap no-gutters">
                <div class="col-lg-12">
                    <h1>Welcome to our website!</h1>
                    <p>
                        We are happy to give you our best service because this is our priority in serving you.
                        Through this website, we want to try to give you the informations needed such as about:
                        <ul class="unordered-list">
                            <li>A brief history of the Sisters of Saint Paul of Chartres (SPC).</li>
                            <li>Saint Paul School Sunter, Jakarta: kindergarten, elementary and junior high.</li>
                        </ul><br>
                        May you find the informations you are needed.
                    </p>
                </div>
            </div>
        </div>	
    </section>
    <!-- End intro Area -->
    
    <!-- Start services Area -->
    <section class="counter-area section-gap relative">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-3 col-md-6">
                    <div class="single-counter">
                        <div class="circle">
                          <div class="inner"></div>
                        </div>
                            <h5><i class="fa fa-user-plus"></i></h5>
                        <p>
                            <a href="?page=enroll" type="button" class="btn btn-warning">Pra Registrasi</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-counter">
                        <div class="circle">
                          <div class="inner"></div>
                        </div>
                            <h5><i class="fa fa-wpforms"></i></h5>
                        <p>
                            <a href="?page=registrasi" type="button" class="btn btn-warning">Isi Form Registrasi</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-counter">
                        <div class="circle">
                          <div class="inner"></div>
                        </div>
                            <h5><i class="fa fa-print"></i></h5>
                        <p>
                            <a href="?page=download-formulir" type="button" class="btn btn-warning">Cetak Form Registrasi</a>
                        </p>
                    </div>
                </div>	
                <div class="col-lg-3 col-md-6">
                    <div class="single-counter">
                        <div class="circle">
                          <div class="inner"></div>
                        </div>
                            <h5><i class="fa fa-list-alt"></i></h5>
                        <p>
                            <a href="?page=hasil-seleksi" type="button" class="btn btn-warning">Hasil Seleksi</a>
                        </p>
                    </div>
                </div>																				
            </div>
        </div>	
    </section>
    <!-- End services Area -->

    <!-- Start gallery Area -->
    <section class="gallery-area section-gap" id="gallery">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 pb-50 header-text text-center">
                    <h1 class="mb-10">Galeri Sekolah</h1>
                </div>
            </div>						
            <div class="row">
                <?php
                    $img_path = UPLOADS_DIR . "images" . DIRECTORY_SEPARATOR;

                    $query = "SELECT * FROM galeri_foto ORDER BY RAND() LIMIT 4";
                    $results = $database->get_results( $query );
                    $no = 1;
                    foreach( $results as $row )
                    {
                        $img_path = UPLOADS_DIR . "images" . DIRECTORY_SEPARATOR;
                        $pict = !empty($row["galeri_pict"]) ? '<img class="img-fluid single-gallery" src="'.$img_path.$row["galeri_pict"].'" alt="'.$row["galeri_title"].'">' 
                                : '<img class="img-fluid single-gallery" src="http://placehold.it/900x350">';
                        echo '<div class="col-lg-6 col-md-6">';
                            echo '<a href="'.$img_path.$row["galeri_pict"].'" class="img-gal">';
                            echo $pict;
                            echo '</a>';
                        echo '</div>';
                    }
                ?>	
            </div>
        </div>	
    </section>
    <!-- End gallery Area -->