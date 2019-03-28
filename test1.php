<?php
$time = new DateTime();
sleep(5);
$time2 = new DateTime();
$time3 = $time -> diff($time2); 
echo $time3 -> format("%H:%I:%S");
?>

