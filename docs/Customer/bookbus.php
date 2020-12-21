<?php
$link = mysqli_connect('localhost','root',"",'busticketing');
//mysql_select_db('busticketing',$link);
$result = mysqli_query($link,'SELECT route_no FROM route');
$result_locations = mysqli_query($link,'SELECT first_station FROM route');
$result_loc = mysqli_query($link,'SELECT second_station FROM route');
$result_bus = mysqli_query($link,'SELECT registration_no FROM bus');
?>

<html>
<head>
    <link rel="title icon" type="image/x-icon" href="../style/images/favicon.ico" />
    <!-- Bootstrap -->
    <link href = "../style/css/bootstrap.min.css" rel = "stylesheet">
    <title>MURIGI BUS TRANSPORT SACCO ONLINE PAYMENT SYSTEM</title>
    <link rel="stylesheet" href="../style/css/styles.css">
    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />


</head>
<body id="bgbody" >

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
            <a class="navbar-brand" href="#">Reserve</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li>
                    <a href="bookings.php">Bookings</a>
                </li>

                <li>
                    <a href="../about.html">About</a>
                </li>
                <li>
                    <a href="../services.html">Services</a>
                </li>
                <li>
                    <a href="../contact.html">Contact</a>
                </li>



                <li style="position: absolute; right: 50px; top: 0 ;">
                    <a href="../index.html">Sign Out</a>
                </li>




            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


<div class="container jumbotron" style="width:50%;margin-top:50px;border-radius:10px;">
    <form action="validatebook.php" method="post" class="form-horizontal" style="margin-right:10px;width:95%;">
	
	     <div class="form-group">
            <label for="id_no" class="control-label col-sm-2">ID/Passport No:</label>
            <div class="col-sm-10">
                <input type="number" name="id_no" class="form-control" id="id_no" >
            </div>
        </div>
		
        <div class="form-group">
            <label for="Name" class="control-label col-sm-2">Route:</label>
            <div class="col-sm-10">
                <select name="route_no" class="form-control dropdown-toggle btn btn-default">
                    <option >---Select Route---</option>
                    <?php while ($row = mysqli_fetch_array($result)){
						unset($route_no);
						$route_no = $row['route_no'];
					    // $first_station =$row['first_station'];
                    echo '<option value="'.$route_no.'">'.$route_no.'</option>';
                     } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="Name" class="control-label col-sm-2">Start:</label>
            <div class="col-sm-10">
                <select name="first_station" class="form-control dropdown-toggle btn btn-default">
                    <?php while ($row = mysqli_fetch_array($result_locations)){
						unset($first_station);
						$first_station = $row['first_station'];
					    // $second_station =$row['second_station'];
                        echo '<option value="'.$first_station.'">'.$first_station.'</option>';
                    } ?>
                </select>
            </div>
        </div>
		<div class="form-group">
            <label for="Name" class="control-label col-sm-2">End:</label>
            <div class="col-sm-10">
                <select name="second_station" class="form-control dropdown-toggle btn btn-default">
                    <?php while ($row = mysqli_fetch_array($result_loc)){
						unset($second_station);
						//$first_station = $row['first_station'];
					     $second_station =$row['second_station'];
                        echo '<option value="'.$second_station.'">'.$second_station.'</option>';
                    } ?>
                </select>
            </div>
        </div>

         <div class="form-group">
            <label for="bus_id" class="control-label col-sm-2">Available Bus :</label>
            <div class="col-sm-10">
                <select name="registration_no" class="form-control dropdown-toggle btn btn-default">
                    <option >---Select Bus---</option>
                    <?php while ($row = mysqli_fetch_array($result_bus)){
						unset($registration_no);
						$registration_no = $row['registration_no'];
					    // $first_station =$row['first_station'];
                    echo '<option value="'.$registration_no.'">'.$registration_no.'</option>';
                     } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="date" class="control-label col-sm-2">Date:</label>
            <div class="col-sm-10">
                <input type="text" name="date" value="<?php echo date("Y/m/d"); ?>" class="form-control" />
            </div>
        </div>
        <script type="text/javascript">
            $(function() {
                $('input[name="birthdate"]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true
                    },
                    function(start, end, label) {
                    });
            });
        </script>

        <div class="form-group">
            <label for="time" class="control-label col-sm-2">Time:</label>
            <div class="col-sm-10">
                <select name="time" class="form-control">
                    <option value="8.00 AM">8.00 AM</option>
                    <option value="9.00 AM">9.00 AM</option>
                    <option value="10.00 AM">10.00 AM</option>
                    <option value="11.00 AM">11.00 AM</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="seats" class="control-label col-sm-2">Seats needed:</label>
            <div class="col-sm-10">
                <input type="number" name="seats" class="form-control" id="seats" >
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" value="Reserve" class="btn btn-success">              &nbsp;&nbsp;&nbsp;

            </div>
        </div>

    </form>
</div>
</body>
</html>