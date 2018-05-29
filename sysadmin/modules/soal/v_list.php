<?php
$pagetitle = "Bank Soal";
$act = "modules/soal/do_task.php";

$getpage = "list-soal";
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
                <span class="pull-right"><button class="btn btn-primary" onclick="location.href='?page=<?php echo $getpage; ?>&act=add';"><i class="fa fa-plus-circle"></i> Add New</button> </span>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>Pertanyaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM bank_soal";
                            $results = $database->get_results( $query );
                            $no = 1;
                            foreach( $results as $row )
                            {
                                echo "<tr>";
                                    echo "<td>
                                            <a href='?page=$getpage&act=edit&key=$row[bs_id]'><i class='fa fa-edit'></i> Edit</a> | 
                                            <a href='$act?page=$getpage&act=delete&key=$row[bs_id]'><i class='fa fa-trash'></i> Delete</a>
                                        </td>";
                                    echo "<td>$row[bs_pertanyaan]</td>";
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
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Data Form</h5>
            </div>
            <div class="panel-body">
                <?php
                    $op1 = "A";
                    $op2 = "B";
                    $op3 = "C";
                    $op4 = "D";
                    $arr = array($op1,$op2,$op3,$op4);
                    $imp = implode(";", $arr);
                    echo $imp;
                    $exp = explode(";", $imp);
                    echo $exp[3];
                ?>
                <form role="form" class="form-horizontal" method="POST" action="<?php echo $act.'?page='.$getpage;?>&act=save">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pertanyaan</label>
                        <div class="col-sm-10">
                            <textarea name="fquestion" class="form-control" id="fquestion" placeholder="Pertanyaan" required="true"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pilihan Jawaban</label>
                        <div class="col-sm-5">
                            <input type="text" name="fopsi1" class="form-control" id="fopsi1" placeholder="Jawaban A" required="true">
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="fopsi2" class="form-control" id="fopsi2" placeholder="Jawaban B" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-5">
                            <input type="text" name="fopsi3" class="form-control" id="fopsi3" placeholder="Jawaban C" required="true">
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="fopsi4" class="form-control" id="fopsi4" placeholder="Jawaban D" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jawaban</label>
                        <div class="col-sm-5">
                            <input type="text" name="fanswer" class="form-control" id="fanswer" placeholder="A" required="true">
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
$query = "SELECT * FROM bank_soal WHERE bs_id = '$key' ";
if( $database->num_rows( $query ) > 0 )
{
    list( $id, $question, $opsi, $answer, $publish ) = $database->get_row( $query );
    $ops = explode(";", $opsi);
    $p_yess = $publish == "Y" ? "selected" : "";
    $p_no = $publish == "N" ? "selected" : "";
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
                        <label class="col-sm-2 control-label">Pertanyaan</label>
                        <div class="col-sm-10">
                            <textarea name="fquestion" class="form-control" id="fquestion" required="true"><?php echo $question;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pilihan Jawaban</label>
                        <div class="col-sm-5">
                            <input type="text" name="fopsi1" class="form-control" id="fopsi1" value="<?php echo $ops[0];?>" required="true">
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="fopsi2" class="form-control" id="fopsi2" value="<?php echo $ops[1];?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-5">
                            <input type="text" name="fopsi3" class="form-control" id="fopsi3" value="<?php echo $ops[2];?>" required="true">
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="fopsi4" class="form-control" id="fopsi4" value="<?php echo $ops[3];?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jawaban</label>
                        <div class="col-sm-5">
                            <input type="text" name="fanswer" class="form-control" id="fanswer" value="<?php echo $answer;?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Publish</label>
                        <div class="col-sm-5">
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