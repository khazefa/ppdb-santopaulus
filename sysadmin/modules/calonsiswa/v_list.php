<?php
$pagetitle = "LIst Registrant";
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
                            <th>Jns Kelamin</th>
                            <th>Agama</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM calon_siswa";
                            $results = $database->get_results( $query );
                            $no = 1;
                            foreach( $results as $row )
                            {
                                $gender = $row["cs_jkel"] == "L" ? "Laki-Laki" : "Perempuan";
                                $status = strtoupper($row["cs_status"]);
                                echo "<tr>";
                                    echo "<td>
                                            <a href='?page=$getpage&act=info&key=$row[cs_nisn]'><i class='fa fa-eye'></i> View</a>
                                        </td>";
                                    echo "<td>$row[cs_nisn]</td>";
                                    echo "<td>$row[cs_nis]</td>";
                                    echo "<td>$row[cs_nama_lengkap]</td>";
                                    echo "<td>$gender</td>";
                                    echo "<td>$row[cs_agama]</td>";
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
$query = "SELECT * FROM customers WHERE customer_uniqid = '$key' ";
if( $database->num_rows( $query ) > 0 )
{
    list( $id, $uniqid, $name, $email, $phone, $address, $city, $postcode ) = $database->get_row( $query );
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Data Form</h5>
            </div>
            <div class="panel-body">
                <form role="form" class="form-horizontal" method="POST" action="<?php echo $act.'?page='.$getpage;?>&act=update">
                <input type="hidden" name="fid" value="<?php echo $id;?>" readonly>
                    <div class="form-group">
                        <label class="col-sm-1">Name</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $name;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1">Email</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $email;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1">Address</label>
                        <div class="col-sm-5">
                            <p>: <?php echo nl2br($address)."<br> ".$city."<br> ".$postcode;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1">Phone</label>
                        <div class="col-sm-5">
                            <p>: <?php echo $phone;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-5">
                            <button type="button" class="btn btn-default" onclick="window.history.go(-1); return false;">Back</button>
                        </div>
                    </div>
                </form>
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