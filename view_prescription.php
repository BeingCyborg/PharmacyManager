<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['manager_id'];
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_name'];
$sid=$_SESSION['staff_id'];
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
            justify-content: space-between;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-right {
            text-align: right;
        }

        .user-info {
            color: #2c3e50;
            font-size: 0.9rem;
        }

        .user-name {
            font-weight: 600;
            color: #3498db;
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
            background: white;
            margin: 1rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .tabbed_box {
            padding: 1rem;
        }

        .tabbed_box h4 {
            color: #2c3e50;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .tabbed_box h4 i {
            color: #3498db;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e1e8f0;
        }

        th {
            background: #f8fafc;
            font-weight: 600;
            color: #2c3e50;
        }

        tr:hover {
            background: #f8fafc;
        }

        .prescription-id {
            font-weight: 500;
            color: #3498db;
        }

        .strength-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            background: #e1f0ff;
            color: #3498db;
        }

        .quantity-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            background: #e1f7ea;
            color: #27ae60;
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

            #header {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
                padding: 1rem;
            }

            .header-left {
                flex-direction: column;
            }

            .header-right {
                text-align: center;
            }

            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div id="content">
        <div id="header">
            <div class="header-left">
                <img src="images/main_logo.png" alt="Logo">
                <h1>Pharmacy Management System</h1>
            </div>
            <div class="header-right">
                <div class="user-info">
                    Welcome, <span class="user-name"><?php echo $fname." ".$lname; ?></span><br>
                    Staff ID: <?php echo $sid; ?>
                </div>
            </div>
        </div>
        
        <div class="dashboard-container">
            <div id="left_column">
                <div id="button">
                    <ul>
                        <li><a href="manager.php"><i class="fas fa-home"></i>Dashboard</a></li>
                        <li><a href="view.php"><i class="fas fa-users"></i>View Users</a></li>
                        <li><a href="view_prescription.php"><i class="fas fa-prescription"></i>View Prescriptions</a></li>
                        <li><a href="stock.php"><i class="fas fa-box"></i>Manage Stock</a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                    </ul>	
                </div>
            </div>

            <div id="main">
                <div class="tabbed_box">
                    <h4><i class="fas fa-prescription"></i>View Prescriptions</h4>
                    <div class="tabbed_area">
                        <?php
                        // get results from database
                        $result = mysqli_query($con, "SELECT * FROM prescription") 
                                or die(mysqli_error($con));
                        
                        echo "<table>";
                        echo "<tr>
                                <th>Prescription ID</th>
                                <th>Drug Name</th>
                                <th>Strength</th>
                                <th>Dose</th>
                                <th>Quantity</th>
                              </tr>";

                        while($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo '<td><span class="prescription-id">#' . $row['prescription_id'] . '</span></td>';
                            echo '<td>' . $row['drug_name'] . '</td>';
                            echo '<td><span class="strength-badge">' . $row['strength'] . '</span></td>';
                            echo '<td>' . $row['dose'] . '</td>';
                            echo '<td><span class="quantity-badge">' . $row['quantity'] . '</span></td>';
                            echo "</tr>";
                        }
                        echo "</table>";
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="footer">
            Developed By BeingCyborg
        </div>
    </div>
</body>
</html>