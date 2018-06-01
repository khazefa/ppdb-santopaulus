<?php
    $key = htmlspecialchars($_SESSION['vcUser'], ENT_QUOTES, 'UTF-8');
    $query = "SELECT user_fullname, user_email FROM users WHERE user_keyname = '$key' ";
    if( $database->num_rows( $query ) > 0 )
    {
        list( $fullname, $email ) = $database->get_row( $query );
    }
    $pagetitle = "Request Formulir Pendaftaran";
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
        <div class="col-md-8 col-md-offset-4">
            <h2 class="text-uppercase"><?php echo ucfirst($pagetitle);?></h2>
            <p class="lead">Daftar untuk mengikuti proses pendaftaran sekolah</p>
            <hr>
            <form role="form" method="POST" action="?page=do_pra_registrasi" class="form-area contact-form">
              <div class="form-group">
                <label for="rname">Nama Lengkap</label>
                <input name="rname" id="rname" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="remail">Email</label>
                <input name="remail" id="remail" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="rpassword">Password</label>
                <input name="rpassword" id="rpassword" type="password" class="form-control">
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-info"><i class="fa fa-user-md"></i> Daftar</button>
              </div>
            </form>
        </div>
    </div>
</div>
</section>