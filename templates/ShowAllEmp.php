<?php
	include 's3Config.php';
	include 'dbConf.php';
    $sql = "SELECT * FROM employee;";
	$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Employees</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display All</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
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
        font-size: 30px;
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
</head>
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
        <div class="title">Employees Table</div><br/>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Emp ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Primary Skill</th>
                    <th scope="col">Locations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                        $emp_id = $row['emp_id'];
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $pri_skill = $row['pri_skill'];
                        $locations = $row['locations'];
                        echo '<tr>
                        <th scope="row">'.$emp_id.'</th>
                        <td>'.$first_name.'</td>
                        <td>'.$last_name.'</td>
                        <td>'.$pri_skill.'</td>
                        <td>'.$locations.'</td>
                        </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>