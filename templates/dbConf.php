<?php
    $dbServername = "project-db-1.cttdfawvgzey.us-east-1.rds.amazonaws.com";
    $dbUsername = "admin";
    $dbPassword = "12345678";
    $dbName = "employees";
    
    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    $sql = "SHOW TABLES LIKE 'employee'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck == 0){
        $sql = "CREATE TABLE employee(
            emp_id INT(4) NOT NULL,
            first_name VARCHAR(256) NOT NULL,
            last_name VARCHAR(256) NOT NULL,
            pri_skill VARCHAR(256) NOT NULL,
            locations VARCHAR(256) NOT NULL,
            images VARCHAR(256),
            images_key VARCHAR(256),
            PRIMARY KEY(emp_id)
        );";
        $result = mysqli_query($conn, $sql);
    }
?>