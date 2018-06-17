<?php
    $getpage = htmlspecialchars($_GET["page"], ENT_QUOTES, 'UTF-8');
    
if (empty($_SESSION['isSession'])){
    $url = $baseurl.'?page=enroll';
    echo "<script type='text/javascript'>alert('Harap login terlebih dahulu!');window.location.href = '".$url."';</script>";
    exit();
}else{
    $sessID = $_SESSION['vcUid'];
    if(!empty($sessID)){
        $pagetitle = "Profil Pendaftar";
        $key = htmlspecialchars($_SESSION['vcUser'], ENT_QUOTES, 'UTF-8');
        $query = "SELECT r.reg_id, c.cs_nisn, c.cs_nis, c.cs_nama_lengkap, c.cs_tmpt_lahir, "
                . "c.cs_tgl_lahir, c.cs_jkel, c.cs_agama, c.cs_no_tlp, c.cs_alamat_lengkap, "
                . "c.cs_nama_ayah, c.cs_nama_ibu, c.cs_nama_wali, c.cs_asal_sekolah, c.cs_email "
                . "FROM calon_siswa AS c INNER JOIN registrasi AS r ON c.cs_nisn = r.cs_nisn "
                . "WHERE c.cs_nisn = '$sessID'";
        if( $database->num_rows( $query ) > 0 )
        {
            list( $regid, $nisn, $nis, $fullname, $tempat, $tgl, $jkel, $agama, 
                    $notlp, $alamat, $ayah, $ibu, $wali, $sekolah, $email ) = $database->get_row( $query );
        }
    }else{
        $url = $baseurl;
        echo "<script type='text/javascript'>alert('Terjadi kesalahan pada pendaftaran anda, harap ulangi pendaftaran kembali.');window.location.href = '".$url."';</script>";
        exit();
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
        <div class="col-md-12">
            <h2 class="text-uppercase"><?php echo ucfirst($pagetitle);?></h2>
            <p class="lead">Silakan download dan cetak formulir pendaftaran</p>
            <hr>
            <form role="form" method="POST" action="modules/registrants/do_print_formulir.php" target="_BLANK" class="form-area contact-form">
            <input type="hidden" name="fid" value="<?php echo $key;?>" readonly>
            <input type="hidden" name="furl" value="<?php echo $getpage;?>" readonly>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">No Registrasi</label>
                    <div class="col-sm-3">
                        <input name="fnoreg" id="fnoreg" type="text" class="form-control" value="<?php echo $regid;?>" readonly="readonly">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-4">
                        <input name="fname" id="fname" type="text" class="form-control" value="<?php echo $fullname;?>" readonly="readonly">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">NISN</label>
                    <div class="col-sm-3">
                        <input name="fnisn" id="fnisn" type="text" class="form-control" value="<?php echo $nisn;?>" readonly="readonly">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 text-right">
                        <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Cetak Formulir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</section>
<?php
}
?>