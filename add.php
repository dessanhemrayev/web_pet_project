<?php

$login=$_POST['login'];
$email=$_POST['email'];
$parol=$_POST['xpassword'];

#echo "$familia";
#echo "$name";
echo "$login";
#echo "$grps";
echo "$parol";

require 'connectDB.php';



$query=$pdo->prepare("INSERT INTO user(login,email,parol) VALUES(?,?,?)");
if($query->execute(array($login,$email,$parol))){

	session_start();
$_SESSION["login"] = $login;


header('Location:/induv_zadaniye/check/index.php?q=1');
}
else
{
	header('Location:/induv_zadaniye/index.html');
}
?>
