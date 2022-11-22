<?php

session_start();

$userloginid=$_SESSION["userid"] = $_GET['userlogid'];
// echo $_SESSION["userid"];


?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>

<head>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>User Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
            id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- <link rel="stylesheet" href="style.css"> -->
    </head>
    <style>
    body {
        margin: 0px;
        background-image: url('images/bookimage.jpg');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        height: 100vh;
    }

    .innerright,
    label {
        color: white;
        font-weight: bold;
    }

    .container,
    .row,
    .imglogo {
        margin: auto;
    }

    .innerdiv {
        text-align: center;
        margin: 15px;
        margin-left: 100px;
    }

    .leftinnerdiv {
        background-color: transparent;
        border-radius: 20px;
        border: 1px solid white;
        padding: 10px;
        float: left;
        width: 25%;
    }

    .leftinnerdiv:hover {
        padding: 15px;
        transition: padding 0.8s ease;
        border: 3px solid #66bfbf;
        font-size: 2rem;
    }

    .rightinnerdiv {
        float: left;
        width: 55%;
        border-radius: 10px;
    }

    .rightinnerdiv p {
        margin-left: 9rem;
        width: 20rem;
        color: black;
        border-radius: 8px;
        border: 1px solid #57bfda;

    }

    .innerright {
        background-color: transparent;
        border-radius: 10px;
        margin-left: 10px;
    }

    .topbutton {
        background-color: gray;
        border-radius: 10px;
        color: white;
        width: 100%;
        height: 40px;
        margin-top: 10px;
        margin-left: 10px;
        border: 1px solid #66bfbf;
    }

    .topbutton:hover {
        background-color: white;
        border-radius: 20px;
        color: black;
        border: 3px solid #66bfbf;
        transition: border-radius 0.4s ease;
    }

    .greenbtn {
        background-color: gray;
        border-radius: 10px;
        color: white;
        width: 95%;
        height: 40px;
        margin-top: 10px;
        border: 1px solid #66bfbf;
    }

    .greenbtn:hover {
        background-color: white;
        border-radius: 20px;
        color: black;
        border: 3px solid #66bfbf;
        transition: border-radius 0.4s ease;
    }

    .greenbtn,
    a {
        text-decoration: none;
        color: white;
        font-size: large;
    }

    th {
        background-color: transparent;
        color: #F9CEEE;
        padding: 20px;
        border: 1px solid white;
    }

    td {
        background-color: transparent;
        padding: 20px;
        border: 1px solid white;
    }

    td:hover {
        background-color: #66bfbf;
        color: white;
    }

    td a {
        color: #F9CEEE;
        color: white;
    }

    .imglogo {
        margin-bottom: 10px;
        opacity: 0.8;
        height: 8rem;
        width: 80%;
        border-radius: 20px;
        border: 5px solid white;
    }

    .imglogo:hover {
        opacity: 1;
        border-radius: 10rem;
        transition: border-radius 1s ease;
    }
    </style>

<body>

    <?php
   include("data_class.php");
    ?>
    <div class="container">
        <div class="innerdiv">
            <div class="leftinnerdiv">
                <Button class="greenbtn" onclick="openpart('myaccount')"> My Account</Button>
                <Button class="greenbtn" onclick="openpart('requestbook')"> Request Book</Button>
                <Button class="greenbtn" onclick="openpart('issuereport')"> Book Report</Button>
                <a href="index.php"><Button class="greenbtn"> Logout</Button></a>
            </div>


            <div class="rightinnerdiv">
                <div id="myaccount" class="innerright portion"
                    style="<?php  if(!empty($_REQUEST['returnid'])){ echo "display:none";} else {echo ""; }?>">
                    <Button class="topbutton">My Account</Button>

                    <?php

            $u=new data;
            $u->setconnection();
            $u->userdetail($userloginid);
            $recordset=$u->userdetail($userloginid);
            foreach($recordset as $row){

            $id= $row[0];
            $name= $row[1];
            $email= $row[2];
            $pass= $row[3];
            $type= $row[4];
            }               
                ?>

                    <p><u>Person Name:</u> &nbsp&nbsp<?php echo $name ?></p>
                    <p><u>Person Email:</u> &nbsp&nbsp<?php echo $email ?>
                    </p>
                    <p><u>Account Type:</u> &nbsp&nbsp<?php echo $type ?></p>

                </div>
            </div>






            <div class="rightinnerdiv">
                <div id="issuereport" class="innerright portion"
                    style="<?php  if(!empty($_REQUEST['returnid'])){ echo "display:none";} else {echo "display:none"; }?>">
                    <Button class="topbutton">ISSUE RECORD</Button>

                    <?php

            $userloginid=$_SESSION["userid"] = $_GET['userlogid'];
            $u=new data;
            $u->setconnection();
            $u->getissuebook($userloginid);
            $recordset=$u->getissuebook($userloginid);

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Return</th></tr>";

            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[3]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'><button type='button' class='btn btn-primary'>Return</button></a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

                </div>
            </div>


            <div class="rightinnerdiv">
                <div id="return" class="innerright portion"
                    style="<?php  if(!empty($_REQUEST['returnid'])){ $returnid=$_REQUEST['returnid'];} else {echo "display:none"; }?>">
                    <Button class="topbutton">Return Book</Button>

                    <?php

            $u=new data;
            $u->setconnection();
            $u->returnbook($returnid);
            $recordset=$u->returnbook($returnid);
                ?>

                </div>
            </div>


            <div class="rightinnerdiv">
                <div id="requestbook" class="innerright portion"
                    style="<?php  if(!empty($_REQUEST['returnid'])){ $returnid=$_REQUEST['returnid'];echo "display:none";} else {echo "display:none"; }?>">
                    <Button class="topbutton">Request Book</Button>

                    <?php
            $u=new data;
            $u->setconnection();
            $u->getbookissue();
            $recordset=$u->getbookissue();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr>
            <th>Image</th><th>Book Name</th><th>Book Authour</th><th>branch</th><th>price</th></th><th>Request Book</th></tr>";

            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
               $table.="<td><img src='uploads/$row[1]' width='100px' height='100px' style='border:1px solid #333333;'></td>";
               $table.="<td>$row[2]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td><a href='requestbook.php?bookid=$row[0]&userid=$userloginid'><button type='button' class='btn btn-primary'>Request Book</button></a></td>";
           
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;


                ?>

                </div>
            </div>

        </div>
    </div>


    <script>
    function openpart(portion) {
        var i;
        var x = document.getElementsByClassName("portion");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        document.getElementById(portion).style.display = "block";
    }
    </script>
</body>

</html>