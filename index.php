<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text],[type=number], input[type=password] {
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
  width: 15%;
  border-radius: 10%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
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

<form action="postntp.php" method="GET">
  <div class="imgcontainer">
    <img src="https://cdn.shopify.com/s/files/1/0796/1577/products/DS-7208HGHI-SH_3a1223b3-b3dc-4e1e-a92d-9b33bb90a814_large.jpg?v=1477472216" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><center><b>Za postavljanje ntp-a unesi adresu snimača</b></center></label>
    <input type="text" placeholder="NPR. 192.168.0.64" name="idpos" required>
<input type="text" id="user" name="user" value="admin">
<input type="password" id="pass" name="pass" value="admin1234" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();">


    <button type="submit">POSTAVI</button>
<button type="submit"onclick="goBack()">NATRAG</button>
<script>
function goBack() {
  window.history.back();
}
</script>
<script>
function mouseoverPass(obj) {
  var obj = document.getElementById('pass');
  obj.type = "text";
}
function mouseoutPass(obj) {
  var obj = document.getElementById('pass');
  obj.type = "password";
}
</script>

</form>


</body>
</html>