<?php
include('connect.php');

$check = "SELECT * FROM idea";
$idea = $conn->prepare($check);
$idea->execute();   

$checkcount=$idea->rowCount();

  $info = array();
    if($checkcount>0){
        
      while (	$fetch=$idea->fetch(PDO::FETCH_ASSOC)) {
      $info[]= $fetch;
      }
        
    }

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Users.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('IdeaId', 'QamId', 'QacId', 'StaffId', 'AdminId', 'CategoryId', 'Idea', 'Document', 'AnonymousStatus', 'UploadDate', 'UploadTime', 'ThumbUp', 'ThumbDown'));


if (count($info) > 0) {
    foreach ($info as $fetch) {
        fputcsv($output, $fetch);
    }
}
 ?>
