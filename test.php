<?php 
    session_start();
    include("app/en/connect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test page</title>
	<link rel="stylesheet" type="text/css" href="app/style/common.css">
	<link rel="stylesheet" type="text/css" href="app/style/header.css" >
	<link rel="stylesheet" type="text/css" href="app/style/menu.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript">
		function toggle_menu() {
			if(document.getElementById("show_menu_id").style.marginLeft  == "-370px") {
				document.getElementById("show_menu_id").style.transition = "0.75s";
				document.getElementById("show_menu_id").style.marginLeft = "0px";
			} else {
				document.getElementById("show_menu_id").style.transition = "0.75s";
				document.getElementById("show_menu_id").style.marginLeft = "-370px";
			}
		}
	</script>
</head>
<body>
	<div class="header">
		<div class="left">
			<ul class="menu_left">
				<li onclick="toggle_menu();"><a class="imgg" href="#"></a></li>
				<li class="name"><a href="#">ROM</a></li>
				<li class="title"><a href="#">หน้าหลัก</a></li>
			</ul>
		</div>
		<div class="right">
			<ul class="menu_right">
				<li><a href="#"><img class="bell" src="img/home/bell.png" width="16px" height="16px" align="middle"></a></li>
				<li><a href="#" class="sign_box">Sign in</a></li>
			</ul>
		</div>
		<div class="head_clear"></div>
	</div>
	<div class="container_box">
		<div class="show_menu" id="show_menu_id">
			<ul>
				<li class="list_reserve"><a href="#">ทำการจองกุฏิ</a></li>
				<li class="list_view"><a href="#">ดูประวัติการจอง</a></li>
				<li class="list_history"><a href="#">ดูการจองทั้งหมด</a></li>
				<li class="list_profile"><a href="#">โปรไฟล์</a></li>
				<li class="list_about"><a href="#" class="list_about_me">เกี่ยวกับเรา</a></li>
				<li class="list_contact" id="hhh"><a href="#">ติดต่อ</a></li>
			</ul>
		</div>
		<div class="show_content">
			<div class="menu_head">
				<a href="app/reserve_view.php"><div class="menu1">
					<img id="jgjg" src="img/home/clock.png" /><br />
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
