<?php
    try {
        $tns = "
        (DESCRIPTION =
                (ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.0.181)(PORT = 1521))
        (CONNECT_DATA =
            (SERVER = DEDICATED)
            (SERVICE_NAME = pcba1)
        )
    )";


        $cb_conn = oci_connect("core_business", "bus1n3ss", $tns);
        if (!$cb_conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

    }
    catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>