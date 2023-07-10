<?php
    session_start();
    require('fpdf/fpdf.php');

    class PDF extends FPDF
    {
        function Header()
        {


            //================ HEADER START=================
            $this->Image('./header.jpg', 0, 0, 205, 24);

            $this->SetXY(180, 8.5);
            $this->SetTextColor(0, 0, 0);
            $this->SetFont('Times','B',10);
            $text = $_SESSION['VOUCHER_NO'];
            $this->Write(0,$text);

            $this->SetXY(170, 17.4);
            $this->SetTextColor(0, 0, 0);
            $this->SetFont('Times','B',10);
            // $text = $_SESSION['VOUCHER_TYPE'];
            $text = "Intermittent";
            $this->Write(0,$text);

            $this->Image('./imgs/PaymentSlip/header_sub.jpg', 0, 20,205);

            // =========================HEADER END================

            // ======================PERSONAL INFORMATIONS SECTION START====================

            $this->Image('./imgs/PaymentSlip/personalInfo_header.jpg', 0, 32,160);

            $this->Image('./imgs/PaymentSlip/verticalBorder_small.jpg', 0,40,160,20);

            $this->SetXY(22,45); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Employer's Name";
            $this->Write(0,$text);

            $this->SetXY(52,45); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= $_SESSION['EMPLOYER_NAME'];
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(52,47,150,47);

            $this->SetXY(6,55); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Employers Registration No.";
            $this->Write(0,$text);

            $this->SetXY(52,55); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text = $_SESSION['REGISTRATION_NO'];
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(50,58,76,58);

       
            $this->SetXY(105,55); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Sub Code";
            $this->Write(0,$text);

            
            $this->SetXY(124,55); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= $_SESSION['SUB_CODE'];
            $this->Write(0,$text);
            
            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(124,58,156,58);

            $this->Image('./imgs/PaymentSlip/small_footer.jpg', 0,60,160);

            // ======================PERSONAL INFORMATIONS SECTION END====================


            // ======================CURRENT CONTRIBUTION SECTION START====================

            $this->Image('./imgs/PaymentSlip/currentContribution_header.jpg', 0, 65,160);

            $this->Image('./imgs/PaymentSlip/verticalBorder_small.jpg', 0,73,160,20);

            $this->SetXY(15,77); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Contribution Month(s) From: ";
            $this->Write(0,$text);

            $this->SetXY(58,77); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'From: '.$_SESSION['CONTRIBUTION_MONTH_FROM'].' To: '.$_SESSION['CONTRIBUTION_MONTH_TO'];
            $this->Write(0,$text);

            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(60,80,150,80);

            $this->SetXY(11,84); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Employer's Contributions";
            $this->Write(0,$text);

            $this->SetXY(50,84); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'RS : '.$_SESSION['EMPLOYERS_CONTRIBUTION'];
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(50,86,76,86);

            $this->SetXY(100,84); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Statuatory Increase";
            $this->Write(0,$text);

            $this->SetXY(130,84); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'RS : '.$_SESSION['Statuatorry_increase'];
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(130,86,156,86);

            $this->SetXY(11,91); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Employee's Contributions";
            $this->Write(0,$text);

            $this->SetXY(50,91); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'RS : '.$_SESSION['EMPLOYEE_CONTRIBUTION'];
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(1);
            $this->SetDrawColor(0,0,0);
            $this->Line(50,93,76,93);

            $this->SetXY(100,91); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "No. of Insured Persons";
            $this->Write(0,$text);

            
            $this->SetXY(140,91); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= $_SESSION['IPS'];
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(1);
            $this->SetDrawColor(0,0,0);
            $this->Line(135,93,156,93);

            $this->Image('./imgs/PaymentSlip/small_footer.jpg', 0,93,160);
            
            // ======================CURRENT CONTRIBUTION SECTION END==============

            $this->Image('./imgs/PaymentSlip/scissor.jpg', 0,100,205);

            // ======================EOBI HEADER SECTION START====================

            $this->Image('./imgs/PaymentSlip/eobiCopy_header.jpg', 2, 110,206);

            $this->Image('./imgs/PaymentSlip/verticalBorder_large.jpg', 2,118,206,72);

            $this->SetXY(20,125); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Employer's Name";
            $this->Write(0,$text);

            $this->SetXY(50,125); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= $_SESSION['EMPLOYER_NAME'];
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(52,127,200,127);


            $this->SetXY(10,133); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Employers Registration No.";
            $this->Write(0,$text);

            $this->SetXY(55,133); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text=  $_SESSION['REGISTRATION_NO'];
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(55,135,110,135);

            $this->SetXY(130,133); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Sub Code";
            $this->Write(0,$text);

            $this->SetXY(150,133); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= $_SESSION['SUB_CODE'];
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(150,135,200,135);


            $this->SetXY(20,141); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Billing Month(s) ";
            $this->Write(0,$text);

            $this->SetXY(53,141); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'From: '.$_SESSION['CONTRIBUTION_MONTH_FROM'].' To: '.$_SESSION['CONTRIBUTION_MONTH_TO'];
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(52,143,120,143);
            
            
            $this->SetXY(130,141); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Due Date";
            $this->Write(0,$text);

            $this->SetXY(150,141); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= date('M').' 15, '.date('Y');
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(150,143,200,143);

            $this->SetXY(10,149); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Payable within Due Date ";
            $this->Write(0,$text);

            $this->SetXY(60,149); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'RS : '.($_SESSION['EMPLOYERS_CONTRIBUTION']+$_SESSION['EMPLOYEE_CONTRIBUTION']);
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(52,151,120,151);

            
            $this->SetXY(130,149); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Issue Date";
            $this->Write(0,$text);

            $this->SetXY(150,149); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= date('M d, Y');
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(150,151,200,151);


            $this->SetXY(10,157); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Payable after Due Date";
            $this->Write(0,$text);

            $this->SetXY(60,157); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'RS : '.($_SESSION['Statuatorry_increase']+$_SESSION['EMPLOYERS_CONTRIBUTION']+$_SESSION['EMPLOYEE_CONTRIBUTION']);
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(52,159,120,159);

            $this->SetXY(130,157); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Voucher No.";
            $this->Write(0,$text);

            $this->SetXY(153,157); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= $_SESSION['VOUCHER_NO'];
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(153,159,200,159);

            $this->SetXY(10,165); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Employer's Contributions";
            $this->Write(0,$text);

            $this->SetXY(60,165); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'RS : '.$_SESSION['EMPLOYERS_CONTRIBUTION'];
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(52,167,120,167);

            $this->SetXY(130,163); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Statuatory";
            $this->Write(0,$text);

            $this->SetXY(133,167); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Increase";
            $this->Write(0,$text);

            $this->SetXY(153,165); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'RS : '.$_SESSION['Statuatorry_increase'];
            $this->Write(0,$text);
            
            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(153,167,200,167);

            $this->SetXY(10,173); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Employee's Contributions";
            $this->Write(0,$text);

            $this->SetXY(60,173); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'RS : '.$_SESSION['EMPLOYEE_CONTRIBUTION'];
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(55,175,120,175);

            $this->SetXY(127,173); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "No. of Insured";
            $this->Write(0,$text);

            $this->SetXY(133,176); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Persons";
            $this->Write(0,$text);

            $this->SetXY(157,176); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text=  $_SESSION['IPS'];
            $this->Write(0,$text);
            
            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(155,178,200,178);

            $this->SetXY(10,182); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Contribution Paid Through";
            $this->Write(0,$text);

            $this->SetXY(70,182); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Cash";
            $this->Write(0,$text);
            
            $this->SetXY(80, 179); 
            $this->SetFont('Times','',10);
            $this->SetFillColor(255,255,255);
            $this->Cell(3,5,'',1,1,'C', TRUE);

            $this->SetXY(95,182); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Cheque/ DD/ Payorder No";
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(135,183,160,183);
            
            $this->Image('./imgs/PaymentSlip/small_footer.jpg', -0.4,190,206);
            
            // ======================EOBI HEADER SECTION END====================

            $this->Image('./imgs/PaymentSlip/scissor.jpg', 0,197,205);

            // ======================BANK USE ONLY SECTION START====================
            $this->Image('./imgs/PaymentSlip/bankUseOnly_header.jpg', 2, 206,206);
            $this->Image('./imgs/PaymentSlip/verticalBorder_large.jpg', 2,213,206,67);

            $this->SetXY(20,218); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Employer's Name";
            $this->Write(0,$text);

            $this->SetXY(50,218); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= $_SESSION['EMPLOYER_NAME'];
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(52,221,200,221);
 
 
            $this->SetXY(10,227); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Employers Registration No.";
            $this->Write(0,$text);

            $this->SetXY(55,227); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= $_SESSION['REGISTRATION_NO'];
            $this->Write(0,$text);

            // //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(55,230,110,230);

            $this->SetXY(130,227); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Sub Code";
            $this->Write(0,$text);

            $this->SetXY(150,227); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= $_SESSION['SUB_CODE'];
            $this->Write(0,$text);

            //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(150,230,200,230);


            $this->SetXY(20,236); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Billing Month(s) ";
            $this->Write(0,$text);

            $this->SetXY(53,236); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'From: '.$_SESSION['CONTRIBUTION_MONTH_FROM'].' To: '.$_SESSION['CONTRIBUTION_MONTH_TO'];
            $this->Write(0,$text);

            // //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(52,238,120,238);
             
             
            $this->SetXY(130,236); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Due Date";
            $this->Write(0,$text);

            $this->SetXY(150,236); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= date('M').' 15, '.date('Y');
            $this->Write(0,$text);

            // //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(150,238,200,238);

            $this->SetXY(10,244); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Payable within Due Date ";
            $this->Write(0,$text);

            $this->SetXY(60,244); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'RS : '.($_SESSION['EMPLOYERS_CONTRIBUTION']+$_SESSION['EMPLOYEE_CONTRIBUTION']);
            $this->Write(0,$text);
 
            //  //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(52,246,120,246);
 
            $this->SetXY(130,244); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Issue Date";
            $this->Write(0,$text);

            $this->SetXY(150,244); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= date('M d, Y');
            $this->Write(0,$text);

            // //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(150,246,200,246);


            $this->SetXY(10,252); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Payable after Due Date";
            $this->Write(0,$text);

            $this->SetXY(60,252); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'RS : '.($_SESSION['Statuatorry_increase']+$_SESSION['EMPLOYERS_CONTRIBUTION']+$_SESSION['EMPLOYEE_CONTRIBUTION']);
            $this->Write(0,$text);

            // //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(52,254,120,254);

            $this->SetXY(130,252); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Voucher No.";
            $this->Write(0,$text);

            $this->SetXY(153,252); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= $_SESSION['VOUCHER_NO'];
            $this->Write(0,$text);

            // //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(153,254,200,254);

            $this->SetXY(10,260); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Employer's Contributions";
            $this->Write(0,$text);

            $this->SetXY(60,260); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'RS : '.$_SESSION['EMPLOYERS_CONTRIBUTION'];
            $this->Write(0,$text);

            // //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(55,262,120,262);

            $this->SetXY(130,257); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Statuatory";
            $this->Write(0,$text);

            $this->SetXY(133,260); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Increase";
            $this->Write(0,$text);

            $this->SetXY(153,260); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'RS : '.$_SESSION['Statuatorry_increase'];
            $this->Write(0,$text);
            
            // //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(153,262,200,262);

            $this->SetXY(10,268); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Employee's Contributions";
            $this->Write(0,$text);

            $this->SetXY(60,268); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'RS : '.($_SESSION['EMPLOYEE_CONTRIBUTION']);
            $this->Write(0,$text);

            // //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(55,270,120,270);

            $this->SetXY(127,266); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "No. of Insured";
            $this->Write(0,$text);

            $this->SetXY(133,270); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Persons";
            $this->Write(0,$text);

            $this->SetXY(157,268); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= $_SESSION['IPS'];
            $this->Write(0,$text);
            
            // //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(155,270,200,270);

            $this->SetXY(10,276); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= "Contribution Paid Through";
            $this->Write(0,$text);

            $this->SetXY(70,276); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Cash";
            $this->Write(0,$text);
            
            $this->SetXY(80, 274); 
            $this->SetFont('Times','',10);
            $this->SetFillColor(255,255,255);
            $this->Cell(3,4,'',1,1,'C', TRUE);

            $this->SetXY(95,276); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Cheque/ DD/ Payorder No";
            $this->Write(0,$text);

            // //Line
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(0,0,0);
            $this->Line(135,276,160,276);
            
            $this->Image('./imgs/PaymentSlip/small_footer.jpg', -0.5,279,206);
            
            // ======================BANK USE ONLY SECTION END====================

            $this->SetXY(5, 286);
            $this->SetTextColor(0, 0, 0);
            $this->SetFont('Times','',10);
            $text = "Master Collection A/C 0005-1005278987 Bank Alfalah Limited";
            $this->Write(0,$text);

            $this->SetXY(5, 289);
            $this->SetTextColor(0, 0, 0);
            $this->SetFont('Times','',10);
            $text = "* Any arrears with respect to the verfication/assesments may be reflected in future, if so desired.";
            $this->Write(0,$text);

            $this->SetXY(5, 294);
            $this->SetTextColor(220, 220, 220);
            $this->SetFont('Times','B',10);
            $text = "EOBI System Generated Voucher Date ".date('M d, Y');
            $this->Write(0,$text);

            // START OF SIDE SECTION PERSONAL INFO

            $this->SetXY(165, 32); 
            $this->SetFont('Times','',10);
            $this->SetFillColor(220,220,220);
            $this->Cell(38,10,'',1,1,'C', TRUE);

            $this->SetXY(168,35); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Contribution Month";
            $this->Write(0,$text);

            $this->SetXY(175,40); 
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= $_SESSION['CONTRIBUTION_MONTH_TO'];
            $this->Write(0,$text);

            $this->SetXY(165, 44);
            $this->SetFont('Times','',10);
            $this->SetFillColor(220,220,220);
            $this->Cell(38,13,'',1,1,'C', TRUE);
            
            $this->SetXY(167,47);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Contribution Payable";
            $this->Write(0,$text);

            $this->SetXY(170,51);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Within Due Date";
            $this->Write(0,$text);

            $this->SetXY(175,55);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'RS : '.($_SESSION['EMPLOYERS_CONTRIBUTION']+$_SESSION['EMPLOYEE_CONTRIBUTION']);
            $this->Write(0,$text);

            $this->SetXY(165, 59);
            $this->SetFont('Times','',10);
            $this->SetFillColor(220,220,220);
            $this->Cell(38,10,'',1,1,'C', TRUE);

            $this->SetXY(177,62);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Due Date";
            $this->Write(0,$text);

            $this->SetXY(175,67);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= date('M').' 15, '.date('Y');
            $this->Write(0,$text);

            $this->SetXY(165, 71);
            $this->SetFont('Times','',10);
            $this->SetFillColor(220,220,220);
            $this->Cell(38,13,'',1,1,'C', TRUE);

            $this->SetXY(167,74);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Contribution Payable";
            $this->Write(0,$text);

            $this->SetXY(172,78);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "After Due Date";
            $this->Write(0,$text);

            $this->SetXY(175,82);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= 'RS : '.($_SESSION['Statuatorry_increase']+$_SESSION['EMPLOYERS_CONTRIBUTION']+$_SESSION['EMPLOYEE_CONTRIBUTION']);
            $this->Write(0,$text);

            $this->SetXY(165, 87);
            $this->SetFont('Times','',10);
            $this->SetFillColor(220,220,220);
            $this->Cell(38,10,'',1,1,'C', TRUE);

            $this->SetXY(174,90);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','',10);
            $text= "Expiry Date";
            $this->Write(0,$text);

            $this->SetXY(173,95);
            $this->SetTextColor(0,0,0);
            $this->SetFont('Times','B',10);
            $text= date("M t, Y", strtotime(date('Y-m-d')));
            $this->Write(0,$text);

            // END OF SIDE SECTION PERSONAL INFO
        }
        function footer()
        {
            $this->Image('./imgs/PaymentSlip/1.jpg', 165,290, 0, 0);
        }
    }
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    // $pdf->Output('','Voucher');
    
    $url = './Archive/PR03_'.$_SESSION['REGISTRATION_NO'].$_SESSION['SUB_CODE'].'_DATED '.$_SESSION['CONTR_MONTH_FROM'].' To '.$_SESSION['CONTR_MONTH_TO'].'_CURRENT_DEMAND.pdf';
    $pdf->Output($url,'F');

    $pdf->Output('','Voucher');
?>