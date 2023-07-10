<?php
    session_start();
    if (!isset($_SESSION['name'])) 
    {
        header("Location: index.php");
    }
    include_once('./QueryClasses/connect.php');
    include_once('./QueryClasses/VoucherQuery.php');
    $OBJECT_VOUCHER = new VoucherQuery();

    $name = $_SESSION['name'];
    $emp_code = $_SESSION['emp_code'];
    $region_fo_code = $_SESSION['REGION_FO_CODE'];

    if(isset($_POST['submit']))
    {
        $REGISTRATION_NO = $_POST['registration'];
        $EMP_AREA_CODE = substr($REGISTRATION_NO, 0, 3);
        $EMP_REG_SERIAL_NO = substr($REGISTRATION_NO,3);

	if(isset($_POST['sub_code']) and strlen($_POST['sub_code']) > 0)
        {
            $SUB_CODE = $_POST['sub_code'];
            $EMP_SUB_AREA_CODE = substr($SUB_CODE, 0,2);
            $EMP_SUB_SERIAL_NO = substr($SUB_CODE, 2);
        } 
        else
        {
            $SUB_CODE = ' ';
            $EMP_SUB_AREA_CODE = ' ';
            $EMP_SUB_SERIAL_NO = 0;
        }

        $_SESSION['REGISTRATION_NO'] = $REGISTRATION_NO;
        
       	$STATEMENT_EMPLOYEER_NAME_QUERY = oci_parse($cb_conn, $OBJECT_VOUCHER->getEmpName($EMP_AREA_CODE, $EMP_REG_SERIAL_NO, $EMP_SUB_AREA_CODE, $EMP_SUB_SERIAL_NO));
        oci_execute($STATEMENT_EMPLOYEER_NAME_QUERY);
        $EMPLOYER_NAME_ARRAY = oci_fetch_assoc($STATEMENT_EMPLOYEER_NAME_QUERY);
        $EMPLOYER_NAME = $EMPLOYER_NAME_ARRAY['NAME_OF_ESTABLISHMENT'];

        $_SESSION['NAME_OF_ESTABLISHMENT'] = $EMPLOYER_NAME;

        

        $_SESSION['SUB_CODE'] = $SUB_CODE;

        header("Location: GENERATE_FORM.php");
        
    }
    if(isset($_POST['SEARCH_VOUCHER']))
    {
        $_SESSION['REGISTRATION_NUMBER'] = $_POST['registration'];
        $_SESSION['SUB_CODE'] = $_POST['sub_code'];
        $_SESSION['FROM_DATE'] = $_POST['from_Date'];
        $_SESSION['TO_DATE'] = $_POST['to_Date'];

        header("Location: DELETE_VOUCHER_QUERY.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOUCHER FORM</title>
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!--Moment JS-->
    <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
    <!--Bootstrap js-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!--bootstrap datetimepicker js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

    <!--bootstrap datetimepicker css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">

    <!--bootstrap css-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <style>
        .my_alignment 
        {
            margin: 2% 0%;
            float: right;
        }
        .my_image 
        {
            width: 70px;
            height: 70px;
            border: 1px solid black;
            float: right;
            padding: 0px;
            margin: 2%;
        }
        .content:before 
        {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
            display: block;
            background-image: url('./images/background.png');
            background-size:cover;
            width: 100%;
            height: 100%;
            -webkit-filter: blur(7px);
            -moz-filter: blur(7px);
            -o-filter: blur(7px);
            -ms-filter: blur(7px);
            filter: blur(7px);
        }
        .content 
        {

            position: relative;
        }
        hr 
        {
            border:none;
            height: 20px;
            width: 90%;
            height: 50px;
            margin-top: 0;
            border-bottom: 0.5px solid black;
            box-shadow: 0px 20px 10px -20px #333;
            margin: -50px auto 10px;
        }
        .form
        {
            width: 70%;
            height: 210px;
            padding: 2em;
            border-radius: 10px;
            margin: 0 auto;
            background: rgb(255,255,255);
        }
        fieldset{
            text-align: center;
            text-transform: uppercase;
            
        }
        legend {
            display: block;
            width: 100%;
            padding: 0;
            margin-bottom: 20px;
            font-size: 25px;
            line-height: normal;
            color: black;
            border: 0;
            border-bottom: 6px solid #764C1E;
        }
        .btn1
        {

            width: 239px;
            height: 33px;
            background: green;
            color: white;
            border: none;
        }
    </style>
</head>
<body class="container content">
    <p>
		<center>
            <img src="./images/eobi_logo.png">
            <font size="6" style="color:green">EOBI's FACILITIATION SYSTEM</font>
        </center>
        <div class="my_image">
            <img src="./images/user.png" alt="" class="img-circle" width="68" height="68">
        </div>
        <div class = "my_alignment">
            <font><?php echo $name; ?></font> <br>
            <a href="index.php" style="color: red"><span class="glyphicon glyphicon-log-out" ></span> Log out</a>
        </div>
	</p>
    <br><br><br><br><br><br>
    <a href="./Archive_Report.php" style="color: #2b669a">
		<button  type="button" class="btn btn-default btn-lg" style="background-color: #3fa65a;">
			<span class="glyphicon glyphicon-home" ></span> ARCHIVE
		</button>
	</a>

    <button type="button" class="btn btn-default btn-lg deletevoucherbtn" style="background-color: red; float: right;">
		<span class="glyphicon glyphicon-trash" ></span> DELETE VOUCHER
	</button>

    <br><br><br>
    <form class="form" method = 'POST'>
        <fieldset>
            <legend>VOUCHER FORM</legend>
        </fieldset>
        <div class="row form-group">
            <div class="col-md-6" >
		    	<label for="registration">REGISTRATION NUMBER : <b style="color: red">*</b></label>
		    	<input type="text" class="form-control" id="registration"  name = 'registration' style="border: 3px solid black;" placeholder="ENTER REGISTRATION NUMBER " required/>
		    </div>
            <div class="col-md-6" >
		    	<label for="subcode">SUB CODE : </label>
		    	<input type="text" class="form-control" id="subcode"  name = 'sub_code' style="border: 3px solid black;" placeholder="ENTER SUB CODE : "/>
		    </div>
        </div>
        <div class="col-md-12">
            <center>
                <input type="submit" name = 'submit' value="SUBMIT" class="btn1">
            </center>
        </div>
    </form>

    <div class="modal fade" id="DELETE_VOUCHER" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel"> DELETE VOUCHER </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
                </div>
                <form method = "POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="registration">REGISTRATION NUMBER : <b style="color: red">*</b></label>
                            <input type="text" class="form-control"  name = 'registration' style="border: 3px solid black;" required />
                        </div>
                        <div class="form-group">
                            <label for="subcode">SUB CODE : </label>
                            <input type="text" class="form-control"  name = 'sub_code' style="border: 3px solid black;"/>
                        </div>
                        <div class="form-group">
                            <label for="from_Date">FROM DATE : <b style="color: red">*</b> :</label>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type="text" class="form-control" style="border: 3px solid black;" placeholder="FROM DATE" name="from_Date" required>
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>	      
                        </div>
                        <div class="form-group">
                            <label for="to_Date">TO DATE : <b style="color: red">*</b> :</label>
                            <div class='input-group date' id='datetimepicker2'>
                            <input type="text" class="form-control" style="border: 3px solid black;" placeholder="TO DATE" name="to_Date" required>
                            <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            </div>	 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="SEARCH_VOUCHER" class="btn btn-primary">SEARCH VOUCHER</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    $(document).ready(function () {
        $('.deletevoucherbtn').on('click', function () {
            $('#DELETE_VOUCHER').modal('show');
        });
    });
    $(document).ready(function () {
		var currentDate = $('#datetimepicker1').datetimepicker({
		format: '01-MMM-YYYY',
	});
	});
    $(document).ready(function () {
		var currentDate = $('#datetimepicker2').datetimepicker({
		format: 'DD-MMM-YYYY',
	});
	});
</script>