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
          // Gửi mail rồi mới đưa lên database nhé =))
        

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
                $mail->Subject = 'OTP BẢO MẬT TỪ TRU TIÊN 3D';      
                $noidungthu = "Chào banj";
                $mail->Body = $noidungthu;
                if ($mail->send()) {
                  $res = true;
                }else{
                 $res = false;
               }



// rồi giờ mới căng nè =))
               if ($res) {
                 $format_time = date('Y-m-d H:i:s',$time);
              //check
                 $sql_check = 'SELECT * FROM `request_token` WHERE `user_request_id` = ?';
                 $req_check = $this->pdo_query_one($sql_check,$userId);
	// Nếu gửi thành công thì insert dữ liệu vào bảng
                 if (!$req_check) {
                  $sql_2 = 'INSERT INTO `request_token`(`token`,`time`,`user_request_id`) VALUES(?,?,?)';

                }else{
                  $sql_2 = 'UPDATE `request_token` SET `token` = ?, `time` = ? WHERE `user_request_id` = ?';
                }
                $this->pdo_execute($sql_2,$token_,$format_time,$re_sql['ID']);
                $ketqua = 'success';
              }else{
               $ketqua = 'failed';
             }
             return $ketqua;
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
           $ipaddress = '';
           if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
          else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
          else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
          else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
          else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
          else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
          else
            $ipaddress = 'UNKNOWN';
          return $ipaddress;
        }

      }

    ?>