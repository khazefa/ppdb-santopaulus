<?php
    $pagetitle = "Agenda Sekolah";
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
    <div class="row">
        <div class="col-md-12">
    <?php
    $query = "SELECT * FROM agenda WHERE ag_tipe = 'agenda' ORDER BY ag_id DESC";
    $results = $database->get_results( $query );
    $no = 1;
    foreach( $results as $row )
    {
        $fid = (int)$row['ag_id'];
        $title = $row['ag_judul'];
        $tglposting = tgl_indo($row['ag_tgl_posting']);
        $tglmulai = tgl_indo($row['ag_tgl_mulai']);
        $tglselesai = tgl_indo($row['ag_tgl_selesai']);
        $jam = $row['ag_jam'];
        $content = nl2br(html_entity_decode($row['ag_konten']), TRUE);
        $fcontent = substr($content,0,250); 
        $fcontent = substr($content,0,strrpos($fcontent," "));
        echo '
        <h1 class="mt-4">'.$title.'</h1>
        <hr>
        <p>Diposting pada '.$tglposting.'<br>Tanggal Agenda: '.$tglmulai.' s/d '.$tglselesai.'<br>Jam '.$jam.'</p>
        <hr>
        '.$fcontent.'...<a href="?page=detail-agenda&q='.$fid.'">detail agenda</a>
        <hr style="height:5px; background: #333; background-image: linear-gradient(to right, #ccc, #333, #ccc); border:0;">
        ';
    }
    ?>
        </div>
    </div>
</div>
</section>