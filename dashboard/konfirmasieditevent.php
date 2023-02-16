<?php
require '../lib/db.php';


$id = $_POST['id_event'];
$event_name = $_POST['event_name'];
$event_description = $_POST['event_description'];
$event_date = $_POST['event_date'];


$sql = mysqli_query($connection, "update events set event_name = '$event_name',
event_description = '$event_description', event_date = '$event_date' where id_event = '$id' ");

if ($sql) {
 ?>
 <script type="text/javascript">
   alert ('Data Berhasil Diubah');
   window.location = 'dashboard.php';
 </script>
 <?php
}
