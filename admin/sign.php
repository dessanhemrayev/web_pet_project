<?php

$login=$_POST['name'];

$parol=$_POST['password'];

#echo "$familia";
#echo "$name";
echo "$login";
#echo "$grps";
echo "$parol";

 include_once '../connectDB.php';





$query=$pdo->prepare('SELECT * FROM `admin` WHERE `login`=? and `parol`=?');
$query->execute(array($login,$parol));
if ($query->fetch(PDO::FETCH_OBJ)) {

header('Location:/induv_zadaniye/admin/index.html ');
}
else
{
header('Location:/induv_zadaniye/admin/admin.html');
}



#){
#
#}
?>
