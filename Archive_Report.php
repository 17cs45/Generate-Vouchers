<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archive Report</title>
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
    <div>
        <form method="post">
            <div class="row form-group">
		    	<div class="col-md-6">
		    		<input type="text" class="form-control" id = "filename" placeholder = "ENTER REGISTRATION NUMBER" name =" file_name" required />
		    	</div>	
                <div class="col-md-6">
                    <input type="submit" value="SUBMIT" name="submit" class="btn btn-md btn-success">
		    	</div> 	    	
		  	</div>
        </form>
    </div>
    <?php
        if(isset($_POST['submit']))
        {
            $destination = 'C:\xampp\htdocs\Generate_Voucher\Archive';    
            $pdf_files = scandir($destination); 

            $filename = $_POST['file_name'];
        ?>
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
                if((strpos($pdf, $filename) != false))
                {
        ?>
                    <tr>
                        <td><?php echo $pdf; ?></td>
                        <td><a href="./Archive/<?php echo $pdf ?>" target='_blank'>Download</td>
                    </tr>
        <?php
                }
            }
        }
    ?>
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