        <?php
            $pagetitle = "Dashboard";
            $query_o = "SELECT 1 FROM registrasi WHERE reg_status = 1";
            $num_o = (int)$database->num_rows( $query_o );
            
            $query_m = "SELECT 1 FROM registrasi WHERE reg_status = 3";
            $num_m = (int)$database->num_rows( $query_m );
            
            $query_p = "SELECT 1 FROM registrasi WHERE reg_status = 4";
            $num_p = (int)$database->num_rows( $query_p );
        ?>
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
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

        <div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
							<div class="large"><?php echo $num_o;?></div>
							<div class="text-muted">Total Registrant</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-user-circle color-blue"></em>
							<div class="large"><?php echo $num_m;?></div>
							<div class="text-muted">Total Passed</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-user-circle-o color-red"></em>
							<div class="large"><?php echo $num_p;?></div>
							<div class="text-muted">Total Not Passed</div>
						</div>
					</div>
				</div>
			</div><!--/.row-->
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">New Registrant</div>
                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Actions</th>
                                <th>No Registrasi</th>
                                <th>NISN</th>
                                <th>NIS</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT r.reg_id, c.* "
                                        . "FROM registrasi AS r INNER JOIN calon_siswa AS c ON r.cs_nisn = c.cs_nisn "
                                        . "WHERE r.reg_status = 1 ORDER BY reg_id ASC";
                                $results = $database->get_results( $query );
                                $no = 1;
                                foreach( $results as $row )
                                {
                                    $gender = $row["cs_jkel"] == "L" ? "Laki-Laki" : "Perempuan";
                                    echo "<tr>";
                                        echo "<td>
                                                <a href='?page=list-pendaftar&act=info&key=$row[cs_nisn]'><i class='fa fa-eye'></i> View</a>
                                            </td>";
                                        echo "<td>$row[reg_id]</td>";
                                        echo "<td>$row[cs_nisn]</td>";
                                        echo "<td>$row[cs_nis]</td>";
                                        echo "<td>$row[cs_nama_lengkap]</td>";
                                        echo "<td>$row[cs_email]</td>";
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