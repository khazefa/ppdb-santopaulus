<?php
    $pagetitle = "Galeri Sekolah";
?>
<section class="banner-area relative">	
    <div class="overlay overlay-bg"></div>
    <div class="container">				
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    <?php echo ucfirst($pagetitle);?>
                </h1>	
                <p class="text-white link-nav"><a href="<?php echo $baseurl;?>">Beranda </a>  <span class="lnr lnr-arrow-right"></span>  <?php echo ucfirst($pagetitle);?></p>
            </div>	
        </div>
    </div>
</section>

<section class="section-gap">
<div class="container">
    <h1>Image Gallery</h1><hr>
    <div class="row">
        <div class="row gallery-item">
            <?php
                $img_path = UPLOADS_DIR . "images" . DIRECTORY_SEPARATOR;

                $query = "SELECT * FROM galeri_foto ORDER BY galeri_id LIMIT 12";
                $results = $database->get_results( $query );
                $no = 1;
                foreach( $results as $row )
                {
                    $img_path = UPLOADS_DIR . "images" . DIRECTORY_SEPARATOR;
                    $pict = !empty($row["galeri_pict"]) ? '<img class="img-fluid single-gallery" src="'.$img_path.$row["galeri_pict"].'" alt="'.$row["galeri_title"].'">' 
                            : '<img class="img-fluid single-gallery" src="http://placehold.it/900x350">';
                    echo '<div class="col-md-4">';
                        echo '<a href="'.$img_path.$row["galeri_pict"].'" class="img-gal">';
                        echo $pict;
                        echo '</a>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
</div>
</section>