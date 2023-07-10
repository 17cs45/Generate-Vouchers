<?php
    class LoginQuery
    {
        function getLoginQuery($name,$pass)
        {
            // $Query = "SELECT user_id,password,employee_code,name,role_id,designation
            // FROM FACILITATION_SYSTEM.fs_user
            // join FACILITATION_SYSTEM.fs_user_roles
            // USING(user_id)
            // where user_id = '".$name."' and password = '".$pass."' and status = 'A'";

            $Query = "SELECT fu.user_id, fu.password, fu.employee_code, fu.name,
            fr.role_id, fu.designation, hr.region_fo_code
            FROM FACILITATION_SYSTEM.fs_user  fu
            inner join FACILITATION_SYSTEM.fs_user_roles fr
            on fu.user_id = fr.user_id
            inner join HUMAN_RESOURCE.hr_employee hr
            on fu.employee_code = hr.employee_code
            where fu.user_id = '".$name."' and fu.status = 'A'";

            return $Query;
        }
    }
?>