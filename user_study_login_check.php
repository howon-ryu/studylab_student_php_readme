<?php
   require_once('m.dbcon.php');
   session_start();
   // $host = '211.254.212.182:13306';
   // $user = 'root';
   // $pw = '1howtobiz';
   // $db_name = 'studylab';

   //    $mysqli = new mysqli($host, $user, $pw, $db_name); //db 연결
   //    $mysqli->set_charset("utf8");
      
   //login.php에서 입력받은 id, password
   $loginId = $_POST['loginId'];
   $password = $_POST['password'];
   
   $loginId = $_POST['loginId'];
   $password = $_POST['password'];
   $hostname=$_SERVER["HTTP_HOST"];
   $exploded_hostname=explode('.',$hostname);
   $service_domain=$exploded_hostname[0];
   error_log("lc_service_domain: $service_domain");
   if($service_domain=="student"){
      $q = "SELECT *,user.id as user_id FROM user WHERE loginId = '$loginId' AND password = '$password'";
   }
   else{
      $q = "SELECT *,user.id as user_id FROM user inner join brand on user.brand_id = brand.id WHERE loginId = '$loginId' AND password = '$password' and brand.service_domain = '$service_domain'";
   }



   // $q = "SELECT * FROM user WHERE loginId = '$loginId' AND password = '$password'";
   error_log('query: '.$q);
   error_log(print_r($q, true));

   $result = sql_query($q);
   $row = $result->fetch_array();
   
   //결과가 존재하면 세션 생성
   if ($row != null) {
      
        
      
      error_log('세션 생성');
      $_SESSION['loginid'] = $row['loginid'];
      $_SESSION['realName'] = $row['real_name'];
      // error_log(print_r($row['id'], true));
      $_SESSION['id'] = $row['user_id'];
      $brand_id_v = $row['brand_id'];
      $branch_id_v = $row['branch_id'];
      $room_id_v = $row['room_id'];
      $_SESSION['seatNumber'] = $row['seat_number'];
      
      error_log("branch_id_v:$branch_id_v");
      // error_log("@@@id@@@:$_SESSION[id]");
      $query_forbrandname = "SELECT name FROM brand WHERE id = '$brand_id_v'";
      $result_brandname = sql_query($query_forbrandname);
      $brand_name = $result_brandname->fetch_array();
      error_log(print_r($brand_name, true));
      $query_forbranchname = "SELECT name FROM branch WHERE id = '$branch_id_v'";
      $result_branchname = sql_query($query_forbranchname);
      $branch_name = $result_branchname->fetch_array();

      $query_forroomname = "SELECT name FROM branch_room WHERE id = '$room_id_v'";
      $result_roomname = sql_query($query_forroomname);
      $room_name = $result_roomname->fetch_array();

      $_SESSION['branchId'] = $branch_id_v;
      $_SESSION['brandName'] = $brand_name['name'];
      $_SESSION['branchName'] = $branch_name['name'];
      $_SESSION['roomName'] = $room_name['name'];


      $_SESSION['brandId'] = $brand_id_v;





      // echo "<script>location.replace('index.php');</script>";
      echo ("<meta http-equiv='refresh' content='0;url=user_study_timer.php'>");
      
   }
   
   //결과가 존재하지 않으면 로그인 실패
   if($row == null){
      echo "<script>alert('아이디 또는 비밀번호가 일치하지 않습니다.')</script>";
      echo "<script>location.replace('user_study_login.php');</script>";
      exit;
   }
?>