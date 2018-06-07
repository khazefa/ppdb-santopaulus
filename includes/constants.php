<?php
/** BASE URL **/
$baseurl = "http://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

define( 'DB_HOST', 'localhost' ); // set database host
define( 'DB_USER', 'root' ); // set database user
define( 'DB_PASS', 'secret' ); // set database password
define( 'DB_NAME', 'db_ppdb_santop' ); // set database name
define( 'SEND_ERRORS_TO', 'mymaildumpp@gmail.com' ); //set email notification email address
define( 'DISPLAY_DEBUG', true ); //display db errors?

/** ASSETS PATH **/
define('ABSPATH', dirname(dirname(__FILE__)) . '/');
define('UPLOADS_DIR','uploads/');

/** LIMITATION SHOWING DATA **/
define('PAGE_LIMIT',10);

/** MAIL INFO **/
define('INFO_EMAIL','contact@santopaulus.sch.id');

/** WEB INFO **/
define('WEB_DESC','web application to complete final exam task');
define('WEB_KEYWORDS','web, skripsi, ta, tugas akhir, skripsi, D3, S1');
define('WEB_TITLE','SMP Katolik Santo Paulus');
?>