<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="style/common.css">
    <link rel="stylesheet" type="text/css" href="style/Calendar.css">
    <link rel="stylesheet" type="text/css" href="style/show_calendar.css">
    <script src="jquery/jquery-2.1.4.min"></script>
    <script type="text/javascript">
        var date_now = new Date();
        var month = date_now.getMonth();
        var year = date_now.getFullYear();
        var day = date_now.getDate();
        function update_head() {
            var month_arr = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            document.getElementById("show_date").innerHTML = month_arr[month]+" "+year;
        }

        function init() {
            $.ajax({
                type: 'POST',
                url: 'app/en/calendar_controller.php',
                data: {
                    'year': year,
                    'month' : month,
                    'mode': "user_house_reserve"
                },
                success: function(data){
                    update_head();
                    $('#calendar_body').html(data);
                }
            });
        }

        function miner_month() {
            if(month == 0) {
                month = 11;
                year-=1;
            } else {
                month-=1
            }

            $.ajax({
                type: 'POST',
                url: 'app/en/calendar_controller.php',
                data: {
                    'year': year,
                    'month' : month,
                    'mode': "user_house_reserve"
                },
                success: function(data){
                    update_head();
                    $('#calendar_body').html(data);
                }
            });
        }

        function plus_month() {
            if(month == 11) {
                month = 0;
                year+=1;
            } else {
                month+=1;
            }

            $.ajax({
                type: 'POST',
                url: 'app/en/calendar_controller.php',
                data: {
                    'year': year,
                    'month' : month,
                    'mode': "user_house_reserve"
                },
                success: function(data){
                    update_head();
                    $('#calendar_body').html(data);
                }
            });
        }

        function get_data(data) {
            $('#rightContainer').html("<img src='app/style/loading.gif' width='25px' height='25px' style='margin:40px'>");
            $.ajax({
                type: 'POST',
                url: 'app/en/_get_reserve_data.php',
                data: {
                    'year': year,
                    'month':month,
                    'day':data
                },
                success: function(data){
                    $('#rightContainer').html(data);
                }
            });
        }

        function check() {
          document.getElementById("nav2").style.visibility = "visible";
          document.getElementById("nav2").style.transition = "0.4s";
        }

        function back() {
          document.getElementById("nav2").style.visibility = "hidden";
          document.getElementById("make_reserve_menu").innerHTML = " ";
        }
    </script>
</head>
<body>
    <div class="get_reservelist_wrapper">
        <div class="reserve_navigation">
          <ul class="navigation">
            <li>การนำทาง</li>
            <li class="c_in_date" onclick="back();" >เลือกวันเข้าพัก</li>
            <li class="c_out_date" id="nav2">เลือกวันยกเลิก</li>
          </ul>
        </div>
        <div class="reserve_list_container">
          <div class="left_side">
              <div class="calendar">
                  <div class="calendar_header">
                      <div class="left_arrow" onclick="miner_month();"><img src="app/style/img/left_arrow.png" width="20px" height="auto"></div>
                      <div class="show_date" id="show_date"></div>
                      <div class="right_arrow" onclick="plus_month();"><img src="app/style/img/right_arrow.png" width="20px" height="auto"></div>
                  </div>
                  <div class="calendar_body" id="calendar_body">
                  </div>
              </div>
              <div class="descript_txt"><i>หมายเหตุ</i> : <img src="app/style/img/flag.png">  หมายถึงวันที่มีการจอง <i>เลือกวันที่เพื่อดู</i></div>
          </div>
          <div class="right_side">
              <div class="reserve_menu" id="reserve_menu">
                  <div>ประกาศ!!</div>
                  <div>ขอต้อนรับผู้ที่ประสงค์จะปฏิบัติธรรมทุกท่าน ท่านสามารถเลือกวันเข้ามาปฏิบัตธรรมได้จากปฏิทินทางด้านซ้าย เมื่อเลือกเล้วกรุณากรอกข้อมูลด้านล่างให้ครบด้วยค่ะ</div>
                  <div>กฏการจองกุฏิเพื่อปฏิบัติธรรม</div>
                  <div>
                      <ul>
                          <li>ผู้ที่ประสงค์จะปฏิบัติธรรมต้องเคยมาที่วัดแล้ว อย่างน้อย 1 ครั้ง</li>
                          <li>สามารถปฏิบัติธรรมได้ไม่เกิน 15 วันต่อ 1 ครั้ง</li>
                          <li>หากประสงค์จะจองซ้ำ สามารถจองได้หลังจากการปฏิบัติธรรมครั้งล่าสุดไปแล้ว 7 วัน</li>
                      </ul>
                  </div>
                  <div class="make_menu" id="make_reserve_menu">

                  </div>
              </div>
          </div>
          <div class="clear"></div>
        </div>
    </div>
</body>
</html>
