<!--
*******************************************
*******************************************
Parameters to change
1. Instamojo Private API Key     (line no 65)
2. Instamojo Private Auth Token  (line no 65)
3. Instamojo Test/Production URL (line no 65)




*******************************************
*******************************************
-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!--<meta http-equiv="Refresh" content="5;url=https://www.vrhostingindia.com">-->
	
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
	<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
	

    <title>Payment Status, Welcome to VRHostingindia</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>

  <body>
  <center>
    <div class="container">

      <div class="page-header">
        <h1><a href="index.php">VRHostingindia</a></h1>
        <p class="lead">Welcome to VRHostingindia Family.</p>
      </div>

      <h3 style="color:#6da552">Your Payment status is given below.</h3>
  


  <?php
  session_start();

include 'src/instamojo.php';

                               //Private API Key,              Private Auth Token,      URL-Production URL https://www.instamojo.com/api/1.1/
$api = new Instamojo\Instamojo('xxxxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxx','https://test.instamojo.com/api/1.1/');

$payid = $_GET["payment_request_id"];
//$acm = $response['payments'][0]["buyer_name"];

try {
	//echo $acm = $response['payments'][0]["buyer_name"];
	echo $_SESSION['accountingCurrencyAmount'];
	echo $_SESSION['accountingCurrencyAmount'];
    $response = $api->paymentRequestStatus($payid);
	
	if ($response['payments'][0]['status'] == "Credit") {
    echo "Y";
	$status="Y";
} elseif ($response['payments'][0]['status'] != "Credit") {
    echo "N";
	$status="N";
} else {
    echo "Error";
	$status="N";
}
	
    echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>" ;
    echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>" ;
	echo "<h4>Payment Status: " . $response['payments'][0]['status'] . "</h4>" ;
	echo "<h4>Price: " . $response['payments'][0]['amount'] . "</h4>" ;
	
	
	
	echo "Payment Status for User id<br>";
	
             
	$_SESSION['status']= $status;	 // Transaction status received from your Payment Gateway
	


  echo "<pre>";
   print_r($response['purpose']);
echo "</pre>";


    ?>
	
<form method="session" action="postpayment.php"> 

	<input type="submit"/> 
	</form>

    <?php
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}



  ?>


      
    </div> <!-- /container -->

</center>
  </body>
</html>
