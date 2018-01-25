<?php
Class Database{
 private $connection;

 public function __construct($host){
  $this->connection = new PDO("mysql:host=$host;dbname=FINICNIC", "root", "0000");
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
     $statement = $this->connection->query("SELECT bank_name,account_number FROM (user_account join bank_info on user_account.bank_code == bank_info.bank_code) WHERE user_name = \"$user_name\"");
     $result = $statement -> fetchALL();
     $rows = $db->query($result);
     foreach ($rows as $row) {
         ?>
         <li>
             <?php
             for ($i = 0;$i < count($row); $i++){
                 print "<div class = \"account\" name = \"$row[$i][\"bank_name\"]\" value=\"$row[$i][\"account_number\"]\"</div>";
             }
             ?>
         </li>
         <?php
     }
 }
 public function get_account_number($user_name,$bank_code){
     $statement = $this->connection->query("SELECT account_number FROM (user_account join bank_info on user_account.bank_code == bank_info.bank_code) WHERE user_name = \"$user_name\" and bank_info =\"$bank_code\"");
     $result = $statement -> fetchAll();
     return "$result[\"account_number\"]";
 }

}
?>
