<?php
  session_start();
  include_once("_CLASS_RESERVE.php");
  $pID = $_SESSION['personID'];
  $d = $_POST['day'];
  $m = $_POST['month'];
  $m+=1;
  $Y = $_POST['year'];
  $r_date = $Y."/".$m."/"."$d";
  $d_temp = new DateTime($r_date);
  $r_date = date_format($d_temp, 'Y-m-d');

  $reservation = new reserve($pID, $r_date);

  if($reservation->get_person()->can_reserve()) 
    $reservation->renderForm();
  else
    echo "ขออภัยค่ะ คุณไม่สามารถจองได้ในขณะนี้ กรุณาเข้าสู่ระบบ หรือลองใหม่ภายหลัง";
 ?>
