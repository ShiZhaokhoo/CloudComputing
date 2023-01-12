<?php
	include "dbConf.php";
	$emp_id = $_POST['emp_id'];
	$sql = "SELECT * FROM employee WHERE emp_id = '$emp_id'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck == 0){
		header("location:EditEmpSuccess.php");
		exit;
	}
	$row = mysqli_fetch_assoc($result);
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$pri_skill = $row['pri_skill'];
	$locations = $row['locations'];
  $images = $row['images'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Employee Information</title>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
  input[type="button"]{
        display: block;
        cursor: pointer;
        margin: 20px auto;
        font-size: 16px;
        font-weight: 800;
        background: #4090db;
        color: white;
        border-radius: 10px;
  }
  form input[type="file"]{
    display: block;
    cursor: pointer;
    margin: 10px auto;
    font-size: 10px auto;
    font-weight: 500;
    background: #fff;
    color: black;
    border-radius: 10px;
    height: 38px;

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
    <div class="title">Employee Modification</div>
    <div class="content">
      <form action="EditEmpSuccess.php" autocomplete="on" method = "POST" enctype="multipart/form-data">
        <div class="card">
          <img src="<?php echo "$images"?>" id="myimage" width="200" height="200" style="margin-left: auto; margin-right: auto;">
        </div>
        <div class="user-details">
          <div class="input-box">
            <span class="details">Employee ID</span>
            <input type="number" id="emp_id" name="emp_id" placeholder="Enter your ID" value="<?php echo "$emp_id"?>" disabled required>
          </div>
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" value="<?php echo "$first_name"?>" required>
          </div>
          <div class="input-box">
            <span class="details">Last name</span>
            <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" value="<?php echo "$last_name"?>" required>
          </div>
          <div class="input-box">
            <span class="details">Primary Skills</span>
            <input type="text" id="pri_skill" name="pri_skill" placeholder="Enter your primary skills" value="<?php echo "$pri_skill"?>" required>
          </div>
          <div class="input-box">
            <span class="details">location</span>
            <input type="text" id="locations" name="locations" placeholder="Enter your location" value="<?php echo "$locations"?>" required>
          </div>
          <div class= "input-box">
            <span class= "details">image</span>
            <input type="file" id="images" name="images" accept="image/*" onChange="preview_2(this);" />
          </div>
        </div>
        <div class= "button">
          <input type="submit" name="submit" id="submit" onclick="return check()" value="UPDATE EMPLOYEE">
        </div>
      </form>
    </div>
  </div>

</body>
	
</html>

<script type="text/javascript">
	function check(){
		emp_id = document.getElementById("emp_id");
		first_name = document.getElementById("first_name");
		last_name = document.getElementById("last_name");
		pri_skill = document.getElementById("pri_skill");
		locations = document.getElementById("locations");
		if(emp_id.value.trim() === ""){
			alert("Employee ID required!");
			return false;
		}
		else if(first_name.value.trim() === ""){
			alert("First Name required!");
			return false;
		}
		else if(last_name.value.trim() === ""){
			alert("Last Name required!");
			return false;
		}
		else if(pri_skill.value.trim() === ""){
			alert("Primary Skills required!");
			return false;
		}
		else if(locations.value.trim() === ""){
			alert("Location required!");
			return false;
		}
		emp_id.disabled = false;
		return true;
	}
  
  function preview_2(obj)
  {
    if (FileReader)
    {
      var reader = new FileReader();
      reader.readAsDataURL(obj.files[0]);
      reader.onload = function (e) {
      var image=new Image();
      image.src=e.target.result;
      image.onload = function () {
        document.getElementById("myimage").src=image.src;
      };
      }
    }
    else
    {
          // Not supported
    }
  }
</script>