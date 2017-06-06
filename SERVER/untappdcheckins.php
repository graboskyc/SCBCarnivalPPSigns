<?php

$clientId = "";
$clientSecret = "";
$venueId = "";

$uri = "https://api.untappd.com/v4/venue/checkins/".$venueId."?client_id=".$clientId."&client_secret=".$clientSecret."&limit=5";

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_URL, $uri);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

//execute post
$response = curl_exec($ch);

//close connection
curl_close($ch);

$j = json_decode($response);
$checkins = $j->response->checkins->items;

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SCB Carnival</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            html, body {
                background-color: #333;
            }
            body {
                color: #fff;
            }
            .txt { 
                font-size:65px;
                font-weight:bold;
                text-align:center;
                padding-bottom:12px;
            }
            
            .txthead {
                text-decoration:underline;
                text-shadow: 0 1px 3px rgba(0,0,0,.5);
            }
        </style>
    </head>

    <body>

        <div class="container-fluid" id="cntr">
            
            <div class="row">
                <div class="col-md-6 txt txthead">Untappd User</div>
                <div class="col-md-5 txt txthead">Beer</div>
            </div>
            
            <?php
                foreach ($checkins as $c) {
                    $name = $c->user->user_name;
                    $icon = $c->user->user_avatar;
                    $beer = $c->beer->beer_name;
                    $star = $c->rating_score;

                    echo "<div class='row'>";

                    echo "<div class='col-md-2 txt'><img src='".$icon."' width='128' height='128' /></div>";
                    echo "<div class='col-md-4 txt'>".$name."</div>";  
                    echo "<div class='col-md-5 txt'>".$beer."</div>"; 

                    echo "</div>";
                }
                ?>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
    
</html>
