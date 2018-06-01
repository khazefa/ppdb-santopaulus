<?php
    $pagetitle = "PRA-REGISTRASI / LOG IN";
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
        <div class="col-lg-6">
            <h2 class="text-uppercase">Pra-Registrasi</h2>
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
        <div class="col-lg-6">
            <h2 class="text-uppercase">Login</h2>
            <p class="lead">Apakah kamu telah terdaftar?</p>
            <hr>
            <form role="form" method="POST" action="?page=do_auth">
              <div class="form-group">
                <label for="femail">Email</label>
                <input name="femail" id="femail" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="fpassword">Password</label>
                <input name="fpassword" id="fpassword" type="password" class="form-control">
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
              </div>
            </form>
        </div>
    </div>
</div>
</section>