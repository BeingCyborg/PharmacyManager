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
if(isset($_POST['submit'])){
$cname=$_POST['customer_name'];
$drug_id=$_POST['drug_id'];
$drug_name=$_POST['drug_name'];
$quantity=$_POST['quantity'];
$cost=$_POST['cost'];
$tax=null;

$sql=mysqli_query($con, "INSERT INTO invoice(customer_name,drug_id,drug_name,quantity,cost,tax)
VALUES('$cname','$drug_id','$drug_name','$quantity','$cost','$tax')");
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/invoice.php");
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
}
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
        }

        .tabs {
            list-style: none;
            display: flex;
            gap: 1rem;
            border-bottom: 2px solid #e1e8f0;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }

        .tabs li a {
            text-decoration: none;
            color: #7f8c8d;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .tabs li a.active {
            background: #3498db;
            color: white;
        }

        .content {
            display: none;
            padding: 1rem;
        }

        .content.active {
            display: block;
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

        .delete-icon {
            color: #e74c3c;
            transition: all 0.3s;
        }

        .delete-icon:hover {
            color: #c0392b;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-group input:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }

        .submit-btn {
            background: #3498db;
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }

        .submit-btn:hover {
            background: #2980b9;
        }

        .error-message {
            color: #e74c3c;
            margin-bottom: 1rem;
            text-align: center;
        }

        .total-revenue {
            margin-top: 2rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 10px;
            color: #2c3e50;
            font-size: 1.1rem;
            font-weight: 500;
            text-align: right;
        }

        .total-revenue span {
            color: #27ae60;
            font-weight: 600;
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

            .tabs {
                flex-direction: column;
                gap: 0.5rem;
            }

            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
    <script>
        function tabSwitch(tab, content) {
            document.querySelectorAll('.tabs a').forEach(a => a.classList.remove('active'));
            document.getElementById(tab).classList.add('active');
            
            document.querySelectorAll('.content').forEach(div => div.style.display = 'none');
            document.getElementById(content).style.display = 'block';
        }

        function validateForm(form) {
            return true; // Add validation logic here if needed
        }
    </script>
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
                        <li><a href="view_prescription.php"><i class="fas fa-prescription"></i>View Prescription</a></li>
                        <li><a href="invoice.php"><i class="fas fa-file-invoice"></i>Manage Invoices</a></li>
                        <li><a href="stock.php"><i class="fas fa-box"></i>Manage Stock</a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                    </ul>	
                </div>
            </div>

            <div id="main">
                <div class="tabbed_box">
                    <h4>Manage Invoices</h4>
                    <div class="tabbed_area">
                        <ul class="tabs">
                            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">View Invoices</a></li>
                            <li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Add New Invoice</a></li>
                        </ul>

                        <div id="content_1" class="content" style="display: block;">
                            <?php if(isset($message)) echo "<div class='error-message'>$message</div>"; ?>
                            <?php if(isset($message1)) echo "<div class='error-message'>$message1</div>"; ?>
                            <?php
                            $result = mysqli_query($con, "SELECT * FROM invoice") 
                                    or die(mysqli_error($con));
                            
                            echo "<table>";
                            echo "<tr>
                                    <th>Invoice No</th>
                                    <th>Drug ID</th>
                                    <th>Drug Name</th>
                                    <th>Quantity</th>
                                    <th>Cost</th>
                                    <th>Tax</th>
                                    <th>Action</th>
                                  </tr>";

                            while($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo '<td>' . $row['invoice_no'] . '</td>';
                                echo '<td>' . $row['drug_id'] . '</td>';
                                echo '<td>' . $row['drug_name'] . '</td>';
                                echo '<td>' . $row['quantity'] . '</td>';
                                echo '<td>$' . number_format($row['cost'], 2) . '</td>';
                                echo '<td>' . ($row['tax'] ? $row['tax'] . '%' : 'N/A') . '</td>';
                                echo '<td>
                                        <a href="delete_invoice.php?invoice_no=' . $row['invoice_no'] . '" 
                                           onclick="return confirm(\'Are you sure you want to delete this invoice?\');">
                                            <i class="fas fa-trash delete-icon"></i>
                                        </a>
                                      </td>';
                                echo "</tr>";
                            }
                            echo "</table>";

                            // Calculate total revenue
                            $db_host="localhost";
                            $db_name="pms";
                            $db_user="root";
                            $db_pass="";
                            $con = mysqli_connect("$db_host","$db_user","$db_pass") or die ("could not connect");
                            mysqli_select_db($con,'pms') or die(mysqli_error($con));
                            $p0=mysqli_query($con, "call total_revenue(@out);");
                            $rs=mysqli_query($con, 'SELECT @out');
                            while ($arr=mysqli_fetch_row($rs)) {
                                echo '<div class="total-revenue">Total Revenue: <span>Rs. ' . number_format($arr[0], 2) . '</span></div>';
                            }
                            mysqli_close($con);
                            ?>
                        </div>

                        <div id="content_2" class="content">
                            <?php if(isset($message)) echo "<div class='error-message'>$message</div>"; ?>
                            <?php if(isset($message1)) echo "<div class='error-message'>$message1</div>"; ?>
                            
                            <form name="myform" onsubmit="return validateForm(this);" action="invoice.php" method="post">
                                <div class="form-group">
                                    <input name="customer_name" type="text" placeholder="Customer Name" required="required" id="customer_name"/>
                                </div>
                                <div class="form-group">
                                    <input name="drug_id" type="text" placeholder="Drug ID" required="required" id="drug_id" />
                                </div>
                                <div class="form-group">
                                    <input name="drug_name" type="text" placeholder="Drug Name" required="required" id="drug_name" />
                                </div>
                                <div class="form-group">
                                    <input name="quantity" type="number" placeholder="Quantity" required="required" id="quantity" />
                                </div>
                                <div class="form-group">
                                    <input name="cost" type="number" step="0.01" placeholder="Cost" required="required" id="cost" />
                                </div>
                                <div class="form-group" style="text-align: center;">
                                    <button type="submit" name="submit" class="submit-btn">Create Invoice</button>
                                </div>
                            </form>
                        </div>
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
