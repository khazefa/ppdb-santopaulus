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