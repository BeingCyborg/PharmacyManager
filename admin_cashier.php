<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
$fname=isset($_SESSION['first_name']) ? $_SESSION['first_name'] : 'Admin';
$lname=isset($_SESSION['last_name']) ? $_SESSION['last_name'] : 'User';
$sid=isset($_SESSION['staff_id']) ? $_SESSION['staff_id'] : 'ADMIN001';
$username=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
if(isset($_POST['update_pr'])){
$fname=$_POST['first_name'];
$lname=$_POST['last_name'];
$sid=$_POST['staff_id'];
$postal=$_POST['postal_address'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$username=$_POST['username'];
$pas=$_POST['password'];
 
// get value of id that sent from address bar
$user=$_POST['user'];

// Retrieve data from database 
$sql="UPDATE `cashier` SET `first_name`= '$fname',`last_name`= '$lname',`staff_id`= '$sid',`postal_address`='$postal',
`phone`='$phone',`email`='$email',`username`='$username',`password`='$pas' WHERE `username`='$username'";

$res=mysqli_query($con, $sql);
if($res) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin_cashier.php");

}else{
$message1="<font color=red>Update Failed, Try again</font>";
}}
if(isset($_POST['submit'])){
$fname=$_POST['first_name'];
$lname=$_POST['last_name'];
$sid=$_POST['staff_id'];
$postal=$_POST['postal_address'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$user=$_POST['username'];
$pas=$_POST['password'];
$sql1=mysqli_query($con, "SELECT * FROM cashier WHERE username='$user'")or die(mysqli_error($con));
$result=mysqli_fetch_array($sql1);
if($result>0){
$message="<font color=blue>sorry the username entered already exists</font>";
 }else{
$sql=mysqli_query($con, "INSERT INTO cashier(first_name,last_name,staff_id,postal_address,phone,email,username,password,date)
VALUES('$fname','$lname','$sid','$postal','$phone','$email','$user','$pas',NOW())");
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin_cashier.php");
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
}
	}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $username;?> - Pharmacy Management System</title>
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

        .action-icons {
            display: flex;
            gap: 1rem;
        }

        .update-icon {
            color: #3498db;
            transition: all 0.3s;
        }

        .update-icon:hover {
            color: #2980b9;
        }

        .delete-icon {
            color: #e74c3c;
            transition: all 0.3s;
        }

        .delete-icon:hover {
            color: #c0392b;
        }

        .user-id {
            font-weight: 500;
            color: #3498db;
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

        function validateForm() {
            var firstName = document.getElementById('first_name').value;
            var lastName = document.getElementById('last_name').value;
            var validName = /^[a-zA-Z\s]*$/;

            if (!validName.test(firstName)) {
                alert("First Name Cannot Contain Numerical Values");
                document.getElementById('first_name').value = "";
                document.getElementById('first_name').focus();
                return false;
            }

            if (firstName === "") {
                alert("First Name Field is Empty");
                return false;
            }

            if (!validName.test(lastName)) {
                alert("Last Name Cannot Contain Numerical Values");
                document.getElementById('last_name').value = "";
                document.getElementById('last_name').focus();
                return false;
            }

            if (lastName === "") {
                alert("Last Name Field is Empty");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div id="content">
        <div id="header">
            <div class="header-left">
                <img src="images/main_logo.jpg" alt="Logo">
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
                        <li><a href="admin.php"><i class="fas fa-home"></i>Dashboard</a></li>
                        <li><a href="admin_pharmacist.php"><i class="fas fa-user-md"></i>Pharmacist</a></li>
                        <li><a href="admin_manager.php"><i class="fas fa-user-tie"></i>Manager</a></li>
                        <li><a href="admin_cashier.php"><i class="fas fa-cash-register"></i>Cashier</a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                    </ul>	
                </div>
            </div>

            <div id="main">
                <div class="tabbed_box">
                    <h4><i class="fas fa-cash-register"></i>Manage Cashiers</h4>
                    <div class="tabbed_area">
                        <ul class="tabs">
                            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">View Users</a></li>
                            <li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Add User</a></li>
                        </ul>

                        <div id="content_1" class="content" style="display: block;">
                            <?php if(isset($message)) echo "<div class='error-message'>$message</div>"; ?>
                            <?php if(isset($message1)) echo "<div class='error-message'>$message1</div>"; ?>
                            <?php
                            $result = mysqli_query($con, "SELECT * FROM cashier") 
                                    or die(mysqli_error($con));
                            
                            echo "<table>";
                            echo "<tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                    <th>Actions</th>
                                  </tr>";

                            while($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo '<td><span class="user-id">#' . $row['cashier_id'] . '</span></td>';
                                echo '<td>' . $row['first_name'] . '</td>';
                                echo '<td>' . $row['last_name'] . '</td>';
                                echo '<td>' . $row['username'] . '</td>';
                                echo '<td class="action-icons">
                                        <a href="update_cashier.php?username=' . $row['username'] . '&fname=' . $row['first_name'] . '" 
                                           title="Update User">
                                            <i class="fas fa-edit update-icon"></i>
                                        </a>
                                        <a href="delete_cashier.php?cashier_id=' . $row['cashier_id'] . '" 
                                           onclick="return confirm(\'Are you sure you want to delete this cashier?\');"
                                           title="Delete User">
                                            <i class="fas fa-trash delete-icon"></i>
                                        </a>
                                      </td>';
                                echo "</tr>";
                            }
                            echo "</table>";
                            ?>
                        </div>

                        <div id="content_2" class="content">
                            <?php if(isset($message)) echo "<div class='error-message'>$message</div>"; ?>
                            <?php if(isset($message1)) echo "<div class='error-message'>$message1</div>"; ?>
                            
                            <form name="form1" onsubmit="return validateForm();" action="admin_cashier.php" method="post">
                                <div class="form-group">
                                    <input name="first_name" type="text" placeholder="First Name" required="required" id="first_name" />
                                </div>
                                <div class="form-group">
                                    <input name="last_name" type="text" placeholder="Last Name" required="required" id="last_name" />
                                </div>
                                <div class="form-group">
                                    <input name="staff_id" type="text" placeholder="Staff ID" required="required" id="staff_id"/>
                                </div>
                                <div class="form-group">
                                    <input name="postal_address" type="text" placeholder="Address" required="required" id="postal_address" />
                                </div>
                                <div class="form-group">
                                    <input name="phone" type="tel" placeholder="Phone" required="required" id="phone" />
                                </div>
                                <div class="form-group">
                                    <input name="email" type="email" placeholder="Email" required="required" id="email" />
                                </div>
                                <div class="form-group">
                                    <input name="username" type="text" placeholder="Username" required="required" id="username" />
                                </div>
                                <div class="form-group">
                                    <input name="password" type="password" placeholder="Password" required="required" id="password"/>
                                </div>
                                <div class="form-group" style="text-align: center;">
                                    <button type="submit" name="submit" class="submit-btn">Add Cashier</button>
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
