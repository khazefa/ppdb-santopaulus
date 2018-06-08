<?php
$pagetitle = "Registrant";
$act = "modules/calonsiswa/do_task.php";

$getpage = "list-pendaftar";
$getact = htmlspecialchars($_GET["act"], ENT_QUOTES, 'UTF-8');
?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="<?php echo $baseurl;?>">
            <em class="fa fa-home"></em>
        </a></li>
        <li class="active"><?php echo $pagetitle;?></li>
    </ol>
</div><!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $pagetitle;?></h1>
    </div>
</div><!--/.row-->
<?php
switch($getact){
    // Show List
    default:
?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="pull-right"> &nbsp;</span>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>NISN</th>
                            <th>NIS</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT c.*, r.reg_status FROM calon_siswa AS c "
                                    . "INNER JOIN registrasi AS r ON r.cs_nisn = c.cs_nisn ";
                            $results = $database->get_results( $query );
                            $no = 1;
                            foreach( $results as $row )
                            {
                                $gender = $row["cs_jkel"] == "L" ? "Laki-Laki" : "Perempuan";
                                $stat = (int)$row["reg_status"];
                                switch ($stat){
                                    case 1:
                                        $status = strtoupper("registered");
                                    break;
                                    case 2:
                                        $status = strtoupper("file_verified");
                                    break;
                                    case 3:
                                        $status = strtoupper("pass");
                                    break;
                                    case 4:
                                        $status = strtoupper("not_pass");
                                    break;
                                    default:
                                        $status = strtoupper("not registered");
                                    break;
                                }
                                echo "<tr>";
                                    echo "<td>
                                            <a href='?page=$getpage&act=info&key=$row[cs_nisn]'><i class='fa fa-eye'></i> View</a>
                                        </td>";
                                    echo "<td>$row[cs_nisn]</td>";
                                    echo "<td>$row[cs_nis]</td>";
                                    echo "<td>$row[cs_nama_lengkap]</td>";
                                    echo "<td>$row[cs_email]</td>";
                                    echo "<td>$status</td>";
                                echo "</tr>";
                                $no++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!--/.row-->
<?php
break;

case "info";
$key = htmlspecialchars($_GET["key"], ENT_QUOTES, 'UTF-8');
$query = "SELECT c.cs_nisn, c.cs_nis, c.cs_nama_lengkap, c.cs_tmpt_lahir, "
        . "c.cs_tgl_lahir, c.cs_jkel, c.cs_agama, c.cs_no_tlp, c.cs_alamat_lengkap, "
        . "c.cs_nama_ayah, c.cs_nama_ibu, c.cs_nama_wali, c.cs_asal_sekolah, c.cs_email "
        . "FROM calon_siswa AS c WHERE c.cs_nisn = '$key' ";
if( $database->num_rows( $query ) > 0 )
{
    list( $nisn, $nis, $fullname, $tempat, $tgl, $jkel, $agama, 
            $notlp, $alamat, $ayah, $ibu, $wali, $sekolah, $email ) = $database->get_row( $query );
    $tgllahir = tgl_indo($tgl);
    $gender = $jkel == "L" ? "Laki-Laki" : "Perempuan";
    
    $qry_status = "SELECT reg_status FROM registrasi WHERE cs_nisn = '$nisn'";
    if( $database->num_rows( $qry_status ) > 0 ){
        list( $regstatus ) = $database->get_row( $qry_status );
        if($regstatus == 3){
            $pass = "selected";
        }elseif($regstatus == 4){
            $notpass = "selected";
        }
    }
    
    $qry_berkas = "SELECT berkas_file, berkas_status FROM berkas_docs WHERE cs_nisn = '$nisn'";
    if( $database->num_rows( $qry_berkas ) > 0 ){
        list( $files, $status ) = $database->get_row( $qry_berkas );
        if($status == 1){
            $zipname = "../" . UPLOADS_DIR . "confi_docs". DIRECTORY_SEPARATOR . $files;
            $no_completed = "selected";
        }else{
            $zipname = "#";
            $completed = "selected";
        }
    }
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="pull-left">Detail Info</h5>
                <div class="pull-right">
                    <form role="form" class="form-horizontal" method="POST" action="<?php echo $act.'?page='.$getpage;?>&act=update_reg">
                        <input type="hidden" name="fnisn" value="<?php echo $nisn;?>" readonly="readonly">
                        <select name="fstatus_reg" id="fstatus_reg" class="form-control" onchange="this.form.submit()">
                            <option value="0">Lulus / Tidak Lulus</option>
                            <option value="1" <?php echo $notpass;?>>Tidak Lulus</option>
                            <option value="2" <?php echo $pass;?>>Lulus</option>
                        </select>
                    </form>
                </div>
                <!--<h5>Detail Info</h5>-->
            </div>
            <div class="panel-body">
                <form role="form" class="form-horizontal" method="POST" action="<?php echo $act.'?page='.$getpage;?>&act=update">
                    <input type="hidden" name="fnisn" value="<?php echo $nisn;?>" readonly="readonly">
                    <div class="form-group">
                        <label class="col-sm-2">NISN</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $nisn;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">NIS</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $nis;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Nama Lengkap</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $fullname;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Tempat, Tgl Lahir</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $tempat.', '.$tgllahir;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Jenis Kelamin</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $gender;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Agama</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $agama;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">No Telepon</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $notlp;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Alamat Lengkap</label>
                        <div class="col-sm-5">
                            <p>: <?php echo nl2br($alamat);?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Nama Ayah</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $ayah;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Nama Ibu</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $ibu;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Nama Wali</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $wali;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Asal Sekolah</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $sekolah;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Email</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $email;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Berkas Pendaftaran</label>
                        <div class="col-sm-3">
                            <p>: <?php echo '<a href="'.$zipname.'" target="_blank">'.$files.'</a>';?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">&nbsp;</label>
                        <div class="col-sm-2">
                            <select name="fstatus_berkas" id="fstatus_berkas" class="form-control" onchange="this.form.submit()">
                                <option value="0">Status Berkas</option>
                                <option value="1" <?php echo $no_completed;?>>Tidak Lengkap</option>
                                <option value="2" <?php echo $completed;?>>Sudah Lengkap</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer">
                <div class="text-right">
                    <button type="button" class="btn btn-default" onclick="window.history.go(-1); return false;">Back</button>
                </div>
            </div>
        </div>
    </div>
</div><!--/.row-->
<?php
}else{
echo '<div class="row"><div class="col-lg-12"> '
    . '<div class="panel panel-default">'
    . '<div class="panel-body"><h2 class="text-center">Data Not Available</h2></div>'
    . '</div>'
    . '</div></div>';
}
break;
}
?>