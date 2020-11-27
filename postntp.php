<?php
$idpos = $_GET["idpos"];
$user = $_GET["user"]; 
$pass = $_GET["pass"];  
$filename = "ntp.xml";
$handle = fopen($filename, "r");
$XPost = fread($handle, filesize($filename));
fclose($handle);
$url = 'http://'.$idpos.'/ISAPI/System/time/ntpServers/'; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $XPost);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: text/xml"]); 

$result=curl_exec($ch);


if (empty($result)) {
   die(curl_error($ch));
   curl_close($ch); 
} else {
   $info = curl_getinfo($ch);
   curl_close($ch); 
   if (empty($info['http_code'])) {
           die("No HTTP code was returned");
   } else {
      
       $http_codes = parse_ini_file("response.inc");
 //      echo "The server responded: \n";
 //      echo $info['http_code'] . " " . $http_codes[$info['http_code']];
   }
}

///////////////////////////////////////////   NTP POSTAVLJANJE  /////////////////////////////

//////////////////////////////////////////// PREBACI NA NTP //////////////////////////

$filename1 = "prebaci.xml";
$handle1 = fopen($filename1, "r");
$XPost1 = fread($handle1, filesize($filename1));
fclose($handle1);
$url7 = 'http://'.$idpos.'/ISAPI/System/time/'; 

$ch7 = curl_init();
curl_setopt($ch7, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
curl_setopt($ch7, CURLOPT_USERPWD, "$user:$pass");
curl_setopt($ch7, CURLOPT_URL, $url7);
curl_setopt($ch7, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch7, CURLOPT_POSTFIELDS, $XPost1);
curl_setopt($ch7, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch7, CURLOPT_HTTPHEADER, ["Content-Type: text/xml"]); 

$result7=curl_exec($ch7);


if (empty($result7)) {
   // some kind of an error happened
   die(curl_error($ch7));
   curl_close($ch7); // close cURL handler
} else {
   $info7 = curl_getinfo($ch7);
   curl_close($ch7); // close cURL handler
   if (empty($info7['http_code'])) {
           die("No HTTP code was returned");
   } else {
       // load the HTTP codes
       $http_codes7 = parse_ini_file("response.inc");
      
   
  //     echo "The server responded: \n";
  //     echo $info['http_code'] . " " . $http_codes7[$info7['http_code']];
   }
}

            


$title = "DVR INFO";
/////////////////////  Vrijeme snimača /////////////
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://'.$idpos.'/ISAPI/System/time/');
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
curl_setopt($ch, CURLOPT_USERPWD, "$user:$pass");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: text/xml"]); 
curl_setopt($ch, CURLOPT_HTTPGET, 1);
$vrijemesnimaca = curl_exec($ch);

///////////////////////////////////////////////////////////
$response = curl_exec($ch);
if ($response == false)
{
    echo curl_error($ch);
}
curl_close($ch);

$xml = simplexml_load_string($response);
$json = json_encode($xml);
$array = json_decode($json, true);

/////////////////////  podaci HDD /////////////
$cp = curl_init();

curl_setopt($cp, CURLOPT_URL, 'http://'.$idpos.'/ISAPI/ContentMgmt/Storage/hdd/');
curl_setopt($cp, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
curl_setopt($cp, CURLOPT_USERPWD, "$user:$pass");

curl_setopt($cp, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cp, CURLOPT_HTTPHEADER, ["Content-Type: text/xml"]); 
curl_setopt($cp, CURLOPT_HTTPGET, 1);
$vrijeme1 = curl_exec($cp);

///////////////////////////////////////////////////////////
$response1 = curl_exec($cp);
if ($response1 == false)
{
    echo curl_error($cp);
}
curl_close($cp);

$xml1 = simplexml_load_string($response1);
$json1 = json_encode($xml1);
$array1 = json_decode($json1, true);

/////////////////////  PODACI HDD /////////////

/////////////////////  podaci IP /////////////
$ch2 = curl_init();

curl_setopt($ch2, CURLOPT_URL, 'http://'.$idpos.'/ISAPI/System/Network/interfaces/');
curl_setopt($ch2, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
curl_setopt($ch2, CURLOPT_USERPWD, "$user:$pass");


curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch2, CURLOPT_HTTPHEADER, ["Content-Type: text/xml"]); 
curl_setopt($ch2, CURLOPT_HTTPGET, 1);
$ippaddrr1 = curl_exec($ch2);

///////////////////////////////////////////////////////////
$response2 = curl_exec($ch2);
if ($response2 == false)
{
    echo curl_error($ch2);
}
curl_close($ch2);

$xml2 = simplexml_load_string($response2);
$json2 = json_encode($xml2);
$array2 = json_decode($json2, true);


/////////////////////  PODACI IP /////////////



?>


<!doctype html>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootswatch/2.3.2/cosmo/bootstrap.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}
.bzze{
	color:#009900;
	text-align:left;
	
}

.bzze1{
	color:#009900;
	text-align:center;
	
}
.linija{
  border: 1px solid green;
  border-radius: 5px;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 20%;
  border-radius: 10%;
}

.container1 {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}



.container {
    width: 900px;
    max-width: 1000px;
    height: 430px;
    margin: 10px auto;

    display: flex;
    justify-content: space-around;
    align-items: center;
    box-shadow: 10px 10px 30px #2C243F;
}

.card {
    height: 420px;
    width: 100%;
    text-align: left;
    padding: 50px 40px;
}

.card small {
    color: rgba(255, 255, 255, 1);
    font-weight: 700;
		text-align:center;
}

.card p {
    margin: 10px 0px 20px;
}

.card p {
    line-height: 22px;
    width: 210px;
    height: 7px;
}

.card div {
    margin-top: 25px;
}

.card div a {
    color: #fff;
    text-decoration: none;
}

.card div a:hover {
    text-decoration: underline;
    color: rgba(255, 255, 255, 0.8);
}

.card div a i {
    padding-left: 5px;
    color: #fff;
}

/* Cards colors */
.blue {
    background-color: #4caf50b3;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
}

.purple {
    background-color: #4caf50cf;
}

.pink {
    background-color: #4caf50;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}

/* Media queries */
@media screen and (max-width: 375px) {
    .container {
        width: 90%;
        margin: 20px auto;

        display: flex;
        flex-direction: column;
    }

    .blue {
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        border-bottom-left-radius: 0;
    }

    .pink {
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
        border-top-right-radius: 0;
    }
}


/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
    </head>
    <body>
	<hr class="linija"></hr>
<h3 class="bzze1"><strong>- INFORMACIJE DVR-a -</strong></h3>
 <center><img src="https://cdn.shopify.com/s/files/1/0796/1577/products/DS-7208HGHI-SH_3a1223b3-b3dc-4e1e-a92d-9b33bb90a814_large.jpg?v=1477472216" alt="Avatar" style="width:20%"></center>
<div class="container">

      <div class="card blue">
        <small>- Vrijeme na snimaču -</small>
		<br>
        <h4>Vrijeme:  </h4>
		<small><?php    echo $array["localTime"];?></small>
        <h4>Vremenska zona:  </h4>
		<small><?php    echo $array["timeZone"];?></small>
        <h4>Način rada:  </h4>
		<small><?php    echo $array["timeMode"];?></small>

      </div>
	  
      <div class="card purple">
        <small>- HDD -</small>
		<br>
        <h4>Tip:   </h4>
		<small><?php    echo $array1["hdd"]["hddType"];?></small>
        <h4>Naziv:   </h4>
		<small><?php    echo $array1["hdd"]["hddName"];?></small>
        <h4>Status:   </h4>
		<small><?php    echo $array1["hdd"]["status"];?></small>
        <h4>Veličina:   </h4>
		<small><?php    echo $array1["hdd"]["capacity"];?></small>
        <h4>Slobodno:   </h4>	
        <small><?php    echo $array1["hdd"]["freeSpace"];?></small>		
      </div>
	  
	  
      <div class="card pink">
        <small>- IP postavke -</small>
		<br>
        <h4>IP:  </h4>
		<small><?php echo $array2["NetworkInterface"]["IPAddress"]["ipAddress"];?></small>
        <h4>Mask:  </h4>
		<small><?php    echo $array2["NetworkInterface"]["IPAddress"]["subnetMask"];?></small>
        <h4>Router:  </h4>
		<small><?php    echo $array2["NetworkInterface"]["IPAddress"]["DefaultGateway"]["ipAddress"];?></small>
        <h4>DNS 1:  </h4>
		<small><?php    echo $array2["NetworkInterface"]["IPAddress"]["PrimaryDNS"]["ipAddress"];?></small>
        <h4>DNS 2:  </h4>
        <small><?php    echo $array2["NetworkInterface"]["IPAddress"]["SecondaryDNS"]["ipAddress"];?></small>		

      </div>
    </div>

<button type="submit"onclick="goBack()">NATRAG</button>


        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script>
function goBack() {
  window.history.back();
}
</script>


    </body>
</html>

