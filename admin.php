<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $user;?> - Pharmacy Management System</title>
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
            background: #f5f7fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        #header {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        #header img {
            height: 50px;
            width: auto;
        }

        #header h1 {
            color: #2c3e50;
            font-size: 1.8rem;
            margin: 0;
        }

        .dashboard-container {
            display: flex;
            flex: 1;
        }

        #left_column {
            width: 250px;
            background: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            padding: 2rem 0;
        }

        #button ul {
            list-style: none;
        }

        #button ul li {
            margin-bottom: 0.5rem;
        }

        #button ul li a {
            display: flex;
            align-items: center;
            padding: 0.75rem 2rem;
            color: #2c3e50;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
        }

        #button ul li a:hover {
            background: #3498db;
            color: white;
        }

        #button ul li a i {
            margin-right: 10px;
            width: 20px;
        }

        #main {
            flex: 1;
            padding: 2rem;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }

        .dashboard-module {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            text-decoration: none;
            color: #2c3e50;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .dashboard-module:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .dashboard-module img {
            width: 60px;
            height: 60px;
            margin-bottom: 1rem;
            border-radius: 10px;
        }

        .dashboard-module span {
            display: block;
            font-weight: 500;
            margin-top: 0.5rem;
        }

        #footer {
            background: white;
            padding: 1rem;
            text-align: center;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            color: #2c3e50;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }

            #left_column {
                width: 100%;
            }

            #header h1 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
    <div id="content">
        <div id="header">
            <img src="images/main_logo.png" alt="Logo">
            <h1>Pharmacy Management System</h1>
        </div>
        
        <div class="dashboard-container">
            <div id="left_column">
                <div id="button">
                    <ul>
                        <li><a href="admin.php"><i class="fas fa-home"></i>Dashboard</a></li>
                        <li><a href="admin_pharmacist.php"><i class="fas fa-user-md"></i>Pharmacist</a></li>
                        <li><a href="admin_manager.php"><i class="fas fa-user-tie"></i>Manager</a></li>
                        <li><a href="admin_cashier.php"><i class="fas fa-cash-register"></i>Cashier</a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                    </ul>	
                </div>
            </div>

            <div id="main">
                <div class="dashboard-grid">
                    <a href="admin.php" class="dashboard-module">
                        <img src="images/admin_icon.jpg" alt="Admin Dashboard">
                        <span>Dashboard</span>
                    </a>
                    <a href="admin_pharmacist.php" class="dashboard-module">
                        <img src="images/pharmacist_icon.jpg" alt="Pharmacist">
                        <span>Pharmacist</span>
                    </a>
                    <a href="admin_manager.php" class="dashboard-module">
                        <img src="images/manager_icon.png" alt="Manager">
                        <span>Manager</span>
                    </a>
                    <a href="admin_cashier.php" class="dashboard-module">
                        <img src="images/cashier_icon.jpg" alt="Cashier">
                        <span>Cashier</span>
                    </a>
                </div>
            </div>
        </div>

        <div id="footer">
        Developed By BeingCyborg
        </div>
    </div>
</body>
</html>
