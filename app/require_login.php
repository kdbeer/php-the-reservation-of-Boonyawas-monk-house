<?php
        if( $_SESSION["personID"] == "" or $_SESSION["personID"] == "unknow" ) {
            echo "<script>alert(\"กรุณาเข้าสู่ระบบก่อน\")</script>";
            echo "redirecting";
            echo "<script>window.location = 'login.php'</script>";
        }
    ?>