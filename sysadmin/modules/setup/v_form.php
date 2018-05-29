<?php
$pagetitle = "PPDB Config";
$act = "modules/setup/do_task.php";

$getpage = "ppdb-config";
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
$key = htmlspecialchars(1, ENT_QUOTES, 'UTF-8');
$query = "SELECT * FROM ppdb_setup WHERE setup_id = '$key' ";
if( $database->num_rows( $query ) > 0 )
{
    list( $id, $predate, $postdate, $quota ) = $database->get_row( $query );
    $vpredate = $predate == "0000-00-00" ? date("d/m/Y") : date("d/m/Y", strtotime($predate));
    $vpostdate = $postdate == "0000-00-00" ? date("d/m/Y") : date("d/m/Y", strtotime($postdate));
    $vquota = $quota == 0 ? 1000 : (int) $quota;
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
                        <label class="col-sm-3 control-label">Reg Limit Date</label>
                        <div class="col-sm-4">
                            <input type="text" name="fpredate" class="form-control datepicker" value="<?php echo $vpredate; ?>">
                        </div>
                        <label class="col-sm-1 control-label"> To </label>
                        <div class="col-sm-4">
                            <input type="text" name="fpostdate" class="form-control datepicker" value="<?php echo $vpostdate; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Quota Limit</label>
                        <div class="col-sm-2">
                            <input type="number" name="fquota" class="form-control" id="fquota" value="<?php echo $vquota; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-primary">Save</button>
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