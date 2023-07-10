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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CURRENT VOUCHER DATA</title>
      <!--jQuery-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!--Bootstrap js-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

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
        .error_heading{
            text-align: center;
            background: red;
            color: #fefefe;
            padding: 0.3em;
            text-transform: uppercase;
        }
        .error
        {
            text-transform: none;
            padding-left: 4.5em;
            margin: 1.5em auto;
            background: red;
            color: #fefefe;
            font-size: 1.3em;
            width: 60%;
        }
        .success_heading{
            text-align: center;
            background: green;
            color: #fefefe;
            padding: 0.3em;
            text-transform: uppercase;
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
	<a href="./GENERATE_FORM.php" style="color: #2b669a">
		<button  type="button" class="btn btn-default btn-lg">
			<span class="glyphicon glyphicon-home" ></span> BACK
		</button>
	</a>
    
    <br><br><br>
    <center>
        <a href="./Archive_report.php" target = "_blank" id="archive" class="error" style="display: none;" >VOUCHER IS ALREADY GENERATED CLICK HERE TO DOWNLOAD</a>
    </center>
    <center>
        <h1 class="error_heading" id="contribution_error" style="display: none;">CONTRIBUTION PAYMENT CANNOT BE GREATER THAN 50000</h1>    
    </center>
    <center>
        <h1 class="success_heading" id="success" style="display: none;">VOUCHER SUCCESSFULLY GENERATED</h1>
    </center>
</body>
</html>
<?php
    $REGISTRATION_NO = $_POST['registration'];
    $EMP_AREA_CODE = substr($REGISTRATION_NO, 0, 3);
    $EMP_REG_SERIAL_NO = substr($REGISTRATION_NO,3);
    if(strlen($_POST['sub_code']) > 1)
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
    $FROM_DATE = date("M, Y", strtotime($_POST['from_Date']));
    $TO_DATE = date("M, Y", strtotime($_POST['to_Date']));
    
    $DIFFERENCE_BETWEEN_MONTHS =  ((date("m", strtotime($FROM_DATE))-date("m", strtotime($TO_DATE)))*-1)+1;
    $MIN_WAGES = $_POST['min_wages'];
    $IPS = $_POST['ips'];
    $DUE_DATE = date("Y-m-t", strtotime(date('Y-m-d')));

    //echo $OBJECT_VOUCHER->countRecordExist($EMP_AREA_CODE, $EMP_REG_SERIAL_NO, strtoupper($_POST['from_Date']), strtoupper($_POST['to_Date']));
    $STATEMENT_COUNT_RECORD = oci_parse($cb_conn, $OBJECT_VOUCHER->countRecordExist($EMP_AREA_CODE, $EMP_REG_SERIAL_NO, 
    $EMP_SUB_AREA_CODE, $EMP_SUB_SERIAL_NO, strtoupper($_POST['from_Date']), strtoupper($_POST['to_Date'])));  
    oci_execute($STATEMENT_COUNT_RECORD);
    $ROW_COUNT = oci_fetch_array($STATEMENT_COUNT_RECORD);

    if($ROW_COUNT['COUNT'] > 0)
    {
        echo "
        <script type='text/javascript'>
            $('#archive').css('display', 'block');
        </script>
        ";
    }
    else
    {
        $STATEMENT_VOUCHER_NUMBER_QUERY = oci_parse($cb_conn, $OBJECT_VOUCHER->getVoucherNumber());
        oci_execute($STATEMENT_VOUCHER_NUMBER_QUERY);
        $VOUCHER_NUMBER = oci_fetch_assoc($STATEMENT_VOUCHER_NUMBER_QUERY);
        $VOUCHER_NUMBER = $VOUCHER_NUMBER['VOUCHER_NO'] + 1;

        $STATEMENT_EMPLOYEER_NAME_QUERY = oci_parse($cb_conn, $OBJECT_VOUCHER->getEmpName($EMP_AREA_CODE, $EMP_REG_SERIAL_NO, $EMP_SUB_AREA_CODE, $EMP_SUB_SERIAL_NO));
        oci_execute($STATEMENT_EMPLOYEER_NAME_QUERY);
        $EMPLOYER_NAME = oci_fetch_assoc($STATEMENT_EMPLOYEER_NAME_QUERY);
        $_SESSION['VOUCHER_TYPE'] = 'Current';
        $_SESSION['VOUCHER_NO'] = $VOUCHER_NUMBER;
        $_SESSION['EMPLOYER_NAME'] = $EMPLOYER_NAME['NAME_OF_ESTABLISHMENT'];
        $_SESSION['REGISTRATION_NO'] = $REGISTRATION_NO;
        $_SESSION['SUB_CODE'] = $SUB_CODE;
        $_SESSION['CONTRIBUTION_MONTH_FROM'] = $FROM_DATE;
        $_SESSION['CONTRIBUTION_MONTH_TO'] = $TO_DATE;
        $_SESSION['CONTR_MONTH_FROM'] = $_POST['from_Date'];
        $_SESSION['CONTR_MONTH_TO'] = $_POST['to_Date'];
        $_SESSION['EMPLOYERS_CONTRIBUTION'] = $DIFFERENCE_BETWEEN_MONTHS>0?$DIFFERENCE_BETWEEN_MONTHS*$IPS*0.05*$MIN_WAGES:$IPS*0.05*$MIN_WAGES;
        $_SESSION['EMPLOYEE_CONTRIBUTION'] = $DIFFERENCE_BETWEEN_MONTHS>0?$DIFFERENCE_BETWEEN_MONTHS*$IPS*0.01*$MIN_WAGES:$IPS*0.01*$MIN_WAGES;
        $_SESSION['IPS'] = $IPS;
        $_SESSION['Statuatorry_increase'] =  ceil(0.025*($_SESSION['EMPLOYERS_CONTRIBUTION']+$_SESSION['EMPLOYEE_CONTRIBUTION']));

        // $F_DATE = '01'.'-'.strtoupper(date("M-Y", strtotime($FROM_DATE)));
        // $T_DATE = '30'.'-'.strtoupper(date("M-Y", strtotime($TO_DATE)));

        $F_DATE = strtoupper($_POST['from_Date']);
        $T_DATE = strtoupper(date("t-M-Y", strtotime($_POST['to_Date'])));
        // $T_DATE = strtoupper($_POST['to_Date']);

        $TOTAL_BEFORE_DUE = $_SESSION['EMPLOYERS_CONTRIBUTION']+$_SESSION['EMPLOYEE_CONTRIBUTION'];
        $TOTAL_AFTER_DUE = ceil(0.025*($_SESSION['EMPLOYERS_CONTRIBUTION']+$_SESSION['EMPLOYEE_CONTRIBUTION']))+$_SESSION['EMPLOYERS_CONTRIBUTION']+$_SESSION['EMPLOYEE_CONTRIBUTION'];
        $SI_AFTER_DUE = ceil(0.025*($_SESSION['EMPLOYERS_CONTRIBUTION']+$_SESSION['EMPLOYEE_CONTRIBUTION']));
        $CREATED_BY  = $_SESSION['emp_code'].'FS';
        $MODIFIED_BY  = $_SESSION['emp_code'].'FS';
        $DATE_DUE = "'".'15-'.strtoupper(date('M')).'-'.date('y')."'";

        if(($_SESSION['EMPLOYERS_CONTRIBUTION']+$_SESSION['EMPLOYEE_CONTRIBUTION']) > 50000)
        {
            echo"
            <script type='text/javascript'>
                $('#contribution_error').css('display', 'block');
            </script>
            ";
        }
        else
        {

            $STATEMENT_INSERT_INTO_CB_VOUCHER = oci_parse($cb_conn,$OBJECT_VOUCHER->InsertintoCBVoucherCurrent($VOUCHER_NUMBER,
            $EMP_AREA_CODE, $EMP_REG_SERIAL_NO, $EMP_SUB_AREA_CODE, $EMP_SUB_SERIAL_NO, $TOTAL_BEFORE_DUE,
            $F_DATE, $T_DATE, $TOTAL_BEFORE_DUE, $_SESSION['Statuatorry_increase'], $TOTAL_AFTER_DUE, 
            $CREATED_BY, $MODIFIED_BY, $DATE_DUE, $_SESSION['IPS'], $MIN_WAGES));
            
            oci_execute($STATEMENT_INSERT_INTO_CB_VOUCHER, OCI_NO_AUTO_COMMIT);
    
            $STATEMENT_INSERT_INTO_CB_VOUCHER_TYPE = oci_parse($cb_conn, $OBJECT_VOUCHER->InsertintoCBVoucherType($VOUCHER_NUMBER, 
            2, $CREATED_BY, $MODIFIED_BY));
            oci_execute($STATEMENT_INSERT_INTO_CB_VOUCHER_TYPE, OCI_NO_AUTO_COMMIT);

            if((oci_num_rows($STATEMENT_INSERT_INTO_CB_VOUCHER) > 0) and (oci_num_rows($STATEMENT_INSERT_INTO_CB_VOUCHER_TYPE) > 0))
            {
                oci_commit($cb_conn);
                echo "
                <script type='text/javascript'>
                    $('#success').css('display', 'block');
                    window.open('GenerateVoucherCurrent.php');
                </script>
                ";
            }
            else
            {
                echo '<script>alert("VOUCHER GENERATION FAILED!!!!!! ")</script>';
            }
        }
    }
?>