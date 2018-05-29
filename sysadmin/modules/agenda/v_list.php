<?php
$pagetitle = "Agenda";
$act = "modules/agenda/do_task.php";

$getpage = "list-agenda";
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
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="pull-right"><button class="btn btn-primary" onclick="location.href='?page=<?php echo $getpage; ?>&act=add';"><i class="fa fa-plus-circle"></i> Add New</button> </span>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>Judul</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM agenda WHERE ag_tipe = 'agenda'";
                            $results = $database->get_results( $query );
                            $no = 1;
                            foreach( $results as $row )
                            {
                                $jam_mulai = date("d/m/Y", strtotime($row[ag_tgl_mulai]));
                                $jam_selesai = date("d/m/Y", strtotime($row[ag_tgl_selesai]));
                                $waktu = $jam_mulai." - ".$jam_selesai." (".$row[ag_jam].")";
                                echo "<tr>";
                                    echo "<td>
                                            <a href='?page=$getpage&act=edit&key=$row[ag_id]'><i class='fa fa-edit'></i> Edit</a> | 
                                            <a href='$act?page=$getpage&act=delete&key=$row[ag_id]'><i class='fa fa-trash'></i> Delete</a>
                                        </td>";
                                    echo "<td>$row[ag_judul]</td>";
                                    echo "<td>$waktu</td>";
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

case "add":
?>
<div class="row">
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Data Form</h5>
            </div>
            <div class="panel-body">
                <form role="form" class="form-horizontal" method="POST" action="<?php echo $act.'?page='.$getpage;?>&act=save">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" name="ftitle" class="form-control" id="ftitle" placeholder="Judul" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal Agenda</label>
                        <div class="col-sm-4">
                            <input type="text" name="fpredate" class="form-control datepicker" placeholder="<?php echo date("d/m/Y");?>" required="true">
                        </div>
                        <label class="col-sm-1 control-label"> --- </label>
                        <div class="col-sm-4">
                            <input type="text" name="fpostdate" class="form-control datepicker" placeholder="<?php echo date("d/m/Y");?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jam Agenda</label>
                        <div class="col-sm-4">
                            <input type="text" name="fjam" class="form-control" placeholder="09:00 - 11:00" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Konten Agenda</label>
                        <div class="col-sm-10">
                            <textarea name="fkonten" class="form-control summernote" id="fkonten" required="true"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!--/.row-->
<?php
break;

case "edit";
$key = htmlspecialchars($_GET["key"], ENT_QUOTES, 'UTF-8');
$query = "SELECT * FROM agenda WHERE ag_id = '$key' ";
if( $database->num_rows( $query ) > 0 )
{
    list( $id, $tgl_post, $predate, $postdate, $jam, $judul, $konten, $tipe, $publish ) = $database->get_row( $query );
    $vpredate = $predate == "0000-00-00" ? date("d/m/Y") : date("d/m/Y", strtotime($predate));
    $vpostdate = $postdate == "0000-00-00" ? date("d/m/Y") : date("d/m/Y", strtotime($postdate));
    $p_yess = $publish == "Y" ? "selected" : "";
    $p_no = $publish == "N" ? "selected" : "";
?>
<div class="row">
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Data Form</h5>
            </div>
            <div class="panel-body">
                <form role="form" class="form-horizontal" method="POST" action="<?php echo $act.'?page='.$getpage;?>&act=update">
                <input type="hidden" name="fid" value="<?php echo $id;?>" readonly>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" name="ftitle" class="form-control" id="ftitle" value="<?php echo $judul;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal Agenda</label>
                        <div class="col-sm-4">
                            <input type="text" name="fpredate" class="form-control datepicker" value="<?php echo $vpredate;?>">
                        </div>
                        <label class="col-sm-1 control-label"> --- </label>
                        <div class="col-sm-4">
                            <input type="text" name="fpostdate" class="form-control datepicker" value="<?php echo $vpostdate;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jam Agenda</label>
                        <div class="col-sm-4">
                            <input type="text" name="fjam" class="form-control" value="<?php echo $jam;?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Konten Agenda</label>
                        <div class="col-sm-10">
                            <textarea name="fkonten" class="form-control summernote" id="fkonten"><?php echo $konten;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Publish</label>
                        <div class="col-sm-2">
                            <select name="fpublish" class="form-control" id="fpublish">
                                <option value="Y" <?php echo $p_yess;?>>Yes</option>
                                <option value="N" <?php echo $p_no;?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Update</button>
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