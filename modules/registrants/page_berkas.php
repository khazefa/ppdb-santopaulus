<?php
    $getpage = htmlspecialchars($_GET["page"], ENT_QUOTES, 'UTF-8');
    
if (empty($_SESSION['isSession'])){
    $url = $baseurl.'?page=enroll';
    echo "<script type='text/javascript'>alert('Harap login terlebih dahulu!');window.location.href = '".$url."';</script>";
    exit();
}else{
    $sessID = $_SESSION['vcUid'];
    if(!empty($sessID)){
        $query = "SELECT berkas_id FROM calon_siswa WHERE cs_nisn = '$sessID' ";
        if( $database->num_rows( $query ) > 0 )
        {
            list( $is_berkas ) = $database->get_row( $query );
        }
        
        if($is_berkas > 0){
            $url = $baseurl;
            echo "<script type='text/javascript'>alert('Anda sudah pernah mengupload berkas pendaftaran.');window.location.href = '".$url."';</script>";
            exit();
        }else{
            $pagetitle = "Upload Berkas";
        }
    }else{
        $url = $baseurl.'?page=form-pendaftaran';
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
            <p class="lead">Silakan upload berkas pendaftaran beserta berkas lainnya, yang telah diisi dan discan dalam format zip.</p>
            <hr>
            <form role="form" method="POST" action="?page=do_berkas" class="form-area contact-form" enctype="multipart/form-data">
            <input type="hidden" name="fid" value="<?php echo $key;?>" readonly>
            <input type="hidden" name="furl" value="<?php echo $getpage;?>" readonly>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Upload Berkas Pendaftaran</label>
                    <div class="col-sm-6">
                        <input name="fupload" id="fupload" type="file" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8 text-right">
                        <button type="submit" name="download" class="btn btn-primary"><i class="fa fa-save"></i> Upload</button>
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