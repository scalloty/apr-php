<?php
/***************************************************************************/
include('leasing_class.php');
/*************************************************************************/
	if(isset($_POST['amount']) && isset($_POST['period']) && 
	   isset($_POST['ratePerMonth']) && $_POST['amount'] !=0 && 
	   $_POST['period'] != 0 && $_POST['ratePerMonth'] != 0) {
		
		$scheme = new Leasing;
		
		$amount = (float)$_POST['amount'];
		$period = (int)$_POST['period'];
		$ratePerMonth = (float)$_POST['ratePerMonth'];
		
		$result = $scheme->calculate($amount,$period,$ratePerMonth);
		
		$message =  'Total: <b>'.$result['remuneratedValue'].'</b><br />';
		$message .= 'Monthly payment: <b>'.$result['period'].'</b> x <b>'.$result['monthlyPayment'].'</b><br />';
		$message .= 'APR: <b>'.$result['gpr'].'</b>%';
	}
?>

<html>
<head>
<style type="text/css">
body {
	color: #333333;
	font-family: Tahoma, Geneva, sans-serif;
}
table {
	border-collapse:collapse;
}
table,th, td {
	border: 1px solid black;
}
</style>
<title>APR calculator - php</title>
</head>
<body>
	<br /><br /><br /><br /><br /><br />
	<center>
	<form method="POST" action="index.php">
	<table>
		<tbody>
			<tr><td>Amount:</td><td><input type="text" name="amount" size="11"></td></tr>
			<tr><td>Period:</td>
				  <td>
				  <select name="period">
					<option value="0"></option>
					<?php for($i=3; $i<=36;) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?> months</option>
					<?php $i = $i + 3; } ?>
				  </select>
				  </td>
			</tr>
			<tr><td>Monthly interest %:</td><td><input type="text" name="ratePerMonth" size="11"></td></tr>
			<tr><td colspan="2"><input type="submit" value="Calculate"></td></tr>
		</tbody>
	</table>
	</form>
	<?php if(isset($message)) echo $message; ?>
	</center>
</body>
</html>