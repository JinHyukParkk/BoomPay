<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
        <script src='../js/jquery-2.2.2.min.js' type="text/javascript"></script>
        <script src='../js/util.js' type="text/javascript"></script>

    </head>

    <body>
        <form
            action="https://testapi.open-platform.or.kr/oauth/2.0/authorize"
            id="authCodeFrm"
            method="GET"
            name="authCodeFrm">
            <input id="response_type" name="response_type" type="hidden" value="code"/>
            <input
                id="client_id"
                name="client_id"
                type="hidden"
                value="l7xx4c45bc4757a149aa9aa74804997f1798">
            <input id="scope" name="scope" type="hidden" value="login"/>
            <input
                id="redirect_uri"
                name="redirect_uri"
                type="hidden"
                value="http://localhost:8080/openapi/test/callback.html"/>
            <input id="auth_code" name="auth_code" type="hidden"/>
            <input id="fintech_num" name="fintech_num" type="hidden"/>
            <input
                class="txt"
                id="user_seq_no"
                name="user_seq_no"
                type="hidden">
            <input
                id="client_secret"
                name="client_secret"
                type="hidden"
                value="5868508447d14c7bb24ff407481e7ca7">
        </form>

        <input id="auth_code2" name="auth_code2" type="hidden"/>

        <input
            id="access_token"
            name="access_token"
            type="hidden">
        <input
            id="access_token1"
            name="access_token1"
            type="hidden">
        <input
            id="access_token3"
            name="access_token3"
            type="hidden">
        <input
            id="access_token4"
            name="access_token4"
            type="hidden">

    </body>

    <script type="text/javascript">
        $.support.cors = true;
        var currentTime = new Date().format("yyyyMMddHHmmss");
        $("#tran_dtime").val(currentTime);
        function fnSearchAuthCode() {
            var client_id = $("#client_id").val()
            if (client_id == "") {

                // /$("#client_id").focus();
                return;
            }
            //var id =  openPop("", 'AUTH_CODE', 'width=730, height=680, scrollbars=no');
            var f = document.authCodeFrm;
            f.setAttribute("action", "https://testapi.open-platform.or.kr/oauth/2.0/authorize");
            $("#scope").val("login");
            f.target = "blank";
            f.submit();
        }
        fnSearchAuthCode();
        function fnGetAuthCode(auth_code, scope) {
            if (scope == "login") {
                $("#auth_code").val(auth_code);
                fnSearchAccessToken();
                fnSearchAccessToken1();
            } else if (scope == "inquiry") {
                $("#auth_code2").val(auth_code);
                fnSearchAccessToken2();
            } else {
                $("#auth_code2").val(auth_code);
                fnSearchAccessToken3();
            }

        }
        function fnSearchAccessToken() {
            var code = $("#auth_code").val();
            var client_id = $("#client_id").val();
            var client_secret = $("#client_secret").val();
            var redirect_uri = "http://localhost:8080/openapi/test/callback.html";
            var grant_type = "authorization_code";

            $.ajax({
                cache   : false,
                data    : {
                    "client_id"    : client_id,
                    "client_secret": client_secret,
                    "code"         : code,
                    "grant_type"   : grant_type,
                    "redirect_uri" : redirect_uri
                },
                dataType: "json",
                error   : function (data, data2, data3) {

                },
                success : function (data, data2, data3) {
                    var list = JSON.parse(data3.responseText);
                    $("#access_token").val(list.access_token);
                    $("#user_seq_no").val(list.user_seq_no);
                },
                type    : "POST",
                url     : "https://testapi.open-platform.or.kr/oauth/2.0/token"
            });
        }
        function fnSearchAccessToken1() {
            var client_id = $("#client_id").val();
            var client_secret = $("#client_secret").val();
            var grant_type = "client_credentials";
            var scope = "oob";
            $.ajax({
                //cache: false,
                contenType: "application/json",
                data      : {
                    "client_id"    : client_id,
                    "client_secret": client_secret,
                    "grant_type"   : grant_type,
                    "scope"        : scope
                },
                dataType  : "json",
                error     : function (data, data2, data3) {

                },
                success   : function (data, data2, data3) {
                    var list = JSON.parse(data3.responseText);
                    $("#access_token1").val(list.access_token);
                    fnAuthorizeAccount('inquiry');
                },
                type      : "POST",
                //url: "/tpt/test/getOauthToken",
                url       : "https://testapi.open-platform.or.kr/oauth/2.0/token"
            });
        }
        function fnSearchAccessToken2() {
            var code = $("#auth_code2").val();
            var client_id = $("#client_id").val();
            var client_secret = $("#client_secret").val();
            var redirect_uri = "http://localhost:8080/openapi/test/callback.html";
            var grant_type = "authorization_code";
            $.ajax({
                cache   : false,
                data    : {
                    "client_id"    : client_id,
                    "client_secret": client_secret,
                    "code"         : code,
                    "grant_type"   : grant_type,
                    "redirect_uri" : redirect_uri
                },
                dataType: "json",
                error   : function (data, data2, data3) {

                },
                success : function (data, data2, data3) {
                    var list = JSON.parse(data3.responseText);
                    $("#access_token3").val(list.access_token);
                    fnAuthorizeAccount('transfer');
                },
                type    : "POST",
                url     : "https://testapi.open-platform.or.kr/oauth/2.0/token"
            });
        }
        function fnSearchAccessToken3() {
            var code = $("#auth_code2").val();
            var client_id = $("#client_id").val();
            var client_secret = $("#client_secret").val();
            var redirect_uri = "http://localhost:8080/openapi/test/callback.html";
            var grant_type = "authorization_code";
            $.ajax({
                cache   : false,
                data    : {
                    "client_id"    : client_id,
                    "client_secret": client_secret,
                    "code"         : code,
                    "grant_type"   : grant_type,
                    "redirect_uri" : redirect_uri
                },
                dataType: "json",
                error   : function (data, data2, data3) {

                },
                success : function (data, data2, data3) {
                    var list = JSON.parse(data3.responseText);
                    $("#access_token4").val(list.access_token);
                    return fnSearchAccount();
                },
                type    : "POST",
                url     : "https://testapi.open-platform.or.kr/oauth/2.0/token"
            });
        }
        function fnAuthorizeAccount(strScope) {
            var client_id = $("#client_id").val();
            var redirect_uri = "http://localhost:8080/openapi/test/callback.html";

            var form = document.authCodeFrm;
            form.setAttribute("method", "GET");
            form.setAttribute("action", "https://testapi.open-platform.or.kr/oauth/2.0/authorize_account");
            $("#scope").val(strScope);
            form.target = "blank";
            form.submit();
        }
        function fnSearchAccount() {
            var user_seq_no = $("#user_seq_no").val();
            var tran_dtime = new Date().format("yyyyMMddHHmmss");
            var access_token = "Bearer " + $("#access_token").val();
            $.ajax({
                //url: "/tpt/test/getInquryAccountTest",
                beforeSend: function (request) {
                    request.setRequestHeader("Authorization", access_token);
                },
                data      : {
                    "tran_dtime" : tran_dtime,
                    "user_seq_no": user_seq_no
                },
                dataType  : "json",
                error     : function (data, data2, data3) {
                    console.log(data);
                    console.log(data2);
                    console.log(data3);

                },
                success   : function (data, data2, data3) {
                    var list = JSON.parse(data3.responseText);
                    loginDataPasingData(data3.responseText.replace(/,/gi, ",\n"));
                },
                type      : "GET",
                url       : "https://testapi.open-platform.or.kr/v1.0/user/me"
            });
        }
        function loginDataPasingData(pasDate) {
            var content = JSON.parse(pasDate);
            var user_name = content.user_name;
            var output = "사용자 이름 : " + content.user_name + "\n계좌 갯수 : " + content.res_cnt;
            var incotent = content.res_list;

            var ood_token = $("#access_token1").val();
            var inquiry_token = $("#access_token3").val();
            var transfer_token = $("#access_token4").val();
            output += "\n\nood : " + ood_token + "\n\ninquiry : " + inquiry_token + "\n\ntransfer : " + transfer_token;

            var tmp = {};
            tmp.name = user_name;
            tmp.ood = ood_token;
            tmp.inquiry = inquiry_token;
            tmp.transfer = transfer_token;
            var tmp2 = tmp.name+","+tmp.ood+","+tmp.inquiry+","+tmp.transfer;

            $.ajax({
                type:"POST",
                url:"/openapi/test/test1.php",
                data: {name : tmp.name,
                    ood : ood_token,
                    inquiry: inquiry_token,
                    transfer : transfer_token
                },
                success:function(data){
                },
                error:function(data){
                }
            });

            var accountTmp2 = "";

            for (var i = 0; i < incotent.length; i++) {
                var accountTmp = {};

                output += "\n\n핀테크 이용번호 : " + incotent[i].fintech_use_num;
                output += "\n은행 코드 : " + incotent[i].bank_code_std;
                output += "\n계좌 이름 : " + incotent[i].account_alias;
                output += "\n계좌 번호 : " + incotent[i].account_num_masked;

                accountTmp.user_name = user_name;
                accountTmp.fintech_use_num = incotent[i].fintech_use_num;
                accountTmp.bank_code_std = incotent[i].bank_code_std;
                accountTmp.account_num_masked = incotent[i].account_num_masked;
                accountTmp.account_num_masked = accountTmp.account_num_masked.replace("***","000");
                accountTmp2 += accountTmp.user_number + "," + accountTmp.fintech_use_num + "," + accountTmp.bank_code_std + "," + accountTmp.account_num_masked +"\n";

                $.ajax({
                    type:"POST",
                    url:"/openapi/test/test1.php",
                    data: {user_name: accountTmp.user_name,
                        fintech_use_num: incotent[i].fintech_use_num,
                        bank_code_std: incotent[i].bank_code_std,
                        account_num_masked: accountTmp.account_num_masked
                    },
                    success:function(data){
                    },
                    error:function(data){
                    }
                });

            }

        }
    </script>
</html>