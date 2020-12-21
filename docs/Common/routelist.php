<?php
    $link = mysqli_connect('localhost','root',"",'busticketing');
    //mysql_select_db('blog_db',$link);
    //$result = mysqli_query($link,'SELECT route_no FROM route UNION SELECT first_station FROM route');
	$result = mysqli_query($link,'SELECT route_no,first_station FROM route');
?>

<html>
    <head>
        <title>MURIGI BUS TRANSPORT SACCO ONLINE PAYMENT SYSTEM</title>
        <link href = "https://bootswatch.com/superhero/bootstrap.min.css" rel = "stylesheet">
        <link rel="stylesheet" href="styles.css">
    </head>
    

    <body>
        

        <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <nav id="spy">
                <ul class="sidebar-nav nav">
                <?php while ($row = mysqli_fetch_assoc($result)):?>
                    <li>
                        <a href="#anch1=<?php echo $row['route_no'] ?>" data-scroll>
                            <span class="fa fa-anchor solo"><?php echo $row['first_station'] ?></span>
                        </a>
                    </li>
                    <?php endwhile ?>                    
                </ul>
            </nav>
        </div>
    </body>
</html> 