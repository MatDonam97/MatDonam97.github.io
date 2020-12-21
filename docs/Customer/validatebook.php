<?php
/*
Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password)
*/

// role id take it from session
session_start();
$username= $_SESSION['username'];
$role_id =[ 'NIC'];

$link = mysqli_connect("localhost", "root","","busticketing");
//$bus_no=mysqli_query($link,"SELECT");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$route_name = $_POST['route_no'];
$registration_no= $_POST['registration_no'];
$first_station = $_POST['first_station'];
$second_station = $_POST['second_station'];
$date = mysqli_real_escape_string($link, $_POST['date']);
$time = $_POST['time'];
$seats = $_POST['seats'];
$id_no = $_POST['id_no'];


// attempt search query execution - search for the required bus
$sql = "SELECT IFNULL((SELECT seats_available FROM active_busses WHERE route_no= '$route_name' AND start_loc= '$first_station' AND end_loc='$second_station' AND date='$date' AND time='$time'),'not found')";
$key = "IFNULL((SELECT seats_available FROM active_busses WHERE route_no='$route_name' AND start_loc= '$first_station' AND end_loc='$second_station'  AND date='$date' AND time='$time'),'not found')";
$result = mysqli_query( $link,$sql) or die('Could not look up user information; ' . mysqli_error($link));
$row  = mysqli_fetch_array($result,MYSQLI_ASSOC);

$has_bus = true ;
if($row==NULL){
    echo '<script type="text/javascript">alert("Unfortunately there is not a bus available for your need."); </script>';
    echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>";
    $has_bus = false;
}
/*if($row[$key] < $seats){
    echo '<script type="text/javascript">alert("Unfortunately there is not a bus available for your need."); </script>';
    echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>";
    $has_bus = false;
}*/
else{
    // bus is available and need to extract the bus number
    $sql2 = "SELECT bus_id FROM active_busses WHERE route_no='$route_name' AND start_loc='$first_station' AND end_loc='$second_station' AND date='$date' AND time='$time'";
    $result2 = mysqli_query( $link,$sql2) or die('Could not look up user information; ' . mysqli_error($link));
    $row2  = mysqli_fetch_array($result2,MYSQLI_ASSOC);

    $bus_id = $row2['bus_id'];
    $sql_insert = "INSERT INTO active_busses ( route_no , date , time , seats_available , bus_id )
    VALUES ('$route_name', '$date', '$time', '$seats','$registration_no')";
    $result3 = mysqli_query( $link,$sql_insert) or die('Could not look up user information; ' . mysqli_error($link));
//bookings updation
    $sql_insert0 = "INSERT INTO bookings ( id_no , date , time , seats , bus_id )
    VALUES ('$id_no', '$date', '$time', '$seats','$registration_no')";
    // update active bookings table
  //  $sql_update = "UPDATE bookings SET seats = seats - $seats WHERE route_no='$route_name' AND date='$date' AND time='$time' AND seats_available > 0  ;";
    $result4 = mysqli_query( $link,$sql_insert) or die('Could not look up user information; ' . mysqli_error($link));
     $result5= mysqli_query($link,'SELECT bus_id FROM active_busses');
    if($has_bus){
		$row = mysqli_fetch_array($result5);
		$id = $row['bus_id'];
        echo "<div align='center'><h2>Your booking has been succesfully placed. Your bus number is : </h2></div>";
        echo "<div align='center'><h1>".$id."</h1></div>" ;
        //echo "<div align='center'><h3> Your NIC number is '.$role_id'.. Bring your NIC as a proof of booking.</h3></div>" ;
    }

}



// close connection
mysqli_close($link);
?>