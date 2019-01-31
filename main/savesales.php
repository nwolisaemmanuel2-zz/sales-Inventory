<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['cashier'];
//$c = $_POST['date'];
$d = $_POST['ptype'];
$e = $_POST['amount'];
$z = $_POST['profit'];
$cname = $_POST['cname'];
$date = date('m/d/Y');
$month = date('F');
$year = date('Y');
if($d=='credit') {
$f = $_POST['due'];
$sql = "INSERT INTO sales (invoice_number,cashier,date,type,amount,profit,due_date,name) VALUES (:a,:b,:c,:d,:e,:z,:f,:g)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':z'=>$z,':f'=>$f,':g'=>$cname));
header("location: preview.php?invoice=$a");
exit();
}
if($d=='cash') {
$f = $_POST['cash'];
$mm = $_POST['mobilemoney'];
$e= (float) $e;
$mm= (float) $mm;
$ff=$f + $mm;
if($ff >$e || $ff==$e ){
$sql = "INSERT INTO sales (invoice_number,cashier,date,type,amount,profit,due_date,name,mobilemoney) VALUES (:a,:b,:c,:d,:e,:z,:f,:g,:mm)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$date,':d'=>$d,':e'=>$e,':z'=>$z,':f'=>$f,':g'=>$cname,':mm'=>$mm));
header("location: preview.php?invoice=$a");
exit();
}

else {
echo'<a href="sales.php?id=cash&invoice='.$a.'">SORRY THE AMOUNT PAID IS LESS THEN THE TOATL COST. CLICK TO GO BACK</a>';
}
}
// query



?>
