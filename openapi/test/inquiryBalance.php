<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src='../js/jquery-2.2.2.min.js'></script>
<script type="text/javascript" src='../js/system.js'></script>
<script type="text/javascript" src='../js/util.js'></script>
</head>
<?php
	require_once("database/database.php");
	$database = new Database("localhost");
?>		
<body>
	<div>
		<table>
			<caption>잔액 조회</caption> <br/>
			<colgroup>
				<col style="width:180px" />
				<col style="width:*" />
			</colgroup>
			<tbody>
				<form name="authCodeFrm" id="authCodeFrm" method="GET" action="https://testapi.open-platform.or.kr/oauth/2.0/authorize">
				<input type="hidden" id="response_type" name="response_type" value="code" />
				
				<input type="hidden" id="scope" name="scope" value="inquiry" />
				<input type="hidden" id="redirect_uri" 	name="redirect_uri" value="http://localhost:8080/openapi/test/callback.html" />
				</form>
				<tr>
					<th><span>
				<?php 
					$database->get_token();
					?>
					</span></th>
				</tr>
				<tr>
					<th><span>핀테크이용번호</span></th>
					<td><span><input type="text" class="txt" title="핀테크이용번호 입력"  id="fintech_use_num" name="fintech_use_num" value="101000304669721238728249" /></span>
				</tr>
				<tr>
					<th><span>요청일시</span></th>
					<td><span style="width:200px"><input type="text" class="txt" id="tran_dtime" title="요청일시 입력" name="tran_dtime"  /></span>
					<button type="button" onclick="fnInquryBalance()">잔액조회</button></td>
				</tr>
				<tr>
					<th><span>잔액조회결과</span></th>
					<td>
						<textarea style="height:220px;width:250px" id="inquiry_account" name="inquiry_account"></textarea>
					</td>
				</tr>
			</tbody>
		</table>

	</div>
</body>

<script type="text/javascript">
	$.support.cors = true;
	var currentTime = new Date().format("yyyyMMddHHmmss");
	$("#tran_dtime").val(currentTime);

	function fnSearchAuthCode()
	{
		var client_id = $("#client_id").val();
		if(client_id=="" ){
			alert("client_id 를 입력해주세요")
			$("#client_id").focus();
		}

		var f = document.authCodeFrm;
		f.target = "blank";
		f.submit();
	}

	
	/* Authoriztion Code 얻기 */
	function fnGetAuthCode(auth_code,scope)
	{
		$("#auth_code").val(auth_code);
		return fnSearchAccessToken();
	}


	/* 사용자인증 Access Token 획득 */
	function fnSearchAccessToken()
	{
		var code = $("#auth_code").val();
		var client_id = $("#client_id").val();
		var client_secret = $("#client_secret").val();
		var redirect_uri = "http://localhost:8080/openapi/test/callback.html";
		var  grant_type = "authorization_code";
		 $.ajax({
			url: "https://testapi.open-platform.or.kr/oauth/2.0/token",
			type: "POST",
			cache: false,
			data: {"code":code,"client_id":client_id,"client_secret":client_secret,"redirect_uri":redirect_uri,"grant_type":grant_type},
			dataType: "json",
			success : function (data, data2, data3) {
				var list = JSON.parse(data3.responseText);
				$("#access_token").val(list.access_token);
				$("#user_seq_no").val(list.user_seq_no);
				return fnInquryBalance();
				},
			error : function (data,data2, data3) {
				alert('error!!!');
			}
		});

	}

	/* 잔액조회API */  //inquiry_account
	function fnInquryBalance()
	{
		var fintech_use_num = $("#fintech_use_num").val();
		var tran_dtime = $("#tran_dtime").val();
		var  access_token = "Bearer "+$("#access_token").val();

		 $.ajax({
			url: "https://testapi.open-platform.or.kr/v1.0/account/balance",
			beforeSend : function(request){
				request.setRequestHeader("Authorization", access_token);
			},
			type: "GET",
			data: {"fintech_use_num":fintech_use_num,"tran_dtime":tran_dtime},
			dataType: "json",
			success : function (data, data2, data3) {
				//  alert(data);
				//alert(data2);
				//alert(data3.responseText);
				//$("#inquiry_account").val(data3.responseText.replace(/,/gi, ",\n"));
				moneyDataPasing(data3.responseText.replace(/,/gi, ",\n"));
				//$("#access_token").val(data.access_token);
				//$("#user_seq_no").val(data.user_seq_no);
				},
			error : function (data,data2, data3) {
				console.log(data);
				console.log(data2);
				console.log(data3);
				alert('error!!!');
			}
		});
	}
	function moneyDataPasing(pasDate){
		var content = JSON.parse(pasDate);
		var money = content.balance_amt;
		$("#inquiry_account").val(money);

	}

</script>
</html>
