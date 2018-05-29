<?php
require("includes/constants.php");
require('includes/class.db.php');
$database = DB::getInstance();
require("includes/global_helper.php");
require("includes/common_helper.php");
require("includes/auto_number_helper.php");
require("includes/paging_builder.php");

include("template/v_header.php");
//    include("template/v_nav.php");
//    include("template/v_sidebar.php");
include("template/v_content.php");
include("template/v_footer.php");
?>