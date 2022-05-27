<?php
error_reporting(0);
$n="\n"; $h = "\33[32;1m"; $b = "\33[0;36m"; $m = "\33[31;1m"; $p = "\e[1;37m";$dark="\033[1;30m"; $k = "\33[1;33m"; $c = "\e[1;36m"; $u = "\e[1;35m"; $abu = "\e[1;30m"; $end = "\033[0m"; $babu = "\033[100m"; $bmerah = "\033[101m"; $bputih = "\033[107m";
function save($data,$data_post){
if(!file_get_contents($data)){
file_put_contents($data,"[]");}
$json=json_decode(file_get_contents($data),1);
$arr=array_merge($json,$data_post);
file_put_contents($data,json_encode($arr,JSON_PRETTY_PRINT));}

function animasi($str){$arr = str_split($str); 
foreach ($arr as $az){echo $az; usleep(3000);}}
 if(!file_exists("data.json")){
 animasi($p." ID: {$k}Isi data di bawah ini sesuai intruksi\n");
 animasi($p." EN: {$k}Fill in the data below according to the instructions\n");
 $tumbal_usr=readline($p." username (tumbal): {$h}");
 $pswd_usr=readline($p." password (tumbal): {$h}");
 $username=readline($p." username: {$c}");
 animasi($p." Loading......"); sleep(2);
 $data=["username"=>$username,"pswd"=>$pswd_usr,"user"=>$tumbal_usr];
 save("data.json",$data); }

 $username=json_decode(file_get_contents("data.json"),true)["username"];
 $tumbal_usr=json_decode(file_get_contents("data.json"),true)["user"];
 $pswd_usr=json_decode(file_get_contents("data.json"),true)["pswd"];

function curl($url,$httpheader=0,$post=0){ 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    if($httpheader){
    curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
    }
    if($post){
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    curl_setopt($ch, CURLOPT_HEADER, true);
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch);
    if(!$httpcode) return "Curl Error : ".curl_error($ch); else{
    $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
    $body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
    curl_close($ch);
return array($header, $body)[1];}
}

function ryuk(){
 $ua=array();
 $ua[]="Host: app.ncse.info";
 $ua[]="x-requested-with: XMLHttpRequest";
 $ua[]="user-agent: Mozilla/5.0 (Linux; Android 10; dandelion Build/QP1A.190711.020;) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/91.0.4472.101 Mobile Safari/537.36";
 $ua[]="referer: https://app.ncse.info/";
 return $ua; }
 
function token(){
 $url="https://app.ncse.info/login";
 return curl($url,ryuk()); }

function mas_uk(){
 global $tumbal_usr,$pswd_usr,$token;
 $url="https://app.ncse.info/login?";
 $data="username={$tumbal_usr}&password={$pswd_usr}&userid=&antiForgeryToken=".$token;
 return curl($url,ryuk(),$data); }

function cari_usr_fl(){
 global $username;
 $url="https://app.ncse.info/tools/send-follower?formType=findUserID";
 $data="username={$username}";
 return curl($url,ryuk(),$data); }
 
function followers(){
 global $id,$username;
 $url="https://app.ncse.info/tools/send-follower/".$id."?formType=send";
 $data="adet=15&userID=$id&userName=$username";
 return curl($url,ryuk(),$data); }

system("clear");
animasi($m." ╔═╗{$p}┬    {$m}╔╗╔{$p}┌─┐┌─┐┌─┐ \n");
animasi($m." ╠╣ {$p}│    {$m}║║║{$p}│  └─┐├┤  \n");
animasi($m." ╚  {$p}┴─┘  {$m}╝╚╝{$p}└─┘└─┘└─┘\n");
animasi("  {$c}~ {$p}Youtube: sholeh 10\n");
animasi("  {$c}~ {$p}Instagram: sholehezz\n");

system("rm cookie.txt"); 
$tok = token();
$token = explode('";',explode('&antiForgeryToken=',$tok)[1])[0];
echo"\n";
animasi($p."\r mencoba login...\r");

$masuk = mas_uk();
$status = json_decode($masuk)->status;

 if($status=="success"){
 animasi($c."\r Tersambung {$p}ke akun  \r"); sleep(2);
 animasi($c." Apa yang bisa saya bantu tuan?\n");
 animasi($k." 1{$abu}. {$p}Auto Followers IG\n");
 animasi($k." 2{$abu}. {$p}Join Group WA\n");
 animasi($k." 3{$abu}. {$p}Exit\n\n"); 
 
 $menu = readline($p." Menu: {$k}");
  if($menu==1){
  $cari = cari_usr_fl();
  $id = explode('"',explode('<input type="hidden" name="userID" value="',$cari)[1])[0];
  
  $sent_fl = followers();
  $js = json_decode($sent_fl,1);
  $has = $js["status"];
  file_put_contents("has",$sent_fl);
   if($has=="success"){
   animasi($p." Messages{$abu}: {$h}Succes{$p}, menambahkan follower ke {$c}@{$username}\n");
   exit;
   }else{
   animasi($p." Messages{$abu}: {$m}Failed{$p}, point anda habis harap tunggu beberapa menit lagi\n");
   exit;
   }  
  }
  if($menu==2){
 system("xdg-open https://chat.whatsapp.com/KLCdEr5kYSDCoKpwggTaPc");
  animasi($p." Ikuti peraturan yang ada pren :')\n");
  exit; }
  if($menu==3){
  animasi($p." Bay bay My Friends\n");
  exit; }
 }else{
 animasi(" {$m}Gagal {$p}tersambung ke akun\n");
 }