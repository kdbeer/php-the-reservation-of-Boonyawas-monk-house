<?php 
    session_start(); 
    include("app/en/connect.php");
    $G_id = $_SESSION["personID"];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>Homepage : Reserve system of Monk's house </title>
	<link rel="stylesheet" type="text/css" href="app/style/common.css">


    <!-- for header -->
    <link rel="stylesheet" type="text/css" href="app/style/header.css">
    <link rel="stylesheet" type="text/css" href="app/style/menu.css">
</head>
<body>
	<div class="wrapper">
        <?php include("test.php");  ?>
		
        <div id="container">
			<div class="menu_head">
				<a href="app/reserve_view.php"><div class="menu1">
					<img src="img/home/clock.png" /><br />
			        <h5>การจอง</h5>
		       	</div></a>

		       	<a href="app/get_history.php"><div class="menu1">
			    	<img src="img/home/clipboard105.png" /><br />
			       	<h5>ดูประวัติ</h5>
		       	  </div>
                </a>

                <?php if($_SESSION["personID"] == "unknow") { 
                    echo "<a href=\"app/login.php\">";
                        echo "<div class=\"menu1\">";
                            echo "<img src=\"img/home/login.png\" /><br />";
                            echo "<h5>เข้าระบบ</h5>";
                        echo "</div>";
                    echo "</a>";
              	 } else { 
                	echo "<a href=\"app/en/logout_en.php\">";
                        echo "<div class=\"menu1\">";
                            echo "<img src=\"img/home/logout.png\" /><br />";
                            echo "<h5>ออกจากระบบ</h5>";
                        echo "</div>";
                    echo "</a>";
                } ?>

                <?php if($_SESSION["personID"] == "unknow") { 
                    echo "<a href=\"register.php\">";
                        echo "<div class=\"menu1\">";
                            echo "<img src=\"img/home/agenda2.png\" /><br />";
                            echo "<h5>สร้างบัญชี</h5>";
                        echo "</div>";
                    echo "</a>";
              	 } else { 
                	echo "<a href=\"app/profile.php\">";
                        echo "<div class=\"menu1\">";
                            echo "<img src=\"img/home/account.png\" /><br />";
                            echo "<h5>บัญชีของฉัน</h5>";
                        echo "</div>";
                    echo "</a>";
                } ?>
                <?php
                    $get_notice = "SELECT * FROM massage AS M, massage_code AS C where M.m_id = C.id AND G_id = '$G_id'";
                    $result = mysql_query($get_notice) or die(mysql_error());
                    if(mysql_num_rows($result) == 0) {
                        echo "<div class=\"menu1\">";
                            echo "<img src=\"img/home/bell.png\" /><br />";
                            echo "<h5>ไม่มีการแจ้งเตือน</h5>";
                        echo "</div>";
                    } else {
                            echo "<div class=\"menu1\">";
                                echo "<img src=\"img/home/bell-alarm.png\" /><br />";
                                echo "<h5>คุณมีการแจ้งเตือนอยู่</h5>";
                            echo "</div>";
                    }
                ?>
	        </div>
	        <div class="clear"></div>
	        <div class="description">
	        	<b><i>รายละเอียด</i></b>
	        	<p>" ผู้ใช้สามารถดูประวัติการจองได้ "</p>
	        </div>
            <div class="noticfly" style="font-size: 1.3em;">
                <table border="1">
                    <?php
                            echo "<table border=\"1\">";
                                echo "<tr>";
                                    echo "<td>การแจ้งเตือน</td>";
                                    echo "<td>สถานะ</td>";
                                echo "</tr>";
                                while ($dbarr = mysql_fetch_array($result)) {
                                    echo "<tr>";
                                        echo "<td>".$dbarr[7]."</td>";
                                        if($dbarr[2] == 0)
                                            echo "<td>ยังไม่ได้อ่าน</td>";
                                        else
                                            echo "<td>อ่านแล้ว</td>";     
                                    echo "</tr>";
                                }
                            echo "</table>";
                    ?>
            </div>
		</div> 
	</div>
</body>
</html>