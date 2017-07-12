<?php 
    session_start();
    include("app/en/connect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>หน้าหลัก : Reservetion of monk's house</title>
	<link rel="stylesheet" type="text/css" href="app/style/common.css">
	<link rel="stylesheet" type="text/css" href="app/style/header.css" >
	<link rel="stylesheet" type="text/css" href="app/style/menu.css">
	<link rel="stylesheet" type="text/css" href="app/style/unregis_guest.css">
	<link rel="stylesheet" type="text/css" href="app/style/login.css">
	<link rel="stylesheet" type="text/css" href="app/style/show_calendar.css">
	<link rel="stylesheet" type="text/css" href="app/style/Calendar.css">
	<link rel="stylesheet" type="text/css" href="app/style/user_reserve.css">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="app/jquery/jquery-2.1.4.min"></script>
	<script src="app/jquery/common.js"></script>
	<script type="text/javascript">
		function toggle_menu() {

			if (document.getElementById("show_menu_id").style.visibility=="visible") {
				document.getElementById("show_menu_id").style.display=="none"
				document.getElementById("show_menu_id").style.transition = "0.5s";
			}

			if(document.getElementById("show_menu_id").style.marginLeft  == "-370px") {
				//Position when 0 pixel
				document.getElementById("show_menu_id").style.transition = "0.5s";
				document.getElementById("show_menu_id").style.marginLeft = "0px";
				
				if($(window).width() > 1350) {
					document.getElementById("show_content_id").style.width = "74%";
				} else if($(window).width() > 1200) {
					document.getElementById("show_content_id").style.width = "74%";
				} else if($(window).width() > 1024) {
					document.getElementById("show_content_id").style.width = "66.5%";
				} else if($(window).width() > 820) {
					document.getElementById("show_content_id").style.width = "60%";
				} else if($(window).width() > 150) {
					document.getElementById("show_content_id").style.width = "82%";
				} 

			} else {
				//position when sidebar is hides
				document.getElementById("show_menu_id").style.marginLeft = "-370px";
				document.getElementById("show_menu_id").style.transition = "0.5s";

				if($(window).width() > 1350) {
					document.getElementById("show_content_id").style.width = "91%";
				} else 	if($(window).width() > 1200) {
					document.getElementById("show_content_id").style.width = "93%";
				} else if($(window).width() > 1024) {
					document.getElementById("show_content_id").style.width = "93%";
				} else if($(window).width() > 820) {
					document.getElementById("show_content_id").style.width = "93%";
				} else if($(window).width() > 150) {
					document.getElementById("show_content_id").style.width = "85%";
				}
			}
		}

		function hide_me(id) {
			if($(window).width() < 500)
				document.getElementById(id).style.marginLeft = "-370px";
			//onload="print_form_view(); init_date();"
		}
	</script>
</head>
<body onload="manage_reserve()" id="main_body">
	<div class="header" id="header">
		<div class="left">
			<ul class="menu_left">
				<li onclick="toggle_menu();"><a class="imgg" href="#"></a></li>
				<li class="name"><a href="#">ROM</a></li>
				
			</ul>
		</div>
		<div class="right">
			<ul class="menu_right">
				<li><a href="#"><img class="bell" src="img/home/bell.png" width="16px" height="16px" align="middle"></a></li>
				<?php
					if($_SESSION["personID"] != "" && $_SESSION["personID"] != "unknow" )
						echo "<li><a href=\"app/en/logout_en.php\" onclick=\"get_sign_in();\" class=\"sign_out_box\">Sign out</a></li>";
					else
						echo "<li><a href=\"#\" onclick=\"get_sign_in();\" class=\"sign_box\">Sign in</a></li>";

				?>
			</ul>
		</div>
		<div class="head_clear"></div>
	</div>
	<div class="container_box">
		<div class="show_menu" id="show_menu_id">
			<ul>
				<?php if($_SESSION["group"] == "admin" && $_SESSION["personID"] != "" && $_SESSION["personID"] != "unknow") { ?>
					<li class="admin_set_person" onclick="manage_person();"><a href="#">จัดการข้อมูลฆราวาส</a></li>
					<li class="admin_set_reserve" onclick="manage_reserve();"><a href="#">จัดการการจอง</a></li>
					<li class="admin_set_house" onclick="manage_house();"><a href="#">จัดการประเภทกุฏิ</a></li>
					<li class="admin_view_report" onclick="view_report();"><a href="#">ดูรายงาน</a></li>
					<li class="admin_enable" onclick="enable_reserve();"><a href="#">เปิดปิดการจอง</a></li>
                <?php } else if($_SESSION["group"] == "user" && $_SESSION["personID"] != "" && $_SESSION["personID"] != "unknow") { ?>
                	<li class="list_reserve" onclick="_get_reserve(); init_date('user_house_reserve');"><a href="#">ทำการจองกุฏิ</a></li>
					<li class="list_view" onclick="get_history();"><a href="#">ดูประวัติการจอง</a></li>
					<li class="list_history" onclick="print_form_view(); init_date('user_view_reserve'); hide_me('show_menu_id');"><a href="#">ดูการจองทั้งหมด</a></li>
					<li class="list_profile"><a href="#">โปรไฟล์</a></li>
					<li class="list_about"><a href="#" class="list_about_me">เกี่ยวกับเรา</a></li>
					<li class="list_contact" id="hhh"><a href="#">ติดต่อ</a></li>
                <?php } else { ?>
                	<li class="unregis_interest" onclick=""><a href="#">สำหรับผู้ที่สนใจ</a></li>
					<li class="unregis_view" onclick="print_form_view(); init_date('user_view_reserve'); hide_me('show_menu_id');"><a href="#">ดูการจองทั้งหมด</a></li>
					<li class="unregis_register" onclick="print_form_regis(); hide_me('show_menu_id');"><a href="#">สมัครสมาชิก</a></li>
					<li class="list_about"><a href="#" class="list_about_me">เกี่ยวกับเรา</a></li>
					<li class="list_contact" id="hhh"><a href="#">ติดต่อ</a></li>
                <?php } ?>
			</ul>
		</div>
		<div class="show_content" id="show_content_id">
			<div class="menu_head">
				<a href="app/reserve_view.php"><div class="menu1">
					<img id="jgjg" src="img/home/clock.png" width="64px" height="64px" /><br />
			        <h5>การจอง</h5>
		       	</div></a>

		       	<a href="app/get_history.php"><div class="menu1">
			    	<img src="img/home/clipboard105.png" width="64px" height="64px"  /><br />
			       	<h5>ดูประวัติ</h5>
		       	  </div>
                </a>

                <?php if($_SESSION["personID"] == "unknow") { 
                    echo "<a href=\"register.php\">";
                        echo "<div class=\"menu1\">";
                            echo "<img src=\"img/home/agenda2.png\" width=\"64px\" height=\"64px\" /><br />";
                            echo "<h5>สร้างบัญชี</h5>";
                        echo "</div>";
                    echo "</a>";
              	 } else { 
                	echo "<a href=\"app/profile.php\">";
                        echo "<div class=\"menu1\">";
                            echo "<img src=\"img/home/account.png\" width=\"64px\" height=\"64px\" /><br />";
                            echo "<h5>บัญชีของฉัน</h5>";
                        echo "</div>";
                    echo "</a>";
                } ?>
                <?php
                    $get_notice = "SELECT * FROM massage AS M, massage_code AS C where M.m_id = C.id AND G_id = '$G_id'";
                    $result = mysql_query($get_notice) or die(mysql_error());
                    if(mysql_num_rows($result) == 0) {
                        echo "<div class=\"menu1\">";
                            echo "<img src=\"img/home/bell.png\" width=\"64px\" height=\"64px\" /><br />";
                            echo "<h5 id=\"show_device_screen\">ไม่มีการแจ้งเตือน</h5>";
                        echo "</div>";
                    } else {
                            echo "<div class=\"menu1\">";
                                echo "<img src=\"img/home/bell-alarm.png\" width=\"64px\" height=\"64px\" /><br />";
                                echo "<h5>คุณมีการแจ้งเตือนอยู่</h5>";
                            echo "</div>";
                    }
                ?>
	        </div>
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
		<div class="clear"></div>	
	</div>
</div>
