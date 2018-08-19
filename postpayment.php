<!--
*******************************************
*******************************************
Parameters to change
1. Secure Key of Resellerclub Key (line no 36)



*******************************************
*******************************************
-->
<?php 
	 session_start();
	 session_save_path("./"); //path on your server where you are storing session


	//file which has required functions
	require("functions.php");	
 ?>
<html>
<head><title>Post Payment</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body bgcolor="white"><center>
<font size=4>

<?php
session_start();
		$key = "xxxxxxxxxxxxxxxx"; //replace ur 32 bit secure key , Get your secure key from your Reseller Control panel
	    

		$redirectUrl = $_SESSION['redirecturl'];  // redirectUrl received from foundation
		$transId = $_SESSION['transid'];		 //Pass the same transid which was passsed to your Gateway URL at the beginning of the transaction.
		$sellingCurrencyAmount = $_SESSION['sellingCurrencyAmount'];
		$accountingCurrencyAmount = $_SESSION['accountingCurencyAmount'];


		$status = $_SESSION["status"];	 // Transaction status received from your Payment Gateway
        //This can be either 'Y' or 'N'. A 'Y' signifies that the Transaction went through SUCCESSFULLY and that the amount has been collected.
        //An 'N' on the other hand, signifies that the Transaction FAILED.

		/**HERE YOU HAVE TO VERIFY THAT THE STATUS PASSED FROM YOUR PAYMENT GATEWAY IS VALID.
	    * And it has not been tampered with. The data has not been changed since it can * easily be done with HTTP request. 
		*
		**/
		
		srand((double)microtime()*1000000);
		$rkey = rand();


		$checksum =generateChecksum($transId,$sellingCurrencyAmount,$accountingCurrencyAmount,$status, $rkey,$key);

			echo "You'll now redirect to merchant page! <br>";
            

?>
		<form name="f1" action="<?php echo $redirectUrl;?>">
		<input type="submit" value="Click here to Continue"><BR>
			<input type="hidden" name="transid" value="<?php echo $transId;?>">
		    <input type="hidden" name="status" value="<?php echo $status;?>">
			<input type="hidden" name="rkey" value="<?php echo $rkey;?>">
		    <input type="hidden" name="checksum" value="<?php echo $checksum;?>">
		    <input type="hidden" name="sellingamount" value="<?php echo $sellingCurrencyAmount;?>">
			<input type="hidden" name="accountingamount" value="<?php echo $accountingCurrencyAmount;?>">

			
		</form>
</font>
</center>
</body>
</html>