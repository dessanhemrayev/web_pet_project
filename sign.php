<?php

$login=$_POST['name'];

$parol=$_POST['password'];

#echo "$familia";
#echo "$name";
echo "$login";
#echo "$grps";
echo "$parol";

require 'connectDB.php';





$query=$pdo->prepare('SELECT * FROM `user` WHERE `login`=? and `parol`=?');
$query->execute(array($login,$parol));
if ($query->fetch(PDO::FETCH_OBJ)) {
	session_start();
$_SESSION["login"] = $login;
header('Location:/induv_zadaniye/check/index.php');
}
else
{
header('Location:/induv_zadaniye/index.html');
}



#){
#
#}
?>
