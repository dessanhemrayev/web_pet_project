<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Dessan Hemrayev">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
	<title>База данных</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	 <link href="bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
<style type="text/css">
	#overlay{
		position: fixed;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		background:rgba(0,0,0,0.6);
	}
</style>
<script src="vue.js"></script>
    <script src="jquery.js"></script>

</head>
<body>
	<div id="app">
		<div class="container-fluid">

			<div class="row bg-dark">
				<div class="col-lg-12">
					<p class="text-center text-light display-4 pt-2" style="font-size: 25px;">Система планирования и контроля выполнения задач</p>
				</div>
			</div>
		</div>

	
		<div class="container ">
		
				<div class="col-lg-12 text-center">
					<h3 class="text-info">Список задач</h3>
				</div>
				


<div>
      <div>
         <form style="padding-left: 300px;padding-right: 250px;;"action="#" onSubmit="return validateForm()" method="post">
      <div class='row' >
              <div class='col-md-12' >
                  
              <h5>Добавить новую задачу:</h5>
                 <div class="form-item">
          Задача
                <input type="text" class='form-control'  id="location" 
                name="location" title="Введите названия место куда вы хотите отправится отдыхать" v-model="newUser.location">
        <div class="hint">Введите место отдыха куда вы хотите поехать </div>
          </div>
        
        <div class="form-item">
            Подзадачи
                <textarea class='form-control'  id="day" name="day"title="Введите сколько дней вы хотите отдыхать"v-model="newUser.day"></textarea>
        <div class="hint">Введите сколько дней вы хотите отдыхать</div>
          </div>
          
        
        
 	

</form> 
        <div class="form-item">
                        <button class="btn btn-success float-right" style="margin: 0" @click="addUser()">
            <i class="fas fa-user" ></i>&nbsp;&nbsp;Add New User
          </button>
          </div>
          
            </div>


               
          
                


</div>


			</div>
			<hr class="bg-info">
			<div class="alert alert-danger" v-if="errorMsg">
				{{errorMsg}}
			</div>
			<div class="alert alert-info" v-if="succesMsg">
				{{succesMsg}}
			</div>
		
		



	
	<script >
		$(document).ready(function() {
    		$("#day,#money").keydown(function(event) {
        // Разрешаем: backspace, delete, tab и escape
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || 
             // Разрешаем: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Разрешаем: home, end, влево, вправо
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // Ничего не делаем
                 return;
        }
        else {
            // Обеждаемся, что это цифра, и останавливаем событие keypress
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
});

		
	</script>
	<script >

function validateForm() {

  var mesto=document.getElementById('location').value;
  var days=document.getElementById('day').value;
  var money=document.getElementById('money').value;
  
  if(mesto=='' || days=='' || money==""){
         alert("Вы ввели не всю информацию, вернитесь назад и заполните все поля! ");
 
    
return false;}


 }
</script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue"></script>
	<script>
	var app=new Vue({
	el:'#app',
	data:{
		errorMsg:"",
		succesMsg:"",
		showDeleteModal:false,
		showEditModal:false,
		users:[],
		places:[],
		buyplace:{user:"",location:""},
		newUser:{location:"",day:"",money:"",user:""},
		currentUser:{}
	},
	mounted:function () {
		
	
		this.selectlocation();
	},
	methods:{
		
		addUser(){
			var formData=app.toFormData(app.newUser);
			axios.post("http://localhost/induv_zadaniye/check/process.php?action=create",formData).then(function(response){ 
				app.newUser={location:"",day:"",money:"",user:""};
				if(response.data.error){
					app.errorMsg=response.data.message;
				}
				else{
					app.succesMsg=response.data.message;
					app.getAllUsers();
					app.selectlocation();
				}
			});
		},
		toFormData(obj){
			var fd=new FormData();
			for(var i in obj){
				fd.append(i,obj[i]);
			}
			return fd;
		},
		
		

		}
});


 </script>

</body>
</html>