<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css" />
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<style>
body {
    background-image: url('images/books.jpg');
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    height: 100vh;
}

.innerdiv img {
    width: 100vw;
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
    /* width: 500px; */
    margin: 10px;
    margin-left: 0px;
}

input {
    margin-left: 20px;
}

.leftinnerdiv {
    float: left;
    width: 25%;
    border-radius: 10px;
}

.rightinnerdiv {
    float: right;
    width: 75%;
}

.rightinnerdiv:hover {
    border-radius: 40px;
    transition: border-radius 0.8s ease;
}

.innerright {
    margin-top: 10px;
    background-color: #66bfbf;
    opacity: 0.9;
    border-radius: 10px;
}

.innerright:hover {
    border-radius: 40px;
    transition: border-radius 0.8s ease;
}

.greenbtn {
    background-color: gray;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    border-color: #66BFBF;
    width: 95%;
    height: 40px;
    margin-top: 35px;
}

.sidebtn {
    background-color: gray;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    border-color: #66BFBF;
    width: 95%;
    height: 40px;
    margin-top: 20px;
}

.greenbtn:hover {
    cursor: pointer;
    background-color: #57b5da;
    border-radius: 30px;
    border: 3px dashed gray;
    transition: border-radius 0.8s ease;
}

.sidebtn :hover {
    background-color: #57b5da;
    border-radius: 30px;
    border: 3px dashed gray;
    transition: border-radius 0.8s ease;

}

.greenbtn,
a {
    text-decoration: none;
    color: white;
    font-size: 1rem;
}

.imglogo {
    opacity: 0.8;
    height: 22rem;
    width: 80%;
    border-radius: 20px;
    border: 5px solid white;
}

.imglogo:hover {
    opacity: 1;
    border-radius: 10rem;
    transition: border-radius 1s ease;
}

th {
    background-color: orange;
    color: black;
}

td {
    background-color: #fed8b1;
    color: black;
}

td,
a {
    color: black;
}

#addbook,
label {
    margin: 10px 70px 0px 0px;
    text-align: center;
}

#addbook input {
    margin: 6px 0px 10px 0px;
    text-align: center;
    border: 3px solid #F9CEEE;
    padding: 3px;
}

#addbook input:hover {
    border-radius: 20px;
    transition: border-radius 0.8s ease;
}

#branchid {
    margin-right: 70px;
}

#branchid label {
    padding-right: 130px;
}
</style>

<body>


    <?php
    include("data_class.php");

    $msg = "";

    if (!empty($_REQUEST['msg'])) {
        $msg = $_REQUEST['msg'];
    }

    if ($msg == "done") {
        echo "<div class='alert alert-success' role='alert'>Sucssefully Done</div>";
    } elseif ($msg == "fail") {
        echo "<div class='alert alert-danger' role='alert'>Fail</div>";
    }

    ?>



    <div class="container">
        <div class="innerdiv">
            <div class="row"><img class="imglogo" src="images/virtualbookroomyellow.png" /></div>
            <div class="leftinnerdiv">
                <Button class="greenbtn" onclick="openpart('addbook')">ADD BOOK</Button>
                <Button class="greenbtn" onclick="openpart('bookreport')"> BOOK REPORT</Button>
                <Button class="greenbtn" onclick="openpart('bookrequestapprove')"> BOOK REQUESTS</Button>
                <Button class="greenbtn" onclick="openpart('addperson')"> ADD USER</Button>
                <Button class="greenbtn" onclick="openpart('studentrecord')"> USER REPORT</Button>
                <Button class="greenbtn" onclick="openpart('issuebook')"> ISSUE BOOK</Button>
                <Button class="greenbtn" onclick="openpart('issuebookreport')"> ISSUE REPORT</Button>
                <a href="index.php"><Button class="greenbtn"> LOGOUT</Button></a>
            </div>

            <div class="rightinnerdiv">
                <div id="bookrequestapprove" class="innerright portion" style="display:none">
                    <Button class="greenbtn">BOOK REQUEST APPROVE</Button>

                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->requestbookdata();
                    $recordset = $u->requestbookdata();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Person Name</th><th>person type</th><th>Book name</th><th>Days </th><th>Approve</th> <th>Remove</th></tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        "<td>$row[1]</td>";
                        "<td>$row[2]</td>";

                        $table .= "<td>$row[3]</td>";
                        $table .= "<td>$row[4]</td>";
                        $table .= "<td>$row[5]</td>";
                        $table .= "<td>$row[6]</td>";
                        // $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approved BOOK</button></a></td>";
                        $table .= "<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approved</button></a></td>";
                        $table.="<td><a href='deleteuser_request.php?deletebookid=$row[0]'><button type='button' class='btn btn-primary'>Delete</button></a></td>";
                        $table .= "</tr>";
                        // $table.=$row[0];
                    }
                    $table .= "</table>";

                    echo $table;
                    ?>

                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="addbook" class="innerright portion" style="<?php if (!empty($_REQUEST['viewid'])) {
                                                                        echo "display:none";
                                                                    } else {
                                                                        echo "";
                                                                    } ?>">
                    <Button class="greenbtn">ADD NEW BOOK</Button>
                    <form action="addbookserver_page.php" method="post" enctype="multipart/form-data">
                        <label>Book Name:</label><input style="margin-right:25px" type="text" name="bookname"
                            required />
                        </br>
                        <label>Detail:</label><input style="margin-left:25px" type="text" name="bookdetail"
                            required /></br>
                        <label>Author:</label><input style="margin-left:20px" type="text" name="bookaudor"
                            required /></br>
                        <label>Publication</label><input style="margin-right:10px" type="text" name="bookpub"
                            required /></br>
                        <div id="branchid"><label>Branch:</label>
                            <div style="margin-left:-110px; display:inline"><input type="radio" name="branch"
                                    value="B.TECH" />B.TECH
                                &nbsp<input type="radio" name="branch" value="BCA" />BCA
                            </div>
                            <div style="margin-left:170px">
                                <input type="radio" name="branch" value="B.COM" />B.COM &nbsp&nbsp<input type="radio"
                                    name="branch" value="BPharma" />BPharma
                            </div>
                        </div>
                        <label>Price:</label><input style="margin-left:30px" type="number" name="bookprice"
                            required /></br>
                        <label>Quantity:</label><input type="number" name="bookquantity" required /></br>
                        <label style="padding-left: 100px">Book Photo:</label><input type="file"
                            accept="image/apng, image/avif, image/gif, image/jpeg, image/png, image/svg+xml, image/webp"
                            name="bookphoto" style="margin-left:0px" required /></br>

                        <input class="greenbtn" type="submit" value="SUBMIT" />
                        </br>
                        </br>

                    </form>

                </div>
            </div>


            <div class="rightinnerdiv">
                <div id="addperson" class="innerright portion" style="display:none">
                    <Button class="greenbtn">ADD PERSON</Button>
                    <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
                        <label>Name:</label><input type="text" name="addname" />
                        </br>
                        <label>Pasword:</label><input type="pasword" name="addpass" />
                        </br>
                        <label>Email:</label><input type="email" name="addemail" /></br>
                        <label for="typw">Choose type:</label>
                        <select name="type">
                            <option value="student">student</option>
                            <option value="teacher">teacher</option>
                        </select>

                        <input type="submit" value="SUBMIT" />
                    </form>
                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="studentrecord" class="innerright portion" style="display:none">
                    <Button class="greenbtn">USER RECORD</Button>
                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->userdata();
                    $recordset = $u->userdata();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
                    padding: 8px;'> Name</th><th>Email</th><th>Type</th><th>Remove</th></tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        $table .= "<td>$row[1]</td>";
                        $table .= "<td>$row[2]</td>";
                        $table .= "<td>$row[4]</td>";
                        $table.="<td><a href='deleteuser.php?useriddelete=$row[0]'><button type='button' class='btn btn-primary'>Delete</button></a></td>";
                        $table .= "</tr>";
                        // $table.=$row[0];
                    }
                    $table .= "</table>";

                    echo $table;
                    ?>
                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="issuebookreport" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Issue Book Record</Button>

                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->issuereport();
                    $recordset = $u->issuereport();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
                    padding: 8px;'>Issue Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Issue Type</th></tr>";

                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        $table .= "<td>$row[2]</td>";
                        $table .= "<td>$row[3]</td>";
                        $table .= "<td>$row[6]</td>";
                        $table .= "<td>$row[7]</td>";
                        $table .= "<td>$row[8]</td>";
                        $table .= "<td>$row[4]</td>";
                        //$table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                        $table .= "</tr>";
                        // $table.=$row[0];
                    }
                    $table .= "</table>";

                    echo $table;
                    ?>

                </div>
            </div>

            <!-- issue book -->
            <div class="rightinnerdiv">
                <div id="issuebook" class="innerright portion" style="display:none">
                    <Button class="greenbtn">ISSUE BOOK</Button>
                    <form action="issuebook_server.php" method="post" enctype="multipart/form-data">
                        <label for="book">Choose Book:</label>
                        <select name="book">
                            <?php
                            $u = new data;
                            $u->setconnection();
                            $u->getbookissue();
                            $recordset = $u->getbookissue();
                            foreach ($recordset as $row) {

                                echo "<option value='" . $row[2] . "'>" . $row[2] . "</option>";
                            }
                            ?>
                        </select>

                        <label for="Select Student"></label>
                        <select name="userselect">
                            <?php
                            $u = new data;
                            $u->setconnection();
                            $u->userdata();
                            $recordset = $u->userdata();
                            foreach ($recordset as $row) {
                                $id = $row[0];
                                echo "<option value='" . $row[1] . "'>" . $row[1] . "</option>";
                            }
                            ?>
                        </select>
                        <br>
                        Days<input type="number" name="days" />

                        <input type="submit" value="SUBMIT" />
                    </form>
                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="bookdetail" class="innerright portion" style="<?php if (!empty($_REQUEST['viewid'])) {
                                                                            $viewid = $_REQUEST['viewid'];
                                                                        } else {
                                                                            echo "display:none";
                                                                        } ?>">

                    <Button class="greenbtn">BOOK DETAIL</Button>
                    </br>
                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->getbookdetail($viewid);
                    $recordset = $u->getbookdetail($viewid);
                    foreach ($recordset as $row) {

                        $bookid = $row[0];
                        $bookimg = $row[1];
                        $bookname = $row[2];
                        $bookdetail = $row[3];
                        $bookauthour = $row[4];
                        $bookpub = $row[5];
                        $branch = $row[6];
                        $bookprice = $row[7];
                        $bookquantity = $row[8];
                        $bookava = $row[9];
                        $bookrent = $row[10];
                        $bookISBN = "978-1-36-".$bookid."5426-4";
                    }
                    ?>

                    <img style='height: 320px; width: 200px;border:2px solid black; float:left;margin-left:20px;border-radius:20px'
                        src="uploads/<?php echo $bookimg ?> " />
                    </br>
                    <p style="color:white"><u>Book ISBN:</u> &nbsp&nbsp<?php echo $bookISBN?></p>
                    <p style="color:white"><u>Book Name:</u> &nbsp&nbsp<?php echo $bookname ?></p>
                    <p style="color:white"><u>Book Detail:</u> &nbsp&nbsp<?php echo $bookdetail ?></p>
                    <p style="color:white"><u>Book Authour:</u> &nbsp&nbsp<?php echo $bookauthour ?></p>
                    <p style="color:white"><u>Book Publisher:</u> &nbsp&nbsp<?php echo $bookpub ?></p>
                    <p style="color:white"><u>Book Branch:</u> &nbsp&nbsp<?php echo $branch ?></p>
                    <p style="color:white"><u>Book Price:</u> &nbsp&nbsp<?php echo $bookprice ?></p>
                    <p style="color:white"><u>Book Available:</u> &nbsp&nbsp<?php echo $bookava ?></p>
                    <p style="color:white; margin-left:200px"><u>Book Rent:</u> &nbsp&nbsp<?php echo $bookrent ?></p>


                </div>
            </div>



            <div class="rightinnerdiv">
                <div id="bookreport" class="innerright portion" style="display:none">
                    <Button class="greenbtn">BOOK RECORD</Button>
                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->getbook();
                    $recordset = $u->getbook();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Book Name</th><th>Price</th><th>Qnt</th><th>Available</th><th>Rent</th></th><th>View</th><th>Delete</th></tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        $table .= "<td>$row[2]</td>";
                        $table .= "<td>$row[7]</td>";
                        $table .= "<td>$row[8]</td>";
                        $table .= "<td>$row[9]</td>";
                        $table .= "<td>$row[10]</td>";
                        $table .= "<td><a href='admin_service_dashboard.php?viewid=$row[0]'><button type='button' class='btn btn-primary'>View BOOK</button></a></td>";
                        $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'><button type='button' class='btn btn-primary'>Delete BOOK</button></a></td>";
                        $table .= "</tr>";
                        // $table.=$row[0];
                    }
                    $table .= "</table>";

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

</html>