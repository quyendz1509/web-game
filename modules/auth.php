<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/**
 * 
 */
class authClass extends DATABASE
{
	// Gửi email
	function sendMail($email,$userId){
		
		// Lấy thông tin người dùng
    $sql='SELECT * FROM `users` WHERE `ID` = ? AND `email` = ?';
    $re_sql = $this->pdo_query_one($sql,$userId,$email);
		// Sau khi lấy thông tin xong bắt đầu thêm token lên database
    $token_ = mt_rand(100000,999999);
          $time = time() + 300; // 300 - 5 phút ( Tính theo giây)
          

// rồi giờ mới căng nè =))

          $format_time = date('Y-m-d H:i:s',$time);
              //check
          $sql_check = 'SELECT * FROM `request_token` WHERE `user_request_id` = ?';
          $req_check = $this->pdo_query_one($sql_check,$userId);
	// Nếu gửi thành công thì insert dữ liệu vào bảng
          if (!$req_check) {
            $sql_2 = 'INSERT INTO `request_token`(`token`,`time`,`user_request_id`) VALUES(?,?,?)';
            $this->pdo_execute($sql_2,$token_,$format_time,$re_sql['ID']);
            $ketqua = 'success';
          }else{
           $check_time =   time() - (strtotime($req_check['time']) + 300);
           if ($check_time < 0) {
             $ketqua = 'notex';
           }else{
            $sql_2 = 'UPDATE `request_token` SET `token` = ?, `time` = ? WHERE `user_request_id` = ?';
            $this->pdo_execute($sql_2,$token_,$format_time,$re_sql['ID']);
            $ketqua = 'success';
          }
        }

        // giờ mới check để gửi mail đây :#
        if ($ketqua == 'success') {
         require 'PHPMailer-master/src/Exception.php';
         require 'PHPMailer-master/src/PHPMailer.php';
         require 'PHPMailer-master/src/SMTP.php';
          $mail = new PHPMailer(true);  //true: enables exceptions

          $mail->isSMTP();  
          $mail->CharSet  = "utf-8";
                $mail->Host = 'smtp.gmail.com';  //SMTP servers
                $mail->SMTPAuth = true; // Enable authentication
                $nguoigui = 'quyendz1509@gmail.com';
                $matkhau = 'wbguheaousztsjrj';
                $tennguoigui = 'Tru tiên game 3d';
                $mail->Username = $nguoigui; // SMTP username
                $mail->Password = $matkhau;   // SMTP password
                $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
                $mail->Port = 465;  // port to connect to                
                $mail->setFrom($nguoigui, $tennguoigui ); 
                $to = $re_sql['email'];
                $to_name = $re_sql['name'];
                
                $mail->addAddress($to, $to_name); //mail và tên người nhận  
                $mail->isHTML(true);  // Set email format to HTML
                $mail->Subject = 'MÃ BẢO MẬT OTP | TRU TIÊN 3';      
                $noidungthu = ' <table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fbfbfb; background-image: none; background-position: top left; background-size: auto; background-repeat: no-repeat;"> <tbody> <tr> <td> <table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"> <tbody> <tr> <td> <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f3f3f3; color: #000000; width: 555px;" width="555"> <tbody> <tr> <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"> <table class="image_block" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"> <tr> <td style="width:100%;padding-right:0px;padding-left:0px;padding-top:60px;"> <div align="center" style="line-height:10px"><img src="https://d15k2d11r6t6rl.cloudfront.net/public/users/BeeFree/beefree-vjq67byf7xm/logodauthan.png" style="display: block; height: auto; border: 0; width: 139px; max-width: 100%;" width="139"></div></td></tr></table> <table class="heading_block" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"> <tr> <td style="padding-top:15px;text-align:center;width:100%;"> <h1 style="margin: 0; color: #555555; direction: ltr; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 23px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><span class="tinyMce-placeholder">MÃ OTP XÁC NHẬN CỦA BẠN</span></h1> </td></tr></table> <table class="divider_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"> <tr> <td> <div align="center"> <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"> <tr> <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #BBBBBB;"><span>&#8202;</span></td></tr></table> </div></td></tr></table> <table class="paragraph_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"> <tr> <td> <div style="color:#000000;direction:ltr;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:14px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:16.8px;"> <p style="margin: 0; text-align: center;">Vui lòng không chia sẻ này cho bất kỳ ai để tránh việc bị đánh cắp tài khoản tránh lạm dụng tài khoản.</p></div></td></tr></table> <table class="heading_block" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"> <tr> <td style="text-align:center;width:100%;"> <h1 style="margin: 0; color: #2400eb; direction: ltr; font-family: Helvetica, Arial, sans-serif; font-size: 25px; font-weight: 700; letter-spacing: 3px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0; border: 1px solid #b1a3ff; display: inline-block; padding: 6px 12px; border-radius: 6px; background-color: #e9e9e9bb;"><span class="tinyMce-placeholder">'.$token_.'</span></h1> </td></tr></table> <table class="button_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"> <tr> <td> <div align="center"> <a href="http://localhost" target="_blank" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#3a43e0;border-radius:4px;width:auto;border-top:1px solid #3a43e0;font-weight:400;border-right:1px solid #3a43e0;border-bottom:1px solid #3a43e0;border-left:1px solid #3a43e0;padding-top:5px;padding-bottom:5px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:20px;padding-right:20px;font-size:16px;display:inline-block;letter-spacing:normal;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;">Truy cập ngay&nbsp;</span></span></a> </div></td></tr></table> <table class="paragraph_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"> <tr> <td> <div style="color:#ac1212;direction:ltr;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:14px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:16.8px;"> <p style="margin: 0;">OTP chỉ có hiệu lực 5 phút và sẽ lấy lại sau 10 phút</p></div></td></tr></table> </td></tr></tbody> </table> </td></tr></tbody> </table> <table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"> <tbody> <tr> <td> <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f3f3f3; color: #000000; width: 555px;" width="555"> <tbody> <tr> <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"> <table class="icons_block" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"> <tr> <td style="vertical-align: middle; color: #9d9d9d; font-family: inherit; font-size: 15px; padding-bottom: 25px; padding-top: 5px; text-align: center;"> </td></tr></table> </td></tr></tbody> </table> </td></tr></tbody> </table> </td></tr></tbody> </table>';
                $mail->Body = $noidungthu;
                if ($mail->send()) {
                  $res = 'done';
                }else{
                 $res = 'fails';
               }


             }else{
              $res = 'die';
            }

            return $res;
          }
          function checkCookieId($id_hash,$_ID_USER_NUMBER){
		// Lấy thông tin tất cả member (Củ chuối thế nhờ :( )
           $sql='SELECT * FROM `users`';
		// kết quả là gì ? 
           $kq = $this->pdo_query($sql);
		// Bắt đầu
           $test = '';
           foreach ($kq as $key => $value) {
            if (md5( $value['ID'] + $_ID_USER_NUMBER.$value['idnumber'].$value['passwd2']  ) == $id_hash) {
             $test = $value['ID'];
             break;
           }else{
             $test = false;

           }
         }
         return $test;
       }
	// check email
       function checkEmail($email){
         $sql='SELECT * FROM `users` WHERE `email` = ?';
         return $this->pdo_query_one($sql,$email);
       }
	// insert new pass
       function insertSecurityPassword($password,$id){
         $sql='UPDATE `users` SET `answer` = ? WHERE `ID` =? ';
         $this->pdo_execute($sql,$password,$id);
		// get info user by id
       }
       function userNameInfomationId($id){
         $sql='SELECT * FROM `users` WHERE `ID` = ?';
         return $this->pdo_query_one($sql,$id);
       }
       function getListUserAll(){
         return $this->pdo_query('SELECT * FROM `users` ORDER BY `ID` DESC');
       }
	// function update ip 
       function updateIp($ip,$id){
         $sql='UPDATE `users` SET `passwd2` = ?, `thedangky` = ? WHERE `id` = ?';
         $this->pdo_execute($sql,$ip,$ip,$id);
       }
	// get all info user 
       function getListUser(){
         return $this->pdo_query_values('SELECT IFNULL(MAX(id), 16) + 16 FROM `users`');
       }
	// Get info user by username
       function getInfoByUserName($username){
         $sql='SELECT * FROM `users` WHERE `name` = ?';
         return $this->pdo_query_one($sql,$username);
       }
	// function curl
       function curlGet($url){
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $result = curl_exec($ch);
         curl_close($ch);
         return $result;

       }
	// Tạo người dùng
       function makeMember($username,$salt,$password,$email,$phone,$coderand,$gender,$ip,$cretime,$id){
         $sql='INSERT INTO `users`(`name`,`passwd`,`Prompt`,`answer`,`truename`,`idnumber`,`email`,`mobilenumber`,`province`,`city`,`phonenumber`,`address`,`postalcode`,`gender`,`qq`,`passwd2`,`chuyenkhoan`,`napthe`,`hotro1`,`hotro2`,`thedangky`,`creatime`,`id`) VALUES(?,?,0,0,0,?,?,?,0,0,0,0,?,?,0,?,0,0,0,0,?,?,?)';
         $this->pdo_execute($sql,$username,$salt,$password,$email,$phone,$coderand,$gender,$ip,$ip,$cretime,$id);
       }
	// Function to get the client IP address
       function get_client_ip() {
         $url = 'https://api64.ipify.org?format=json';
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $result = curl_exec($ch);
         curl_close($ch);
         $ipaddress = json_decode($result);
         return $ipaddress->ip;
       }

     }

   ?>