<?php
    $getpage = htmlspecialchars($_GET["page"], ENT_QUOTES, 'UTF-8');
    
if (empty($_SESSION['isSession'])){
    $url = $baseurl.'?page=enroll';
    echo "<script type='text/javascript'>alert('Harap login terlebih dahulu!');window.location.href = '".$url."';</script>";
    exit();
}else{
    $sessID = $_SESSION['vcUid'];
    if(!empty($sessID)){
        $url = $baseurl.'?page=upload-berkas';
        echo "<script type='text/javascript'>alert('Anda sudah pernah mengisi formulir pendaftaran, harap upload berkas pendaftaran.');window.location.href = '".$url."';</script>";
        exit();
    }else{
        $pagetitle = "Request Formulir Pendaftaran";
        $key = htmlspecialchars($_SESSION['vcUser'], ENT_QUOTES, 'UTF-8');
        $query = "SELECT user_fullname, user_email FROM users WHERE user_keyname = '$key' ";
        if( $database->num_rows( $query ) > 0 )
        {
            list( $fullname, $email ) = $database->get_row( $query );
        }
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
            <p class="lead">Harap isi formulir berikut dengan lengkap dan benar, sesuai dengan formulir pendaftaran yang akan diisi berikutnya.</p>
            <hr>
            <form role="form" method="POST" action="?page=do_registrasi" class="form-area contact-form">
            <input type="hidden" name="fid" value="<?php echo $key;?>" readonly>
            <input type="hidden" name="furl" value="<?php echo $getpage;?>" readonly>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-6">
                        <input name="fname" id="fname" type="text" class="form-control" value="<?php echo $fullname;?>" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-2">
                        <select name="fjkel" class="form-control" required="required">
                            <option value="">Jenis Kelamin</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">NISN</label>
                    <div class="col-sm-3">
                        <input name="fnisn" id="fnisn" type="text" class="form-control" placeholder="1234567890" required="required">
                    </div>
                    <label class="col-sm-0 col-form-label">NIS</label>
                    <div class="col-sm-4">
                        <input name="fnis" id="fnis" type="text" class="form-control" placeholder="123456789012" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tempat, Tgl Lahir</label>
                    <div class="col-sm-4">
                        <input name="ftempat" id="ftempat" type="text" class="form-control" placeholder="Tempat Lahir" required="required">
                    </div>
                    <label class="col-sm-0 col-form-label">,</label>
                    <div class="col-sm-3">
                        <input name="ftgl" id="ftgl" type="date" class="form-control" required="required" pattern="dd/mm/yyyy">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Agama</label>
                    <div class="col-sm-2">
                        <select name="fagama" class="form-control" required="required">
                            <option value="">Agama</option>
                            <option value="Katholik">Katholik</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Islam">Islam</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <textarea name="faddress" id="faddress" class="form-control" placeholder="Alamat Lengkap"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">No. Telepon / Hp</label>
                    <div class="col-sm-3">
                        <input name="fphone" id="fphone" type="text" class="form-control" placeholder="No. Telepon / Hp">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Ayah</label>
                    <div class="col-sm-6">
                        <input name="fnama_ayah" id="fnama_ayah" type="text" class="form-control" placeholder="Nama Ayah" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Ibu</label>
                    <div class="col-sm-6">
                        <input name="fnama_ibu" id="fnama_ibu" type="text" class="form-control" placeholder="Nama Ibu" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Wali</label>
                    <div class="col-sm-6">
                        <input name="fnama_wali" id="fnama_wali" type="text" class="form-control" placeholder="Nama Wali">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Asal Sekolah</label>
                    <div class="col-sm-6">
                        <input name="fasal_sekolah" id="fasal_sekolah" type="text" class="form-control" placeholder="Asal Sekolah" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-6">
                        <input name="femail" id="femail" type="email" class="form-control" value="<?php echo $email;?>" readonly="readonly">
                        <small>alamat email tidak dapat diganti</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8 text-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
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