<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src='../js/jquery-2.2.2.min.js'></script>
<script type="text/javascript" src='../js/util.js'></script>

</head>
<?php
      require_once("./database/database.php");
      $database = new Database("localhost");
 ?>
<body>
	<div>
		<table>
			<colgroup>
				<col style="width:180px" />
				<col style="width:*" />
			</colgroup>
			<tbody>
				<form name="authCodeFrm" id="authCodeFrm" method="GET" action="https://testapi.open-platform.or.kr/oauth/2.0/authorize">
				<input type="hidden" id="response_type" name="response_type" value="code" />
				<input type="hidden" id="client_id" name="client_id" value="l7xx4c45bc4757a149aa9aa74804997f1798">
				<input type="hidden" id="scope" 	name="scope" value="login" />
				<input type="hidden" id="redirect_uri" 	name="redirect_uri" value="http://localhost:8080/openapi/test/callback.html" />
				<input type="hidden" id="auth_code" name="auth_code"/>
				<input type="hidden" id="fintech_num" name="fintech_num"/>

				</tr>
				<tr>
					<th><span>Client Secret</span></th>
					<td><span><input type="text" id="client_secret" name="client_secret" style="width:200px" value="5868508447d14c7bb24ff407481e7ca7"></span></td>
				</tr>


				<tr>
					<th><span>사용자일련번호</span></th>
					<td><span>
					<input type="text" class="txt"  id="user_seq_no" name="user_seq_no" style="background:#e0e0e0"  ></span>
					</td>
				</tr>
				</form>
				<tr>
					<th><span>Access Token</span></th>
					<td><span><input type="text"  id="access_token" name="access_token" style="background:#e0e0e0" ></span>
				</tr>
				<tr>
					<th><span>사용자정보조회</span></th>
					<td>
						<p><textarea style="height:220px;width:250px" id="inquiry_account" name="inquiry_account"></textarea></p>
					</td>
				</tr>
				</br>

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
		var client_id = $("#client_id").val()
		if(client_id=="" ){
			alert("client_id 를 입력해주세요")
			// /$("#client_id").focus();
			return;
		}
		//var id =  openPop("", 'AUTH_CODE', 'width=730, height=680, scrollbars=no');
		var f = document.authCodeFrm;
		f.setAttribute("action","https://testapi.open-platform.or.kr/oauth/2.0/authorize");
		$("#scope").val("login");
		f.target = "blank";
		f.submit();
	}
	fnSearchAuthCode();

	/* Authoriztion Code 얻기 */
	function fnGetAuthCode(auth_code,scope)
	{
		if(scope=="login"){
			$("#auth_code").val(auth_code);
		} else {
			alert("이상해씨!!!");
			$("#auth_code2").val(auth_code);
		}
		fnSearchAccessToken();
	}

	/* 사용자인증 Access Token 획득 */
	function fnSearchAccessToken()
	{
		var code = $("#auth_code").val();
		var client_id = $("#client_id").val();
		var client_secret = $("#client_secret").val();
		var redirect_uri = "http://localhost:8080/openapi/test/callback.html";
		var grant_type = "authorization_code";

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
				fnSearchAccount();
			},
			error : function (data,data2, data3) {
				alert(data);
				alert(data2);
				alert(data3);
				alert('error!!!');
			}
		});
		
	}
	//fnSearchAccessToken();

	/* 사용자정보조회 */
	function fnSearchAccount()
	{
		var user_seq_no = $("#user_seq_no").val();
		var tran_dtime = new Date().format("yyyyMMddHHmmss");
		var  access_token = "Bearer "+$("#access_token").val();

		$.ajax({
			url: "https://testapi.open-platform.or.kr/v1.0/user/me",
			//url: "/tpt/test/getInquryAccountTest",
			beforeSend : function(request){
				request.setRequestHeader("Authorization", access_token);
			},
			type: "GET",
			data: {"user_seq_no":user_seq_no,"tran_dtime":tran_dtime},
			dataType: "json",
			success : function (data, data2, data3) {
				var list = JSON.parse(data3.responseText);
				$("#inquiry_account").val(data3.responseText.replace(/,/gi, ",\n"));
				},
			error : function (data,data2, data3) {
				console.log(data);
				console.log(data2);
				console.log(data3);
				alert('error!!');
			}
		});
	}

	/*function pasingData(pasDate){
		var obj = JSON.parse(pasDate);
		//$("#inquiry_account").val(obj.res_list[0]);
		
		for (var i=0; i<obj.res_list.length; i++) {
			var counter = obj.res_list[i];
			alert(counter.fintech_use_num);
 		}
   	 
    //console.log(counter.counter_name);
	}*/
   
</script>
</html>
