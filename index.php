<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="IE=edge" http-equiv=X-UA-Compatible>
	<meta content="width=device-width,initial-scale=1" name=viewport>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BombPay</title>


	<link rel="stylesheet" type="text/css" href="lib/jquery.fullPage.css" />
	<link rel="stylesheet" type="text/css" href="main.css" />
    <link href="vendors/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>
<body>

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#page-top">BombPay</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right" id="menu">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li data-menuanchor="AddAccount">
                    <a href="#AddAccount">계좌등록</a> <!-- 계좌들을 볼 수 있는 메뉴, 잔액,이체 등-->
                </li>
                <li data-menuanchor="MakeRoom">
                    <a href="#MakeRoom">방만들기</a>
                </li>
                <li data-menuanchor="QR">
                    <a href="#QR">입장하기</a> 
                </li>
                <li data-menuanchor="QR">
                    <a id="testbutton">Test</a> 
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<div id="fullpage">
	<div class="section" id="section0">
		<div class="intro">
			<div style="font-size: 50px; color:#333333; font-weight: bold;">
                <span class="name">계좌등록</span>
            </div>
			<div style="font-size: 20px; color:#111111;">봄페이를 이용하기 위해선 계좌등록이 필요합니다.</div>
            <p></p>
        <form class="form-inline">
            <div class="form-group has-success has-feedback">
                <select class="form-control" style="font-size: 20px; height: 20%; text-align:center;margin-top: 10px;">
                  <option>신한은행</option>
                  <option>농협</option>
                  <option>국민은행</option>
                  <option>하나은행</option>
                  <option>우리은행</option>
                </select>
                <input type="text" style="font-size: 20px; height: 20%; text-align:center; margin-top: 10px;" class="form-control" id="account_number" placeholder="계좌번호를 입력하세요.">
                <input type="text" style="font-size: 20px; height: 20%; text-align:center; margin-top: 10px;" class="form-control" id="account_number" placeholder="계좌별명을 입력하세요."><p></p>
                <a href="#"><button type="button" class="btn btn-primary btn-xs btn-block">추가</button></a>
            </div>
        </form>
            
        </div>
       </div>
	

	<div class="section">
        <div class="slide">
            <div class="intro">
                <h1>QR Code를 인식해주세요.</h1>
            </div>
        </div>
	    <div class="container-fluid slide">
            <div class="col-md-12">
                <div style="font-size: 40px; color:#333333; font-weight: bold;">
                	<span class="name">Let's BombPay!</span>
                </div>
            	<div style="font-size: 120px;">
                	<i class="fa fa-bomb" aria-hidden="true"></i>
                </div>
                <div class="intro-text">
                    <p>
					  <button type="button" id="makeRoom" class="btn btn-primary btn-lg">방만들기</button>
					</p>
					<p>
					  <button type="button" id="joinRoom" class="btn btn-default btn-lg">입장하기</button>
					</p>
                </div>
            </div>
        </div>
        <div class="container-fluid slide">
            <div class="intro col-md-12">
                <div style="font-size: 50px; color:#333333; font-weight: bold;">
                    <span class="name">방만들기</span>
                </div>

                <form class="form-inline">
                    <div class="form-group has-success has-feedback">
                        <input type="text" style="font-size: 20px; height: 20%; text-align:center; margin-top: 10px;" name="roomName" class="form-control"  placeholder="방이름">
                        <input type="text" style="font-size: 20px; height: 20%; text-align:center; margin-top: 10px;" name="roomPeople" class="form-control"  placeholder="인원">
                        <input type="text" style="font-size: 20px; height: 20%; text-align:center; margin-top: 10px;" name="roomPrice" class="form-control"  placeholder="가격">

                        <div style="margin-top: 5px; margin-bottom: 5px;">
                            <!-- Contextual button for informational alert messages -->
                            <button type="button" name="roomType" value="NBBang" class="btn btn-xs btn-info "> 엔빵 </button>

                            <!-- Indicates caution should be taken with this action -->
                            <button type="button" name="roomType" value="MolBBang" class="btn btn-xs btn-warning"> 몰빵 </button>

                            <!-- Indicates a dangerous or potentially negative action -->
                            <button type="button" name="roomType" value="Other" class="btn btn-xs btn-danger"> 비율 </button>
                        </div>
                        

                        <!--비율일때 나오는-->
                        <div id="roomTypeOther">

                        </div>
                        <a href="#"><button type="button" id="confirmRoom" class="btn btn-primary btn-xs btn-block">만들기</button></a>
                    </div>
                </form>
            </div>
        </div>
	</div>
    <div class="section">
        <div class="intro">
            <h1 id ="tmp">붐페이 타임!</h1>
            <div style="font-size: 150px;">
                <i class="fa fa-bomb bombani" aria-hidden="true"></i>
            </div>
        </div>
    </div>

    <div class="section">
        <!-- 계좌 테이블 여기에 받아서 생성 -->
        
        <div style="font-size: 50px; color:#333333; font-weight: bold;">
            <span class="name">계좌선택</span>
        </div>
        
        <div class="container-fluid">
            <div class="col-lg-10 text-center">

                <div class="panel panel-default">

                    <table class="table">
                        <tr><td>은행이름</td><td>계좌번호</td><td>이체</td><td>잔액조회</td><td>선택</td></tr>
                        <tr>
                            <td>신한은행</td>
                            <td>110-345-30****</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-s">이체</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-s">잔액조회</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-default btn-s">V</button>
                            </td>
                        </tr>
                        <tr>
                            <td>우리은행</td>
                            <td>110-345-30****</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-s">이체</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-s">잔액조회</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-default btn-s">V</button>
                            </td>
                        </tr>

                        <tr>
                            <td>국민은행</td>
                            <td>110-345-30****</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-s">이체</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-s">잔액조회</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-default btn-s">V</button>
                            </td>
                        </tr>

                    </table>
                    <a href="#addaccount"><button type="button" class="btn btn-primary btn-lg btn-block">계좌등록</button></a>
                </div>
            </div>
        </div>             
    </div>

    <div class="section">
        <div class="intro">
            <h1>붐페이 결과!</h1>
            <div style="font-size: 100px;">
                <div class="" id="bombPayResult" aria-hidden="true">9,000원</div>
            </div>
        </div>
    </div>
</div>
<script src="vendors/jquery/jquery.min.js"></script>
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="vendors/scrolloverflow.js"></script>
<script type="text/javascript" src="lib/jquery.fullPage.js"></script>
<script type="text/javascript" src="main.js"></script>
<script src="bootstrap-select.js"></script>
</body>
</html>