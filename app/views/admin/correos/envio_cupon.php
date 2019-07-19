<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "https://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
</head>
<body style="background:#e9e9e9">
<?php 
	if (!isset($retorno)) {
      	$retorno ="";
    }
 ?> 

	<table border="0" cellspacing="0" cellpadding="0" style="width:400px;margin:30px auto; background-color:#379947; padding:0px; max-width:580px; width:100%">
	  
	   <tr>
	  	<td scope="row" style="text-align:center">
	   		<img src="https://www.ganacon7up.com/img/correo/cupon/header.jpg" style="width:400px;" alt="imagencupon">
	   	</td>
	  </tr>
	  <tr>
	  	<td scope="row" style="text-align:center;background-color:#ffffff">
	   		<img src="https://www.ganacon7up.com/barcode/<?php echo $url_imagen ?>" style="width: 400px;" alt="imagencupon">
	   		<p style="text-align:center; font-size:20px;color:#000000" > <b><?php echo $codigo ?></b></p>
	   	</td>
	  </tr>
		<tr>
	  	<td scope="row" style="text-align:center">
	   		<img src="https://www.ganacon7up.com/img/correo/cupon/footer.jpg" style="width:400px;" alt="imagencupon">
	   	</td>
	  </tr>
	  
	</table>
	

</body>
</html>




