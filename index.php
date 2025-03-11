<?php
include_once 'connect_db.php';
$message = ""; // Initialize message variable
if(isset($_POST['submit'])){
$username=$_POST['username'];
$password=$_POST['password'];
$position=$_POST['position'];
switch($position){
case 'Admin':
$result=mysqli_query($con, "SELECT admin_id, first_name, last_name, staff_id, username FROM admin WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['admin_id']=$row[0];
$_SESSION['first_name']=$row[1];
$_SESSION['last_name']=$row[2];
$_SESSION['staff_id']=$row[3];
$_SESSION['username']=$row[4];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin.php");
}else{
$message="<font color=red>Invalid login Try Again</font>";
}
break;
case 'Pharmacist':
$result=mysqli_query($con, "SELECT pharmacist_id, first_name,last_name,staff_id,username FROM pharmacist WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['pharmacist_id']=$row[0];
$_SESSION['first_name']=$row[1];
$_SESSION['last_name']=$row[2];
$_SESSION['staff_id']=$row[3];
$_SESSION['username']=$row[4];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/pharmacist.php");
}else{
$message="<font color=red>Invalid login Try Again</font>";
}
break;
case 'Cashier':
$result=mysqli_query($con, "SELECT cashier_id, first_name,last_name,staff_id,username FROM cashier WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['cashier_id']=$row[0];
$_SESSION['first_name']=$row[1];
$_SESSION['last_name']=$row[2];
$_SESSION['staff_id']=$row[3];
$_SESSION['username']=$row[4];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/cashier.php");
}else{
$message="<font color=red>Invalid login Try Again</font>";
}
break;
case 'Manager':
$result=mysqli_query($con, "SELECT manager_id, first_name,last_name,staff_id,username FROM manager WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['manager_id']=$row[0];
$_SESSION['first_name']=$row[1];
$_SESSION['last_name']=$row[2];
$_SESSION['staff_id']=$row[3];
$_SESSION['username']=$row[4];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/manager.php");
}else{
$message="<font color=red>Invalid login Try Again</font>";
}
break;
}}
echo <<<LOGIN
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #header {
            background: white;
            padding: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 10px;
        }

        .i {
            height: 60px;
            width: auto;
            margin-bottom: 5px;
        }

        .head {
            color: #2c3e50;
            font-size: 2rem;
            margin: 0;
            text-align: center;
            width: 100%;
        }

        marquee {
            color: #34495e;
            font-style: italic;
            width: 100%;
            text-align: center;
        }

        .main-content {
            display: flex;
            flex: 1;
            padding: 2rem;
            gap: 2rem;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            align-items: stretch;
        }

        .slider-container {
            flex: 1;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            height: 650px; /* Increased height */
            display: flex;
            padding: 0;
            margin: 0;
        }

        .rslides {
            position: relative;
            list-style: none;
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .rslides li {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .rslides img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 10px;
            flex: 1;
        }

        .login-container {
            width: 400px;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            height: 650px; /* Increased height */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-container h1 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #3498db;
            outline: none;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        .submit-btn:hover {
            background: #2980b9;
        }

        .error-message {
            color: #e74c3c;
            margin-bottom: 1rem;
            text-align: center;
        }

        #footer {
            background: white;
            padding: 1rem;
            text-align: center;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        }

        .about-link {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s;
        }

        .about-link:hover {
            color: #2980b9;
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }

            .login-container {
                width: 100%;
            }

            .head {
                font-size: 1.4rem;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="home_page/js/responsiveslides.min.js"></script>
    <script>
        $(function () {
            $("#slider1").responsiveSlides({
                auto: true,
                speed: 1000,
                timeout: 4000,
                pager: true,
                nav: true
            });
        });
    </script>
</head>
<body>
    <div id="header">
        <img class="i" src="images\plogo.png" alt="Pharmacy Logo">
        <h1 class="head">Pharmacy Management System</h1>
        <marquee>"It is easy to get a thousand prescriptions, but hard to get one single remedy"</marquee>
    </div>

    <div class="main-content">
        <div class="slider-container">
            <ul class="rslides" id="slider1">
                <li><img src="home_page/images/7.jpg" alt="Pharmacy Image 2"></li>
            </ul>
        </div>

        <div class="login-container">
            <h1>Welcome Back</h1>
            <div class="error-message">$message</div>
            <form method="post" action="index.php">
                <div class="form-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <select name="position" required>
                        <option value="">Select Position</option>
                        <option>Admin</option>
                        <option>Pharmacist</option>
                        <option>Cashier</option>
                        <option>Manager</option>
                    </select>
                </div>
                <button type="submit" name="submit" class="submit-btn">
                    Login
                </button>
            </form>
        </div>
    </div>

    <div id="footer">
        <p>Developed By BeingCyborg</p>
    </div>
</body>
</html>
LOGIN;
?>
