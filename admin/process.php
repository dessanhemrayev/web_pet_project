<?php
$conn =new mysqli("localhost","root","","visa");
if($conn->connect_error){
	die("Connetion Failed".$conn->connect_error);
}
$result=array('error'=>false);
$action='';
if(isset($_GET['action'])){
	$action=$_GET['action'];
}
if($action=="read"){
	$sql=$conn->query("SELECT * FROM users ORDER BY id");
	$users=array();
	while($row=$sql->fetch_assoc()){
		array_push($users, $row);
	}
	$result['users']=$users;
}
if($action=="find"){
	$sql=$conn->query("SELECT location FROM users WHERE user='' ");
	$places=array();
	while($row=$sql->fetch_assoc()){
		array_push($places, $row);
	}
	$result['places']=$places;
}
if($action=='create'){
	$location = $_POST['location'];
	$day = $_POST['day'];
	$money=$_POST['money'];
	$user=$_POST['user'];
	$sql=$conn->query(" INSERT INTO users (location,day,money,user) VALUES ('$location','$day','$money','$user')");

	if($sql){
		$result['message']="Пользователь добавлен успешно!";
	}
	else{
		$result['error']=true;
		$result['message']="Не удалось добавить пользователя!";
	}
}
if($action=='update')
{	$id=$_POST['id'];
	$location = $_POST['location'];
	$day = $_POST['day'];
	$money=$_POST['money'];
	$user=$_POST['user'];
	 
	$sql=$conn->query("UPDATE users SET location='$location',day='$day',money='$money',user='$user' WHERE ID='$id'");
	if($sql){
		$result['message']="Данные обновлены успешно!";
	}
	else{
		$result['error']=true;
		$result['message']="Не удалось обновить данные!";
	}

}	
if($action=='buy')
{	
	$location = $_POST['location'];
	$user=$_POST['user'];
	 
	$sql=$conn->query("UPDATE users SET user='$user' WHERE location='$location'");
	if($sql){
		$result['message']="Имя пользователя изменено успешно!";
	}
	else{
		$result['error']=true;
		$result['message']="Не удалось изменить имя пользователя!";
	}

}	
	if($action=='delete'){
	$id=$_POST['id'];
	 
	$sql=$conn->query("DELETE FROM users WHERE ID='$id'");

	if($sql){
		$result['message']="Пользователь удалень успешно!";
	}
	else{
		$result['error']=true;
		$result['message']="Не удалось удалить пользователя!";
	}
}
$conn->close();
echo json_encode($result);
?>