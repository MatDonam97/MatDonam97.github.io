<?php require_once('inc/connection.php'); ?>
<?php 

	$query = "SELECT NIC,name,email,address FROM admin";

	$result_set = mysqli_query($connection, $query);

	if ($result_set){

		$table = '<table>';
		$table .= '<tr><th>NIC Number</th><th>Administrator Name</th><th>Email address</th><th>Address</th></tr>';

		while ($record = mysqli_fetch_assoc($result_set)){
			$table .= '<tr>';
			$table .= '<td>' . $record['NIC'] . '</td>';
			$table .= '<td>' . $record['name'] . '</td>';
			$table .= '<td>' . $record['email'] . '</td>';
			$table .= '<td>' . $record['address'] . '</td>';
			
			$table .= '</tr>';
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Administrators</title>
	<style>
		table {border-collapse: collapse;} 
		td, th {border: 1px solid black; padding: 10px;}
	</style>
	<link href = "../style/css/bootstrap.min.css" rel = "stylesheet">
	<link rel="stylesheet" href="styles.css">

</head>
<body background = "../style/images/image9.jpg">
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="adminhomepage.php">Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="busses.php">View Buses</a>
                </li>
                <li>
                    <a href="busroutes.php">View Routes</a>
                </li>
                <li>
                    <a href="userlist.php">View Customers</a>
                </li>

                <li>
                    <a href="owner_list.php" >View Bus Owners</a>
                </li>

                <li>
                    <a href="admin_list.php" >View Admins</a>
                </li>

                <li>
                    <a href="admin_new_password.php" >Change Password</a>
                </li>

                <li style="position:absolute; top: 0;right: 0">
                    <a href="../index.html" style="text-align:right;">Sign Out</a>
                </li>


            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<body>
	<header>
		<h1>Administrators</h1>
	</header>

	<?php echo "$table"; ?>
	<p><input type="submit" value="Add" name="add_admin" onclick= "parent.location=('add_admin.php')"></p>
	
</body>
</html>

<?php mysqli_close($connection); ?>