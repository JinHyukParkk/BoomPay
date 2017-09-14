<?php
Class Database{
 private $connection;

 public function __construct($host){
  $this->connection = new PDO("mysql:host=$host;dbname=FINICNIC", "root", "system");
  $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $this->connection->exec("USE FINICNIC");
 }
 public function insert_user_info($user_name, $inquiry_token, $withdraw_token, $deposit_token){
    $this->connection->exec("INSERT INTO user_info (user_name, inquiry_token, withdraw_token, deposit_token) VALUES(\"$user_name\", \"$inquiry_token\", \"$withdraw_token\", \"$deposit_token\")");
 }
 public function insert_user_account($user_name, $account_fin_number, $bank_code, $account_number){
    $this->connection->exec("INSERT INTO user_account VALUES(\"$user_name\", \"$account_fin_number\", \"$bank_code\", \"$account_number\")");
 }
 public function insert_bank_info($bank_code, $bank_name){
    $this->connection->exec("INSERT INTO bank_info VALUES(\"$bank_code\", \"$bank_name\")");
 }
 public function get_bank_info($user_name){
     $statement = $this->connection->query("SELECT bank_name,account_number FROM (user_account join bank_info on user_account.bank_code == bank_info.bank_code) WHERE $user_name = \"$user_name\"");
     $result = $statement -> fetchALL();
     $count = count($result);
     if($count > 0){
       for($i = 1; $i <=$count; $i++){
         print "<div class = \"account\" name=\"accounts[]\" value=\"'.$i.'\">";
         print "</div>";

       }
     }
 }
 public function get_token(){
    $statement = $this->connection->query("SELECT inquiry_token FROM user_info");
    $result = $statement -> fetch(PDO::FETCH_ASSOC);
    print '<input ';
    print 'type="text" ';
    print 'id="access_token" ';
    print 'name="access_token" ';
    print 'value='.$result["inquiry_token"];
    print '/>';
 }
}
?>