<?php
    if(isset($_POST['submit']))
    {
        $error = '';
        $total_line = '';
        session_start();
        if(isset($_POST['registration']))
        {
            $REGISTRATION_NUMBER = $_POST['registration'];
        }
        else
        {
            $error = 'NOTHING';
        }
    }
    if($error != '')
    {
        $output = array(
            'error'		=>	$error
        );
    }	
    else
    {
        $output = array(
            'success'		=>	true,
            'REGISTRATION_NUMBER'	=>	$REGISTRATION_NUMBER
        );
    }

    echo json_encode($output);
?>