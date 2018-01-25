<!DOCTYPE html>
<html lang=en> 
<head>
<meta charset=utf-8>
<meta content="IE=edge" http-equiv=X-UA-Compatible>
<meta content="width=device-width,initial-scale=1" name=viewport>
<meta name="viewport" content="width=device-width, initial-scale=1">


<!-- Include the jQuery library -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include the jQuery Mobile library -->
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<title> Bombpay </title> 
</head>
<body style="margin: 0px auto;">
  <div class ="test">
  		<div>
			<button type="button" id="makeRoom">방 만들기</button>
			<button type="button" id="joinRoom">QR코드</button>
  		</div>
  		<div>
	  		<form>
	      	roomName : <input type="text" name="roomName">
	      	roomPrice : <input type="text" name="roomPrice">
	      	roomPeople : <input type="text" name="roomPeople">
	      	roomType :<br>
	      	<input type="radio" name="roomType" value="NBBang" checked> NBBang<br>
			<input type="radio" name="roomType" value="MolBBang"> MolBBang<br>
			<input type="radio" name="roomType" value="Other"> Other
			<div id="roomTypeOther"></div>
	      	<button type="button" id="confirmRoom">confirm room</button>
  		</div>
      </form>
  </div>
  <script src="http://192.168.70.31:7896/bombpay/main.js"></script>
</body>
</html>
