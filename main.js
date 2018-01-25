var websocket;

function connectServer1(QRCODE){
      console.log("이건 방장말고..");
      //web socket part
      var tmp = {};


      var qrcode_send = "init";
      var peopleNum_send = -1;

      qrcode_send = QRCODE;

      tmp.qrcode_send = qrcode_send;
      tmp.peopleNum_send = peopleNum_send;
      tmp.requestType = "connectServer_Clinet";


      //create a new WebSocket object.
      var wsUri = "ws://192.168.70.31:9000/demo/server.php";  
      websocket = new WebSocket(wsUri); 
      
      websocket.onopen = function(ev) { // connection is open 
          console.log("connected!!");
          websocket.send(JSON.stringify(tmp));
      }

      //#### Message received from server?
      websocket.onmessage = function(ev) {
          var msg = JSON.parse(ev.data); //PHP sends Json data
          console.log("server response! : " + JSON.stringify(msg));
          console.log("roomPeople : " + msg.peopleNum);
          console.log("roomPeople : " + msg.peopleMaxNum);

          if(msg.startGame == "true"){
             $.fn.fullpage.moveTo(5);
            $("#bombPayResult").addClass("mainbomb");
          } else {
            $("#tmp").html("붐페이 타임!("+msg.peopleNum+"/"+msg.peopleMaxNum+")");    
            window.BombPay.notifyPeople(msg.peopleNum);            
          }
                  
      };
      websocket.onerror   = function(ev){ alert("Error Occurred - "+ev.data);}; 
      websocket.onclose   = function(ev){ alert("Connection Closed");}; 


      console.log("connected!2!");
  }

  function connectServer(QRCODE, temp){
      console.log("이건 방장이야..");
      console.log("QR : " + QRCODE);
      console.log("PeopleNum : " + temp);
      //web socket part

      var tmp = {};


      var qrcode_send = "init";
      var peopleNum_send = "";

      qrcode_send = QRCODE;
      peopleNum_send = temp;

      tmp.qrcode_send = qrcode_send;
      tmp.peopleNum_send = peopleNum_send;
      tmp.requestType = "connectServer_BangJang";

      //create a new WebSocket object.
      var wsUri = "ws://192.168.70.31:9000/demo/server.php";  
      websocket = new WebSocket(wsUri); 
      
      websocket.onopen = function(ev) { // connection is open 
          console.log("send from client!!" + JSON.stringify(tmp));
          websocket.send(JSON.stringify(tmp));
      }

      //#### Message received from server?
      websocket.onmessage = function(ev) {
          var msg = JSON.parse(ev.data); //PHP sends Json data
          console.log("server response! : " + JSON.stringify(msg));
          console.log("peopleNum : " + msg.peopleNum);
          console.log("peopleMaxNum : " + msg.peopleMaxNum);

          if(msg.startGame == "true"){
             $.fn.fullpage.moveTo(5);
              $("#bombPayResult").addClass("mainbomb");
          } else {
            $("#tmp").html("붐페이 타임!("+msg.peopleNum+"/"+msg.peopleMaxNum+")");    
            window.BombPay.notifyPeople(msg.peopleNum);            
          }   
      };
      websocket.onerror   = function(ev){ alert("Error Occurred - "+ev.data);}; 
      websocket.onclose   = function(ev){ alert("Connection Closed");}; 
  }


  function startGame(){
      var tmp = {};
      tmp.startGame = "start";
      tmp.requestType = "startGame";
      window.BombPay.finishGame();
      websocket.send(JSON.stringify(tmp));
  }



$(document).ready(function() {
  
  $('#fullpage').fullpage({
    sectionsColor: ['#FFFFFF', '#FFFFFF', '#FFFFFF', '#FFFFFF', '#FFFFFF', '#FFFFFF','#FFFFFF'],
    controlArrows: false,
    menu: '#menu',
    css3: true
  });
  $.fn.fullpage.silentMoveTo(2, 1);
  $.fn.fullpage.setAllowScrolling(false);
  $.fn.fullpage.setFitToSection(true);

  $("#makeRoom").click(function(){
      $.fn.fullpage.moveTo(2, 2);
  });

  var roomTypeResult = "initial";

  $("#confirmRoom").click(function(){
    var roomName = $("input[name='roomName']").val();
    var roomPrice = $("input[name='roomPrice']").val();
    var roomPeople = $("input[name='roomPeople']").val();
    var roomType = roomTypeResult;
    var params = {};

    params.roomName = roomName;
    params.roomPrice = roomPrice;
    params.roomPeople = roomPeople;
    params.roomType = roomType;
    params.requestType = "confirmRoom";

    if(roomType == "Other"){
      var temp = [];
      $("input[name='roomRatio']").each(function() {
          temp.push($(this).val());
      });
      params.roomRatio = temp;
    }

    console.log(JSON.stringify(params));

    $.fn.fullpage.moveTo(3);

    window.BombPay.confirmRoom(JSON.stringify(params));
    websocket.send(JSON.stringify(params));
  });

  $("#testbutton").click(function(){
     $.fn.fullpage.moveTo(5);
     $("#bombPayResult").addClass("mainbomb");
  });




  $("button[name='roomType']").click(function(){
    if($( this ).is( ".btn-danger" ) ){
        roomTypeResult = "Other";
        var roomPeople = $("input[name='roomPeople']").val();
        var i = 0;
        for(i = 0; i < roomPeople; i++){
          var html = '';
          html += '<div class="form-group">';
                   html += '     <label class="sr-only" for="exampleInputAmount'+i+'">비율 '+i+'</label>';
                        html += '<div class="input-group">';
                          html += '<div class="input-group-addon">넘버 '+i+'</div>';
                          html += '<input type="text" name="roomRatio" class="form-control" id="exampleInputAmount'+i+'" placeholder="비율 '+i+'">';
                          html += '<div class="input-group-addon">%</div>';
                        html += '</div>';
                      html += '</div>';
          $("#roomTypeOther").append(html);
        }
        $("#confirmRoom").html("만들기(비율)");
    } else if($( this ).is( ".btn-info" )){
      roomTypeResult = "NBBang";
      $("#confirmRoom").html("만들기(엔빵)");
      $("#roomTypeOther").empty();
    } else {
      $("#confirmRoom").html("만들기(몰빵)");
      roomTypeResult = "MolBBang";
      $("#roomTypeOther").empty();
    }
  });

  $("#joinRoom").click(function(){
    $.fn.fullpage.moveTo(3);
    window.BombPay.joinRoom();
  });
});