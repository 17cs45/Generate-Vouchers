<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style type="text/css">
        hr 
        {
            border:none;
            height: 20px;
            width: 90%;
            height: 50px;
            margin-top: 0;
            border-bottom: 0.5px solid lightgray;
            box-shadow: 0px 20px 10px -20px #333;
            margin: -50px auto 10px;
        }
        .shadow{
            box-shadow: -20px 20px 10px -20px lightgrey;
        }
        .container
        {
            padding: 20px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .success_heading{
            text-align: center;
            background: green;
            color: #fefefe;
            padding: 0.3em;
            text-transform: uppercase;
        }
        .error_heading{
            text-align: center;
            background: red;
            color: #fefefe;
            padding: 0.3em;
            text-transform: uppercase;
        }
    </style>
</head>
<body class="container">
    <p>
        <center><img src="images\eobi_logo.png"><font size="6" style="color:green">EOBI's Facilitation System</font> </center>
        <div class="col-xs-12"><hr></div>
        <br>
        <br>
    </p>
    <center>
	 <u> <h1 class="carousel">You have to login again with your FS ID to generate voucher</h1></u>

    </center>

    <form  method = "POST">
        <div class="row form-group">
            <div class="col-md-4 col-md-offset-4">
                <label>Username : </label>
                <input type="text" name="username" class="form-control" onkeydown="upperCaseF(this)" required/>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-4 col-md-offset-4">
                <label>Password : </label>
                <input type="password" name="password" class="form-control" required/>
            </div>
        </div>

        <input type="submit"  class="btn btn-success col-md-offset-5 col-md-2" name="login" value="Login"/>
        <br><br><br>
    </form>
</body>
</html>
<?php
    include_once('./QueryClasses/connect.php');
    include("./QueryClasses/LoginQuery.php");

    session_start();

    if(isset($_POST['login']))
    {

        $name = $_POST['username'];
        $md5_pass = md5($_POST['password']);
        $pass_itr = 0;

        while($md5_pass[$pass_itr]=='0')
        {
            $pass_itr++;
        }
        $pass = substr($md5_pass,$pass_itr,12);

        $login_query = new LoginQuery();
        $stid = oci_parse($cb_conn, $login_query->getLoginQuery($name,$pass));
        oci_execute($stid);

        if (($row = oci_fetch_array($stid, OCI_BOTH)) != false)
        {
            if ($row['DESIGNATION'] == '7')
            {
                if($row['USER_ID']==$name && $row['PASSWORD'] == $pass)
                {
                    $_POST[ 'username' ] = $row[ 'USER_ID' ];
                    $_POST[ 'role_id' ] = $row[ 'ROLE_ID' ];
                    $_POST[ 'emp_code' ] = $row[ 'EMPLOYEE_CODE' ];
                    $_POST[ 'name' ] = $row[ 'NAME' ];
                    $_POST[ 'REGION_FO_CODE' ] = $row[ 'REGION_FO_CODE' ];
                    $_SESSION = $_POST;
                    header("Location: Dashboard.php");
                }
                else
                {
                    echo '<h3 class="error_heading">INCORRECT USER ID OR PASSWORD</h3>';
                }
            }
            else
            {
                echo '<h3 class="error_heading">ONLY BEAT OFFICER CAN LOGIN</h3>';
            }
        }
    }
?>
