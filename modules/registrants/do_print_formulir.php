<?php
session_start();
if (empty($_SESSION['isSession'])){
    $url = $baseurl.'?page=enroll';
    echo "<script type='text/javascript'>alert('Harap login terlebih dahulu!');window.location.href = '".$url."';</script>";
    exit();
}else{    
    
    require("../../includes/constants.php");
    require_once("../../includes/class.db.php");
    require('../../includes/fpdf_cellfit.php');
    $database = DB::getInstance();
    require_once("../../includes/common_helper.php");
    
    $furl = isset($_POST["furl"]) ? filter_var($_POST['furl'], FILTER_SANITIZE_STRING) : null;
    
    $fnoreg = isset($_POST["fnoreg"]) ? filter_var($_POST['fnoreg'], FILTER_SANITIZE_STRING) : null;
    
    $orientation = "P";
    $paper_size = "A4";
    $width = 0;
    $height = 0;

    switch ($orientation) {
        case "P":
           switch ($paper_size) {
                       case "A4":
                            $width = 210;
                            $height = 297;
                       break;
                       case "A5":
                            $width = 148;
                            $height = 210;
                       break;
                       default:
                            $width = 210;
                            $height = 297;
                       break;
               }
            break;

        case "L":
            switch ($paper_size) {
                       case "A4":
                            $width = 297;
                            $height = 210;
                       break;
                       case "A5":
                            $width = 210;
                            $height = 148;
                       break;
                       default:
                            $width = 297;
                            $height = 210;
                       break;
               }
            break;

        default:
            switch ($paper_size) {
                       case "A4":
                            $width = 210;
                            $height = 297;
                       break;
                       case "A5":
                            $width = 148;
                            $height = 210;
                       break;
                       default:
                            $width = 210;
                            $height = 297;
                       break;
               }
            break;
    }
    
    // intance object dan memberikan pengaturan halaman PDF
    $pdf = new FPDF_CellFit($orientation,'mm',$paper_size);

    $pdf->AliasNbPages();
    // membuat halaman baru
    $pdf->AddPage();
    // setting jenis font yang akan digunakan
    $pdf->Image('../../assets/img/logo.png',10,8,42,15);
    $pdf->SetFont('Arial','B',16);
    // mencetak string 
    $pdf->Cell(190,7,''.WEB_TITLE,0,1,'C');
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(190,7,'Bukti Pendaftaran Calon Siswa',0,1,'C');

    // Garis atas untuk header
    $pdf->Line(10, 30, 210-10, 30);
    // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Cell(10,10,'',0,1);

//    $pdf->SetFont('Arial','B',10);
//    $pdf->Cell(($width*(5/100)),6,'NO',1,0);
//    $pdf->Cell(($width*(10/100)),6,'ORDER ID',1,0);
//    $pdf->Cell(($width*(15/100)),6,'ORDER DATE',1,0);
//    $pdf->Cell(($width*(25/100)),6,'CUSTOMER',1,0);
//    $pdf->Cell(($width*(5/100)),6,'QTY',1,0);
//    $pdf->Cell(($width*(20/100)),6,'ORDER TOTAL',1,1);

    $pdf->SetFont('Arial','',9);
    
    $query = "SELECT r.reg_id, c.cs_nisn, c.cs_nis, c.cs_nama_lengkap, c.cs_tmpt_lahir, "
                . "c.cs_tgl_lahir, c.cs_jkel, c.cs_agama, c.cs_no_tlp, c.cs_alamat_lengkap, "
                . "c.cs_nama_ayah, c.cs_nama_ibu, c.cs_nama_wali, c.cs_asal_sekolah, c.cs_email "
                . "FROM calon_siswa AS c INNER JOIN registrasi AS r ON c.cs_nisn = r.cs_nisn "
                . "WHERE r.reg_id = '$fnoreg'";

    if( $database->num_rows( $query ) > 0 )
    {
        list( $regid, $nisn, $nis, $fullname, $tempat, $tgl, $jkel, $agama, 
                $notlp, $alamat, $ayah, $ibu, $wali, $sekolah, $email ) = $database->get_row( $query );
        $gender = $jkel == "L" ? "Laki-Laki" : "Perempuan";
        $tgllhir = tgl_indo($tgl);
    }
    
    $pdf->setFont('Arial','B',11);
    $pdf->Cell(6,10,'No Registrasi',0,0,'L');
    $pdf->setFont('Arial','',11);
    $pdf->Cell(6,10,'                           : '.$regid,0,1, 'L');

    $pdf->setFont('Arial','B',11);
    $pdf->Cell(6,0.5,'NISN',0,0,'L');
    $pdf->setFont('Arial','',11);
    $pdf->Cell(6,0.5,'                           : '.$nisn,0,1, 'L');

    $pdf->setFont('Arial','B',11);
    $pdf->Cell(6,10,'NIS',0,0,'L');
    $pdf->setFont('Arial','',11);
    $pdf->Cell(6,10,'                           : '.$nis,0,1, 'L');

    $pdf->setFont('Arial','B',11);
    $pdf->Cell(6,0.5,'Nama Lengkap',0,0,'L');
    $pdf->setFont('Arial','',11);
    $pdf->Cell(6,0.5,'                           : '.$fullname,0,1, 'L');

    $pdf->setFont('Arial','B',11);
    $pdf->Cell(6,10,'Tempat, Tgl Lahir',0,0,'L');
    $pdf->setFont('Arial','',11);
    $pdf->Cell(6,10,'                           : '.$tempat.', '.$tgllhir,0,1, 'L');

    $pdf->setFont('Arial','B',11);
    $pdf->Cell(6,0.5,'Jenis Kelamin',0,0,'L');
    $pdf->setFont('Arial','',11);
    $pdf->Cell(6,0.5,'                           : '.$gender,0,1, 'L');

    $pdf->setFont('Arial','B',11);
    $pdf->Cell(6,10,'Agama',0,0,'L');
    $pdf->setFont('Arial','',11);
    $pdf->Cell(6,10,'                           : '.$agama,0,1, 'L');

    $pdf->setFont('Arial','B',11);
    $pdf->Cell(6,0.5,'No Telepon',0,0,'L');
    $pdf->setFont('Arial','',11);
    $pdf->Cell(6,0.5,'                           : '.$notlp,0,1, 'L');

    $pdf->setFont('Arial','B',11);
    $pdf->Cell(6,10,'Alamat Lengkap',0,0,'L');
    $pdf->setFont('Arial','',11);
    $pdf->Cell(6,10,'                           : '.nl2br($alamat),0,1, 'L');

    $pdf->setFont('Arial','B',11);
    $pdf->Cell(6,0.5,'Nama Ayah',0,0,'L');
    $pdf->setFont('Arial','',11);
    $pdf->Cell(6,0.5,'                           : '.$ayah,0,1, 'L');

    $pdf->setFont('Arial','B',11);
    $pdf->Cell(6,10,'Nama Ibu',0,0,'L');
    $pdf->setFont('Arial','',11);
    $pdf->Cell(6,10,'                           : '.$ibu,0,1, 'L');

    $pdf->setFont('Arial','B',11);
    $pdf->Cell(6,0.5,'Nama Wali',0,0,'L');
    $pdf->setFont('Arial','',11);
    $pdf->Cell(6,0.5,'                           : '.$wali,0,1, 'L');

    $pdf->setFont('Arial','B',11);
    $pdf->Cell(6,10,'Asal Sekolah',0,0,'L');
    $pdf->setFont('Arial','',11);
    $pdf->Cell(6,10,'                           : '.$sekolah,0,1, 'L');

    $pdf->setFont('Arial','B',11);
    $pdf->Cell(6,0.5,'Alamat Email',0,0,'L');
    $pdf->setFont('Arial','',11);
    $pdf->Cell(6,0.5,'                           : '.$email,0,1, 'L');

    $title = 'Bukti Pendaftaran '.$fnoreg;
    $pdf->SetTitle($title);
    $pdf->Output('I', $title.'.pdf');
}
?>