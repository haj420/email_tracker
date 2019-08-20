<?php

//email_track.php
include('conn.php');


if(isset($_GET["code"]))
{
 $query = "
 UPDATE email_data 
 SET email_status = 'yes', email_open_datetime = '".date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')))."' 
 WHERE email_track_code = '".$_GET["code"]."' 
 AND email_status = 'no'
 ";
 $statement = $db->prepare($query);
 $statement->execute();
}

?>
