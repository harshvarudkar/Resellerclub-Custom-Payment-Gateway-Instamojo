<!--
*******************************************
*******************************************
Parameters to change
1. Instamojo Private API Key     (line no 21)
2. Instamojo Private Auth Token  (line no 21)
3. Instamojo Test/Production URL (line no 21)
4. "redirect_url"                (line no 36)



*******************************************
*******************************************
-->
<?php 

session_start();

include 'src/instamojo.php';
                              //Private API Key,              Private Auth Token,      URL-Production URL https://www.instamojo.com/api/1.1/
$api = new Instamojo\Instamojo('xxxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxx','https://test.instamojo.com/api/1.1/');


try {
	//echo "accountingcurrencyamount : ".$_SESSION['accountingCurencyAmount']."<br>";
	$acm=$_SESSION["accountingCurencyAmount"];
    $response = $api->paymentRequestCreate(array(
        "purpose" => $_SESSION["userId"],
        "amount" => $_SESSION['sellingCurrencyAmount'],
        "buyer_name" => $_SESSION['userType'],
        "phone" => $phone,
        "send_email" => false, 
        "send_sms" => false,   
        "email" => $email,
        'allow_repeated_payments' => false,
        "redirect_url" => "http://www.yourdomain.com/thankyou.php",// change URL according to your domain
        
        ));
		
    //print_r($response);

    $pay_ulr = $response['longurl'];
    
    //Redirect($response['longurl'],302); //Go to Payment page

    header("Location: $pay_ulr");
	
			
	
    exit();

}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
	
}     

  ?>
