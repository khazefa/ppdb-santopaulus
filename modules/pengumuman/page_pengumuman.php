<?php
    $pagetitle = "Informasi Seleksi Penerimaan";
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
            <h3>Daftar Calon Siswa SMP Katolik Santo Paulus</h3><hr>
            <table id="data_grid" class="table table-striped">
            <thead>
                <tr>
                    <th>No Registrasi</th>
                    <th>NISN</th>
                    <th>NIS</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT r.reg_id, r.reg_status, c.* "
                        . "FROM registrasi AS r INNER JOIN calon_siswa AS c ON r.cs_nisn = c.cs_nisn "
                        . "WHERE r.reg_status <> 0 ORDER BY reg_id ASC";
                $results = $database->get_results( $query );
                $no = 1;
                foreach( $results as $row )
                {
                    $gender = $row["cs_jkel"] == "L" ? "Laki-Laki" : "Perempuan";
                    $stat = (int)$row["reg_status"];
                    switch ($stat){
                        case 1:
                            $status = strtoupper("proses");
                        break;
                        case 2:
                            $status = strtoupper("proses");
                        break;
                        case 3:
                            $status = strtoupper("lulus");
                        break;
                        case 4:
                            $status = strtoupper("tidak lulus");
                        break;
                        default:
                            $status = strtoupper("proses");
                        break;
                    }
                        echo '<td>'.$row["reg_id"].'</td>';
                        echo '<td>'.$row["cs_nisn"].'</td>';
                        echo '<td>'.$row["cs_nis"].'</td>';
                        echo '<td>'.$row["cs_nama_lengkap"].'</td>';
                        echo '<td>'.$gender.'</td>';
                        echo '<td>'.$row["cs_email"].'</td>';
                        echo '<td>'.$status.'</td>';
                    echo '</tr>';
                }
            ?>
            </tbody>
            </table>
        </div>
    </div>
</div>
</section>

<script type="text/javascript">
function logic_pengumuman(){
    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        "autoWidth": true,
        "dom": '<"datatable-header"><"datatable-scroll"tr><"datatable-footer"p>',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_'
        }
    });
    $('#data_grid').DataTable({
        "responsive": true,
        "columnDefs": [
          { "orderable": false, "targets": 0 }
        ]
    });
};
</script>