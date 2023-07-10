<?php 
    session_start();
    if (!isset($_SESSION['name'])) 
    {
        header("Location: index.php");
    }
    include_once('./QueryClasses/connect.php');
    $name = $_SESSION['name'];

    $EMP_AREA_CODE = substr($_SESSION['REGISTRATION_NUMBER'], 0, 3);
    $EMP_REG_SERIAL_NO = substr($_SESSION['REGISTRATION_NUMBER'],3);

    $destination = 'C:\xampp\htdocs\Generate_Voucher\Archive';    
    $pdf_files = scandir($destination); 

    if(strlen($_SESSION['SUB_CODE']) > 1)
    {
        $SUB_CODE = $_SESSION['SUB_CODE'];
        $EMP_SUB_AREA_CODE = substr($_SESSION['SUB_CODE'], 0,2);
        $EMP_SUB_SERIAL_NO = substr($_SESSION['SUB_CODE'], 2);
    } 
    else
    {
        $SUB_CODE = ' ';
        $EMP_SUB_AREA_CODE = ' ';
        $EMP_SUB_SERIAL_NO = 0;
    }

    $FROM_DATE = $_SESSION['FROM_DATE'];
    $TO_DATE = $_SESSION['TO_DATE'];

    $FILE_NAME = $_SESSION['REGISTRATION_NUMBER'].$SUB_CODE.'_DATED '.$FROM_DATE.' To '.$TO_DATE;


    if(isset($_GET['delete']))
    {
        $QUERY_GET_PMT_SLIP = "SELECT PMT_SLIP_NO FROM CB_VOUCHER WHERE EMP_AREA_CODE = '$EMP_AREA_CODE' 
        and EMP_REG_SERIAL_NO = $EMP_REG_SERIAL_NO
        and EMP_SUB_AREA_CODE = '$EMP_SUB_AREA_CODE' and EMP_SUB_SERIAL_NO = $EMP_SUB_SERIAL_NO
        and GENERATED_FROM = '172.16.0.24' 
        and FROM_DATE = '$FROM_DATE' and TO_DATE = '$TO_DATE'";
        
        $STATEMENT_GET_PMT_SLIP = oci_parse($cb_conn, $QUERY_GET_PMT_SLIP);

        oci_execute($STATEMENT_GET_PMT_SLIP);

        $PMT_SLIP_ARRAY = oci_fetch_assoc($STATEMENT_GET_PMT_SLIP);

        if(!empty($PMT_SLIP_ARRAY))
        {
            $PMT_SLIP_NO = $PMT_SLIP_ARRAY['PMT_SLIP_NO'];

            $DELETE_FROM_VOUCHER_TYPE_QUERY = "DELETE FROM CB_VOUCHER_TYPE where PMT_SLIP_NO = $PMT_SLIP_NO";
            $STATEMENT_DELETE_FROM_VOUCHER_QUERY = oci_parse($cb_conn,$DELETE_FROM_VOUCHER_TYPE_QUERY);
            oci_execute($STATEMENT_DELETE_FROM_VOUCHER_QUERY, OCI_NO_AUTO_COMMIT);
            if(oci_num_rows($STATEMENT_DELETE_FROM_VOUCHER_QUERY) > 0)
            {
                $QUERY_DELETE_CB_VOUCHER = "DELETE FROM CB_VOUCHER WHERE EMP_AREA_CODE = '$EMP_AREA_CODE' 
                and EMP_REG_SERIAL_NO = $EMP_REG_SERIAL_NO 
                and EMP_SUB_AREA_CODE = '$EMP_SUB_AREA_CODE' and EMP_SUB_SERIAL_NO = $EMP_SUB_SERIAL_NO
                and GENERATED_FROM = '172.16.0.24' 
                and FROM_DATE = '$FROM_DATE' and TO_DATE = '$TO_DATE'";

                $STATEMENT_DELETE_CB_VOUCHER = oci_parse($cb_conn, $QUERY_DELETE_CB_VOUCHER);

                oci_execute($STATEMENT_DELETE_CB_VOUCHER, OCI_NO_AUTO_COMMIT);

                if(oci_num_rows($STATEMENT_DELETE_CB_VOUCHER) > 0)
                {
                    oci_commit($cb_conn);
                    unlink('./Archive/'.$_GET['delete']);
                    header("LOCATION: DELETE_VOUCHER_QUERY.php?voucher=deleted");
                }
                else
                {
                    oci_rollback($cb_conn);
                    echo "<script>alert('VOUCHER COULD NOT DELETED');</script>";
                }
            }
            else
            {
                oci_rollback($cb_conn);
                echo "<script>alert('VOUCHER COULD NOT DELETED');</script>";
            }
        }
        else
        {
            header("LOCATION: DELETE_VOUCHER_QUERY.php?voucher=no_voucher_exist");
        }
    }

    if(isset($_GET['voucher']) and $_GET['voucher'] == 'deleted')
    {
        echo "<script>alert('VOUCHER DELETED SUCCESSFULLY!!!');</script>";
    }

    if(isset($_GET['voucher']) and $_GET['voucher'] == 'no_voucher_exist')
    {
        echo "<script>alert('VOUCHER DOES NOT EXIST!!!');</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARCHIVE REPORT</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <!-- Datatable CSS -->
    <link href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Datatable JS -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>
<body class="container">
    <p>
		<center><img src="images\eobi_logo.png"><font size="6" style="color:green">EOBI's Facilitation System </font> </center>
    </p>
    <a href="dashboard.php" style="color: #2b669a">
			<button  type="button" class="btn btn-default btn-lg">
				<span class="glyphicon glyphicon-home" ></span> BACK
			</button>
	</a>
    <br><br><br>
    <table id="reportTable" class="cell-border compact hover order-column stripe">
        <thead>
            <tr>
                <td>FILE NAME</td>
                <td>ACTION</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($pdf_files as $pdf)
                {
                    if((strpos($pdf, $FILE_NAME) != false))
                    {
                ?>
                    <tr>
                        <td><?php echo $pdf; ?></td>
                        <td><a href="?delete=<?php echo $pdf ?>" class = "btn btn-danger">DELETE VOUCHER</td>
                    </tr>
            <?php }} ?>
        </tbody>
    </table>

</body>
</html>
<script>
	$(document).ready(function() {
		$('#reportTable').DataTable( {
		} );
	} );
</script>