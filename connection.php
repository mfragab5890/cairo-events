
<?php

$user='ghelpo';
$pass='tafiTAFI';
$databasename='ghelpo';

date_default_timezone_set("Africa/Cairo");




   $link = mysqli_connect("localhost", $user, $pass, $databasename);

        if (mysqli_connect_error()) {

            die ("Database Connection Error");

        }

?>
