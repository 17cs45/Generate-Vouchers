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
    $NAME_OF_ESTABLISHMENT = $_SESSION['NAME_OF_ESTABLISHMENT'];
    $REGISTRATION_NO = $_SESSION['REGISTRATION_NO'];
    $SUB_CODE = $_SESSION['SUB_CODE'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GENERATE FORM</title>
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
            height: 250px;
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
	<a href="Dashboard.php" style="color: #2b669a">
		<button  type="button" class="btn btn-default btn-lg">
			<span class="glyphicon glyphicon-home" ></span> HOME
		</button>
	</a>
    <br><br><br>
    <!-- CURRENT -->
    <div class="modal fade" id="currentvoucher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel"> CURRENT VOUCHER </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
                </div>
                <form action="CURRENT_VOUCHER_DATA.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="registration">REGISTRATION NUMBER : <b style="color: red">*</b></label>
                            <input type="text" class="form-control" id="registration"  name = 'registration' style="border: 3px solid black;"  value="<?php echo $REGISTRATION_NO; ?>"  readonly/>
                        </div>
                        <div class="form-group">
                            <label for="subcode">SUB CODE : </label>
                            <input type="text" class="form-control" id="subcode"  name = 'sub_code' style="border: 3px solid black;" value="<?php echo $SUB_CODE; ?>"  readonly/>
                        </div>
                        <div class="form-group">
                            <label for="from_Date">FROM DATE : <b style="color: red">*</b> :</label>
                            <div class='input-group date' id='datetimepicker2'>
                                <input type="text" class="form-control" id="from_Date" style="border: 3px solid black;" placeholder="FROM DATE" name="from_Date" required>
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>	      
                        </div>
                        <div class="form-group">
                            <label for="to_Date">TO DATE : <b style="color: red">*</b> :</label>
                            <div class='input-group date' id='datetimepicker3'>
                            <input type="text" class="form-control" id="to_Date" style="border: 3px solid black;" placeholder="TO DATE" name="to_Date" required>
                            <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            </div>	 
                        </div>
                        <div class="form-group">
                            <label for="min_wages">MINIMUM WAGES : <b style="color: red">*</b></label>
                            <input type="number" class="form-control" id="min_wages"  name = 'min_wages' style="border: 3px solid black;" placeholder="ENTER MINIMUM WAGES : " min=3000  required/>
                        </div>
                        <div class="form-group">
                            <label for="ips">NO OF INSURED PERSONS : <b style="color: red">*</b></label>
                            <input type="number" class="form-control" id="ips"  name = 'ips' style="border: 3px solid black;" placeholder="ENTER NUMBER OF INSURED PERSONS : " required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="CURRENT_VOUCHER_DATA" class="btn btn-primary">GENRATE VOUCHER</button>
                    </div>
                </form>
           </div>
       </div>
    </div>

    <!-- INTERMEDIATE -->
    <div class="modal fade" id="intermediatevoucher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel"> INTERMEDIATE DEFAULTER VOUCHER </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
                </div>
                <form action="INTERMEDIATE_VOUCHER_DATA.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="registration">REGISTRATION NUMBER : <b style="color: red">*</b></label>
                            <input type="text" class="form-control"  name = 'registration' style="border: 3px solid black;"  value="<?php echo $REGISTRATION_NO; ?>"  readonly/>
                        </div>
                        <div class="form-group">
                            <label for="subcode">SUB CODE : </label>
                            <input type="text" class="form-control"  name = 'sub_code' style="border: 3px solid black;" value="<?php echo $SUB_CODE; ?>"  readonly/>
                        </div>
                        <div class="form-group">
                            <label for="from_Date">FROM DATE : <b style="color: red">*</b> :</label>
                            <div class='input-group date' id='datetimepicker4'>
                                <input type="text" class="form-control" style="border: 3px solid black;" placeholder="FROM DATE" name="from_Date" required>
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>	      
                        </div>
                        <div class="form-group">
                            <label for="to_Date">TO DATE : <b style="color: red">*</b> :</label>
                            <div class='input-group date' id='datetimepicker5'>
                            <input type="text" class="form-control" style="border: 3px solid black;" placeholder="TO DATE" name="to_Date" required>
                            <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            </div>	 
                        </div>
                        <div class="form-group">
                            <label for="min_wages">MINIMUM WAGES : <b style="color: red">*</b></label>
                            <input type="number" class="form-control"  name = 'min_wages' style="border: 3px solid black;" placeholder="ENTER MINIMUM WAGES : " min=3000  required/>
                        </div>
                        <div class="form-group">
                            <label for="ips">NO OF INSURED PERSONS : <b style="color: red">*</b></label>
                            <input type="number" class="form-control"  name = 'ips' style="border: 3px solid black;" placeholder="ENTER NUMBER OF INSURED PERSONS : " required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="CURRENT_VOUCHER_DATA" class="btn btn-primary">GENRATE VOUCHER</button>
                    </div>
                </form>
           </div>
       </div>
    </div>

    <!-- RATE DIFFERENCE  -->
    <div class="modal fade" id="ratedifferencevoucher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel"> RATE DIFFERENCE VOUCHER </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
                </div>
                <form action="RATE_DIFFERENCE_VOUCHER_DATA.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="registration">REGISTRATION NUMBER : <b style="color: red">*</b></label>
                            <input type="text" class="form-control"  name = 'registration' style="border: 3px solid black;"  value="<?php echo $REGISTRATION_NO; ?>"  readonly/>
                        </div>
                        <div class="form-group">
                            <label for="subcode">SUB CODE : </label>
                            <input type="text" class="form-control"  name = 'sub_code' style="border: 3px solid black;" value="<?php echo $SUB_CODE; ?>"  readonly/>
                        </div>
                        <div class="form-group">
                            <label for="from_Date">FROM DATE : <b style="color: red">*</b> :</label>
                            <div class='input-group date' id='datetimepicker6'>
                                <input type="text" class="form-control" style="border: 3px solid black;" placeholder="FROM DATE" name="from_Date" required>
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>	      
                        </div>
                        <div class="form-group">
                            <label for="to_Date">TO DATE : <b style="color: red">*</b> :</label>
                            <div class='input-group date' id='datetimepicker7'>
                            <input type="text" class="form-control" style="border: 3px solid black;" placeholder="TO DATE" name="to_Date" required>
                            <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            </div>	 
                        </div>
                        <div class="form-group">
                            <label for="ips">NO OF INSURED PERSONS : <b style="color: red">*</b></label>
                            <input type="number" class="form-control" name = 'ips' style="border: 3px solid black;" placeholder="ENTER NUMBER OF INSURED PERSONS : " required/>
                        </div>
                        <div class="form-group">
                            <label for="Employer_Contribution">EMPLOYER CONTRIBUTION : <b style="color: red">*</b></label>
                            <input type="number" class="form-control" name = 'Employer_Contribution' style="border: 3px solid black;" placeholder="ENTER EMPLOYER CONTRIBUTION : " required/>
                        </div>
                        <div class="form-group">
                            <label for="Employee_Contribution">EMPLOYEE CONTRIBUTION : <b style="color: red">*</b></label>
                            <input type="number" class="form-control" name = 'Employee_Contribution' style="border: 3px solid black;" placeholder="ENTER EMPLOYEE CONTRIBUTION : " required/>
                        </div>
                        <div class="form-group">
                            <label for="Statuatory_Increase">STATUATORRY INCREASE : <b style="color: red">*</b></label>
                            <input type="number" class="form-control" name = 'Statuatory_Increase' style="border: 3px solid black;" placeholder="ENTER STATUATORRY INCREASE : " required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="CURRENT_VOUCHER_DATA" class="btn btn-primary">GENRATE VOUCHER</button>
                    </div>
                </form>
           </div>
       </div>
    </div>

    <!-- ARREAR  -->
    <div class="modal fade" id="arrearvoucher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel"> ARREAR VOUCHER </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
                </div>
                <form action="ARREAR_VOUCHER_DATA.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="registration">REGISTRATION NUMBER : <b style="color: red">*</b></label>
                            <input type="text" class="form-control"  name = 'registration' style="border: 3px solid black;"  value="<?php echo $REGISTRATION_NO; ?>"  readonly/>
                        </div>
                        <div class="form-group">
                            <label for="subcode">SUB CODE : </label>
                            <input type="text" class="form-control"  name = 'sub_code' style="border: 3px solid black;" value="<?php echo $SUB_CODE; ?>"  readonly/>
                        </div>
                        <div class="form-group">
                            <label for="from_Date">FROM DATE : <b style="color: red">*</b> :</label>
                            <div class='input-group date' id='datetimepicker8'>
                                <input type="text" class="form-control" style="border: 3px solid black;" placeholder="FROM DATE" name="from_Date" required>
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>	      
                        </div>
                        <div class="form-group">
                            <label for="to_Date">TO DATE : <b style="color: red">*</b> :</label>
                            <div class='input-group date' id='datetimepicker9'>
                            <input type="text" class="form-control" style="border: 3px solid black;" placeholder="TO DATE" name="to_Date" required>
                            <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            </div>	 
                        </div>
                        <!-- <div class="form-group">
                            <label for="min_wages">MINIMUM WAGES : <b style="color: red">*</b></label>
                            <input type="number" class="form-control" name = 'min_wages' style="border: 3px solid black;" placeholder="ENTER MINIMUM WAGES : " min=3000  required/>
                        </div> -->
                        <div class="form-group">
                            <label for="ips">NO OF INSURED PERSONS : <b style="color: red">*</b></label>
                            <input type="number" class="form-control" name = 'ips' style="border: 3px solid black;" placeholder="ENTER NUMBER OF INSURED PERSONS : " required/>
                        </div>
                        <div class="form-group">
                            <label for="Employer_Contribution">EMPLOYER CONTRIBUTION : <b style="color: red">*</b></label>
                            <input type="number" class="form-control" name = 'Employer_Contribution' style="border: 3px solid black;" placeholder="ENTER EMPLOYER CONTRIBUTION : " required/>
                        </div>
                        <div class="form-group">
                            <label for="Employee_Contribution">EMPLOYEE CONTRIBUTION : <b style="color: red">*</b></label>
                            <input type="number" class="form-control" name = 'Employee_Contribution' style="border: 3px solid black;" placeholder="ENTER EMPLOYEE CONTRIBUTION : " required/>
                        </div>
                        <div class="form-group">
                            <label for="Statuatory_Increase">STATUATORRY INCREASE : <b style="color: red">*</b></label>
                            <input type="number" class="form-control" name = 'Statuatory_Increase' style="border: 3px solid black;" placeholder="ENTER STATUATORRY INCREASE : " required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="CURRENT_VOUCHER_DATA" class="btn btn-primary">GENRATE VOUCHER</button>
                    </div>
                </form>
           </div>
       </div>
    </div>

    <form class="form" method = 'POST'>
        <fieldset>
            <legend>SELECT VOUCHER TYPE</legend>
        </fieldset>
        <div class="row form-group">
            <div class="col-md-6" >
		    	<label for="registration">NAME OF ESTABLISHMENT: <b style="color: red">*</b></label>
		    	<input type="text" class="form-control" id="NAME_OF_ESTABLISHMENT"  name = 'NAME_OF_ESTABLISHMENT' style="border: 3px solid black;" value="<?php echo $NAME_OF_ESTABLISHMENT; ?>" readonly/>
		    </div>
            <div class="col-md-6" >
		    	<label for="registration">REGISTRATION NUMBER : <b style="color: red">*</b></label>
		    	<input type="text" class="form-control" id="registration"  name = 'registration' style="border: 3px solid black;"  value="<?php echo $REGISTRATION_NO; ?>"  readonly/>
		    </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6" >
		    	<label for="subcode">SUB CODE : </label>
		    	<input type="text" class="form-control" id="subcode"  name = 'sub_code' style="border: 3px solid black;" value="<?php echo $SUB_CODE; ?>"  readonly/>
		    </div>
            <div class="col-md-6">
                <label for="subcode">VOUCHER TYPE : </label>
                <select name = "VOUCHER_TYPE" id = 'VOUCHER_TYPE' class="form-control" required>
                    <option value=" "></option>
                    <option value = "CURRENT">CURRENT</option>
                    <option value = "INTERMITTENT DEFAULTER">INTERMITTENT DEFAULTER</option>
                    <option value = "ARREAR">ARREAR</option>
                    <option value = "RATE DIFFERENCE">RATE DIFFERENCE</option>
	      		</select>
            </div>
        </div>
    </form>
</body>
</html>
<script>
    $(document).ready(function () {
        $('#VOUCHER_TYPE').on('click', function () {
            var voucher_type = $('#VOUCHER_TYPE').val();
            if(voucher_type == 'CURRENT')
            {
                $('#currentvoucher').modal('show');
            }
            else if(voucher_type == 'INTERMITTENT DEFAULTER')
            {
                $('#intermediatevoucher').modal('show');
            }
            else if(voucher_type == 'RATE DIFFERENCE')
            {
                $('#ratedifferencevoucher').modal('show');
            }
            else if(voucher_type == 'ARREAR')
            {
                $('#arrearvoucher').modal('show');
            }
        });
    });
</script>
<script>
    // $(document).ready(function () {
    //     var currentDate = moment();
    //     var currentYear = currentDate.year();
    //     var fiscalYearStart = moment('01-Jul-' + (currentYear - 1), 'DD-MMM-YYYY');
    //     var fiscalYearEnd = moment().endOf('month');
    //     var maxDate2 = moment().subtract(1, 'month').endOf('month');
    //     var minDate2 = fiscalYearStart;
    //     $('#datetimepicker2').datetimepicker({
    //         format: '01-MMM-YYYY',
    //         maxDate: maxDate2,
    //         minDate: minDate2
    //     });

    //     $('#datetimepicker2').on('dp.change', function (e) {
            // var selectedDate = moment(e.date);
            // var newMinDate = selectedDate.startOf('month').add(1, 'month');
            // var newMaxDate = selectedDate.endOf('month');
            // $('#datetimepicker3').data('DateTimePicker').minDate(newMinDate);
            // $('#datetimepicker3').data('DateTimePicker').maxDate(newMaxDate);
    //     });

    //     var maxDate3 = moment().subtract(1, 'month').endOf('month');
    //     $('#datetimepicker3').datetimepicker({
    //         format: 'DD-MMM-YYYY',
    //         minDate: fiscalYearStart,
    //         maxDate: maxDate3
    //     });
    // });


   $(document).ready(function () {
      var currentDate = moment(); // get current date using moment.js library
      var currentYear = currentDate.year();
      var fiscalYearStart = moment('01-Jul-' + (currentYear - 1), 'DD-MMM-YYYY'); // set fiscal year start date to July 1st of the previous year
      var fiscalYearEnd = moment().endOf('month'); // set fiscal year end date to the end of the current month
      var maxDate2 = fiscalYearEnd.subtract(1, 'month'); // set maxDate option for datetimepicker2 to the last day of the previous month
      var minDate2 = fiscalYearStart; // set minDate option for datetimepicker2 to the first day of the fiscal year
      $('#datetimepicker2').datetimepicker({
        format: '01-MMM-YYYY',
        maxDate: maxDate2,
        minDate: minDate2
      });

      $('#datetimepicker2').on('dp.change', function (e) {
        // update minDate option of datetimepicker3 whenever the date in datetimepicker2 changes
        var newMinDate = e.date ? moment(e.date).startOf('month') : fiscalYearStart;
        var newMaxDate = moment().subtract(1, 'month').endOf('month'); // set maxDate option for datetimepicker3 to the last day of the previous month
        $('#datetimepicker3').data('DateTimePicker').minDate(newMinDate);
        $('#datetimepicker3').data('DateTimePicker').maxDate(newMaxDate);
      });

      var maxDate3 = moment().subtract(1, 'month').endOf('month');
      $('#datetimepicker3').datetimepicker({
        format: 'DD-MMM-YYYY',
        minDate: fiscalYearStart,
        maxDate: maxDate3
      });
    });




   $(document).ready(function () {
        var maxDate = moment().subtract(1, 'month');
        $('#datetimepicker4').datetimepicker({
            format: '01-MMM-YYYY',
            maxDate: maxDate
        }).on('dp.change', function (e) {
            // When datetimepicker4 changes, update minDate of datetimepicker5
            $('#datetimepicker5').data('DateTimePicker').minDate(e.date);
        });

        $('#datetimepicker5').datetimepicker({
            format: 'DD-MMM-YYYY'
        });
    });


   $(document).ready(function () {
        var maxDate = moment().subtract(1, 'month');
        $('#datetimepicker6').datetimepicker({
            format: '01-MMM-YYYY',
            maxDate: maxDate
        }).on('dp.change', function (e) {
            // When datetimepicker4 changes, update minDate of datetimepicker5
            $('#datetimepicker7').data('DateTimePicker').minDate(e.date);
        });

        $('#datetimepicker7').datetimepicker({
            format: 'DD-MMM-YYYY'
        });
    });


    
    $(document).ready(function () {
        var maxDate = moment().subtract(1, 'month');
        $('#datetimepicker8').datetimepicker({
            format: '01-MMM-YYYY',
            maxDate: maxDate
        }).on('dp.change', function (e) {
            // When datetimepicker4 changes, update minDate of datetimepicker5
            $('#datetimepicker9').data('DateTimePicker').minDate(e.date);
        });

        $('#datetimepicker9').datetimepicker({
            format: 'DD-MMM-YYYY'
        });
    });
</script>