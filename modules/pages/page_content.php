<?php
    $key = htmlspecialchars($_GET["q"], ENT_QUOTES, 'UTF-8');
    $query = "SELECT pg_title, pg_slug, pg_content, pg_publish FROM site_pages WHERE pg_slug = '$key' ";
    if( $database->num_rows( $query ) > 0 )
    {
        list( $title, $slug, $content, $publish ) = $database->get_row( $query );
        $pagetitle = $title;
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
                <p class="text-white link-nav"><a href="<?php echo $baseurl;?>">Beranda </a>  <span class="lnr lnr-arrow-right"></span>  <?php echo ucfirst($pagetitle);?></p>
            </div>	
        </div>
    </div>
</section>

<section class="section-gap">
<div class="container">
    <div class="row">
        <?php echo $fcontent; ?>
    </div>
</div>
</section>