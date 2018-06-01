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
            $url = $baseurl.'?page=upload-berkas';
            echo "<script type='text/javascript'>window.location.href = '".$url."';</script>";
            exit();
        }else{
            $pagetitle = "Download Formulir";
            $key = htmlspecialchars($_SESSION['vcUser'], ENT_QUOTES, 'UTF-8');
            $query = "SELECT cs_nama_lengkap FROM calon_siswa WHERE cs_nisn = '$sessID' ";
            if( $database->num_rows( $query ) > 0 )
            {
                list( $fullname ) = $database->get_row( $query );
            }
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
            <p class="lead">Silakan download formulir pendaftaran berikut beserta berkas lainnya dalam format zip.</p>
            <hr>
            <form role="form" method="POST" action="?page=do_formulir" class="form-area contact-form">
            <input type="hidden" name="fid" value="<?php echo $key;?>" readonly>
            <input type="hidden" name="furl" value="<?php echo $getpage;?>" readonly>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-6">
                        <input name="fname" id="fname" type="text" class="form-control" value="<?php echo $fullname;?>" readonly="readonly">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">NISN</label>
                    <div class="col-sm-3">
                        <input name="fnisn" id="fnisn" type="text" class="form-control" value="<?php echo $sessID;?>" readonly="readonly">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label text-primary">berkas_pendaftaran.zip</label>
                    <div class="col-sm-4 text-left">
                        <!--<button type="submit" name="download" class="btn btn-primary"><i class="fa fa-save"></i> Download</button>-->
                        <?php
                            $zipname = UPLOADS_DIR . "docs". DIRECTORY_SEPARATOR ."berkas_pendaftaran.zip";
                        ?>
                        <a type="button" name="download" class="btn btn-primary" href="<?php echo $zipname;?>" target="_blank"><i class="fa fa-save"></i> Download</a>
                        
                    </div>
                    <div class="col-sm-6 text-right">
                        Sudah mengisi dan men-scan dokumen pendaftaran?
                        <button type="button" class="btn btn-success" onclick="windows.location.href='?page=upload-berkas'"><i class="fa fa-external-link"></i> Upload Berkas</button>
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