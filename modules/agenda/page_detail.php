<?php
    $key = htmlspecialchars($_GET["q"], ENT_QUOTES, 'UTF-8');
    $query = "SELECT ag_tgl_posting, ag_tgl_mulai, ag_tgl_selesai, ag_jam, ag_judul, ag_konten FROM agenda WHERE ag_id = '$key' "
            . "AND ag_publish = 'Y'";
    if( $database->num_rows( $query ) > 0 )
    {
        list( $tglposting, $tglmulai, $tglselesai, $jam, $title, $content ) = $database->get_row( $query );
        $pagetitle = $title;
        $ftglposting = tgl_indo($tglposting);
        $ftglmulai = tgl_indo($tglmulai);
        $ftglselesai = tgl_indo($tglselesai);
        $fjam = $jam;
        $fcontent = nl2br(html_entity_decode($content), TRUE);
    }
?>
<section class="banner-area relative">	
    <div class="overlay overlay-bg"></div>
    <div class="container">				
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    <?php echo ucfirst($pagetitle);?>
                </h1>	
                <p class="text-white link-nav"><a href="<?php echo $baseurl;?>?page=agenda">Agenda Sekolah</a>  <span class="lnr lnr-arrow-right"></span>  <?php echo ucfirst($pagetitle);?></p>
            </div>	
        </div>
    </div>
</section>

<section class="section-gap">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php 
                echo '<p>Diposting pada '.$ftglposting.'<br>Tanggal Agenda: '.$ftglmulai.' s/d '.$ftglselesai.'<br>Jam '.$fjam.'</p>';
                echo $fcontent; 
            ?>
        </div>
    </div>
</div>
</section>