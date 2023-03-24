<?php
    require_once('m.dbcon.php');
  $hostname=$_SERVER["HTTP_HOST"];
  $exploded_hostname=explode('.',$hostname);
  $service_domain=$exploded_hostname[0];
  

  error_log("service_domain: ".$service_domain);
  $brand_query="SELECT * FROM
  brand
  WHERE
  service_domain='$service_domain'
  LIMIT 1";


  error_log("brand_query: ".$brand_query);

  $query_result=sql_query($brand_query);
  if ($query_result == true) {
    $row = $query_result->fetch_array();
    $service_brand_id=$row['id'];
    $service_brand_name=$row['name'];
    
}
if($service_brand_id==""){
    $service_brand_id="0";
    $service_brand_name="Herestudy";
  }


  
  error_log("service_brand_id: ".$service_brand_id);
  error_log("service_brand_name: ".$service_brand_name);
    
    
    $dir = "./media/saveImg/".$service_brand_id;
    $kk = is_dir($dir);
    $logo_img_flag=false;
      if($dh = opendir($dir)) {
        
        while(($file = readdir($dh)) !== false) {
            
            if ($file == "." || $file == "..") {
                continue;
              }
              $fname = $dir.$file;
            error_log("$file");
            $tempname = explode('.', $file)[0];

            if($tempname == "logo_img"){
              $logo_img = "./media/saveImg/".$service_brand_id."/".$file;
              $logo_img_flag=true;
            }

            if($tempname == "favicon_img"){
              $favicon_img = "./media/saveImg/".$service_brand_id."/".$file;
            }
            
            
        }
    
        closedir($dh);
        error_log("logo img: ".$logo_img);
        error_log("logo_img_flag: ".$logo_img_flag);
        error_log("favicon img: ".$favicon_img);
        
  }

?>

<title><?=$service_brand_name?></title>
<link rel="icon" type="image/png" href="<?=$favicon_img?>"/>