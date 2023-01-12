<?php
	include 's3Config.php';
	include 'dbConf.php';

	$emp_id = $_POST['emp_id'];
	$content1 = "ADD UNSUCCESSFULLY!";
	$content2 = "Employee ID MATCH with previous! Please change it!";

	$sql = "SELECT * FROM employee;";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	$unmatch = true;

	if($resultCheck > 0){
		while($row = mysqli_fetch_assoc($result)){
			if($row['emp_id'] == $emp_id){
				$unmatch = false;
			}
		}
	}

	if($unmatch){
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$content1 = "ADD SUCCESSFULLY!";
		$content2 = "Employee Name: ".$first_name." ".$last_name." has been added to database!";
		$pri_skill = $_POST['pri_skill'];
		$locations = $_POST['locations'];
		$images = $_FILES['images']['name'];
		$images_tmp = $_FILES['images']['tmp_name'];
		$keyName = $emp_id.'-'.rand(1,100).'-'.basename($images);
		$result = $s3->putObject(
			array(
				'Bucket' => $bucketName,
				'Key' => $keyName,
				'SourceFile' => $images_tmp,
				'ACL' => 'public-read'
			)
		);
		$pathInS3 = $result['ObjectURL'];
		$sql = "INSERT INTO employee (emp_id, first_name, last_name, pri_skill, locations, images, images_key) 
				VALUES ('$emp_id', '$first_name', '$last_name', '$pri_skill', '$locations', '$pathInS3', '$keyName');";
		$result = mysqli_query($conn, $sql);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Add Employee Information</title>
</head>	
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
		*{
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		font-family: cursive;
		}
		body{
		height: 100vh;
		display: flex;
		justify-content: center;
		align-items: center;
		padding: 10px;
		background: #faeee7;
		}
		.container{
		max-width: 700px;
		width: 100%;
		height: 260px;
		background-color: #fffffe;
		padding: 25px 30px;
		border-radius: 5px;
		box-shadow: 0 5px 10px rgba(0,0,0,0.15);
		}
		.container .title{
		font-size: 25px;
		font-weight: 500;
		position: relative;
		}
		.container .title::before{
		content: "";
		position: absolute;
		left: 0;
		bottom: 0;
		height: 3px;
		width: 30px;
		border-radius: 5px;
		background: linear-gradient(135deg, #ff8ba7,#ffc6c7);
		}
		.content form .user-details{
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
		margin: 20px 0 12px 0;
		}
		.content_1{
		font-size: 18px;
		font-weight: 500;
		position: relative;
		}
		.content_2{
		font-size: 18px;
		font-weight: 500;
		position: relative;
		}
		form .user-details .input-box{
		margin-bottom: 15px;
		width: calc(100% / 2 - 20px);
		}
		form .input-box span.details{
		display: block;
		font-weight: 500;
		margin-bottom: 5px;
		}
		.user-details .input-box input{
		height: 45px;
		width: 100%;
		outline: none;
		font-size: 16px;
		border-radius: 5px;
		padding-left: 15px;
		border: 1px solid #ccc;
		border-bottom-width: 2px;
		transition: all 0.3s ease;
		}
		.user-details .input-box input:focus,
		.user-details .input-box input:valid{
		border-color: #9b59b6;
		}

		form .category{
		display: flex;
		width: 80%;
		margin: 14px 0 ;
		justify-content: space-between;
		}
		form .category label{
		display: flex;
		align-items: center;
		cursor: pointer;
		}
		form .category label .dot{
		height: 18px;
		width: 18px;
		border-radius: 50%;
		margin-right: 10px;
		background: #d9d9d9;
		border: 5px solid transparent;
		transition: all 0.3s ease;
		}
		form .button{
		height: 38px;
		margin: 35px 0
		}


		form .button input{
		height:100%;
		width:100%;
		border-radius: 5px;
		border: none;
		color: #000;
		font-size: 17px;
		font-weight: 500;
		letter-spacing: 1px;
		cursor: pointer;
		transtition: all 0.3s ease;
		background: #ffc6c7;
		}
		form .button input:hover{
		/*transform: scale(0.99); */
		background: #ff8ba7;
		}
		@media(max-width: 50px){
		.container{
			max-width: 100%;
		}
		}
		input[type="submit"]{
		display: block;
		cursor: pointer;
		margin: 20px auto;
		font-size: 16px;
		font-weight: 800;
		background: #4090db;
		color: white;
		border-radius: 10px;
		}
		nav{
			position: absolute;
			top: 0;
			bottom: 0;
			height: 100%;
			Left: 0;
			background: #fff;
			width: 90px;
			overflow:hidden;
			transition:width 0.2s linear;
			box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1)
		}

		.logo{
			text-align:center;
			display: flex;
			transition: all 0.5s ease;
			margin: 10px;
		}

		.logo img{
			width: 45px;
			height: 45px;
			border-radius: 50%;
		}

		b{
			position: relative;
			font size: 50px;
			display: table;
			width: 600px;
			padding: 5px;
		}

		a{
			position: relative;
			color: rgb(85,83,83);
			font size: 14px;
			display: table;
			width: 500px;
			padding: 10px;
		}

		.fa{
			position: relative;
			width: 59px;
			height: 60px;
			top: 14px;
			font-size: 40px;
			text-aligh: center;
			padding: 10px;
			margin: 2px;
		}

		.nav-items{
			position: relative;
			top: 0px;
			margin-left: 0px;
		}

		.nav-item{
			position: relative;
			top: 0px;
			margin-left: 20px;
		}

		a:hover{
			background: #eee;
		}

		nav:hover{
			width: 250px;
			transition: a;; 0.5s ease;
		}
	</style>
<body>
	<nav>
		<ul>
		<li><b href="#">
			<img src ="https://mycloudemployee.s3.amazonaws.com/2-69-logo.jpg" alt="",width="80px", height="80px">
			<span class="nav-items"><b>KBC </br>Sdn. Bhd.</b></span>
		</b></li>
		<li><a href="AddEmp.php">
			<i class="fa fa-handshake-o"></i>
			<span class="nav-item">Add Employee</span>
		</a></li>
		<li><a href="DeleteGetEditEmp.php">
			<i class="fa fa-sign-in"></i>
			<span class="nav-item">Get Employee</span>
		</a></li>
		<li><a href="DeleteGetEditEmp.php">
			<i class="fa fa-edit"></i>
			<span class="nav-item">Edit Employee</span>
		</a></li>
		<li><a href="DeleteGetEditEmp.php">
			<i class="fa fa-trash-o"></i>
			<span class="nav-item">Remove Employee</span>
		</a></li>
		<li><a href="ShowAllEmp.php">
			<i class="fa fa-address-book-o"></i>
			<span class="nav-item">Show All Employees</span>
		</a></li>
		</ul>
	</nav>
	<div class="container">
		<div class="title">Add Employee Output</div><br/>
		<div class="content">
			<p class="content_1">
				<?php
					echo "$content1";
				?>
			</p>
			<p class="content_2">
				<?php
					echo "$content2";
				?>
			</p>
		</div>
		<form action="AddEmp.php" autocomplete="on" method = "GET">
			<div class= "button">
				<input type="submit" value="GO BACK">
			</div>
		</form>
	</div>
</body>
</html>