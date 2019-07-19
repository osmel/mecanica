<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<style type="text/css">
		body{
			background: #888888
		}
		#sidebar{
			position: absolute;
			width: 200px;
			height: 590px;
			background: #222;
			color: #fff;
			margin-left: 600px;
			margin-top: -600px;
			border: 5px solid #fff;
		}
		ul{
			padding: 0;
			text-align: justify;		
		}

		 li{
			cursor: pointer;
			border-top: 1px solid #fff;
			background: #c3c3c3; 
			list-style: none;
			color: #111
		}
		li:hover{
			background: #fefefe;
		}
	</style>
	<script type="text/javascript">
	function datos_marker(lat, lng, marker) {
     	var mi_marker = new google.maps.LatLng(lat, lng);
     	map.panTo(mi_marker);
     	google.maps.event.trigger(marker, 'click');
    }
	</script>
	<?php echo $map['js']?>
	<title>La librería googlemaps de codeigniter por Biostall.com</title>
</head>
<body>
<?php echo $map['html']?>
<div id="sidebar">
	<ul>
		<?php 	foreach($datos as $marker_sidebar)	{ ?>
			
			<li onclick="datos_marker(<?php echo $marker_sidebar->lat; ?>,<?php echo $marker_sidebar->lng; ?>,marker_<?php echo $marker_sidebar->id; ?>)">
				<?php echo $marker_sidebar->id;?>&nbsp;&nbsp;<?php echo substr($marker_sidebar->domicilio,0,14)?></li>

				

		<?php }	?>
	</ul>
</div>
</body>
</html>