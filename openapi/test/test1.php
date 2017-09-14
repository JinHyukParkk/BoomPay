<?php
    require_once("database.php");
    $database = new Database("localhost");

    if (isset($_POST["name"],$_POST["ood"],$_POST["inquiry"],$_POST["transfer"])){
    	$name = $_POST["name"];
    	$ood = $_POST["ood"];
    	$inquiry = $_POST["inquiry"];
    	$transfer = $_POST["transfer"];
        $database->insert_user_info($name,$ood,$inquiry,$transfer);
    }
    if (isset($_POST["user_name"],$_POST["fintech_use_num"],$_POST["bank_code_std"],$_POST["account_num_masked"])){
        $user_name = $_POST["user_name"];
        $fintech_use_num = $_POST["fintech_use_num"];
        $bank_code_std = $_POST["bank_code_std"];
        $account_num_masked = $_POST["account_num_masked"];
        $database->insert_user_account($user_name,$fintech_use_num,$bank_code_std,$account_num_masked);
    }
?>