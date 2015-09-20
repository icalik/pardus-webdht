<?php

	define(LANGUAGE, "turkish");

//Oda Sicakligi
	$komut = shell_exec('dht11');
	echo $tempgelen;
	$tempgelen = substr($komut, 7,4);

	if ($tempgelen == 0) {
		#dosya oku ve tempe yaz
		$file = fopen("tempfile", "r") or die("Unable to open file!");
		$temp = fread($file,filesize("tempfile"));
		echo fread($file,filesize("tempfile"));
		fclose($file);

	}
	elseif ($tempgelen != 0) {
		#dosyaya yaz tempe yaz
		$file = fopen("tempfile", "w") or die("Unable to open file!");
		fwrite($file, $tempgelen);
		fclose($file);
		$temp = $tempgelen;
	}

//Oda Nem

	$nemgelen = substr($komut, 0,2);
	if ($nemgelen == 0) {
		#dosya oku ve tempe yaz
		$file = fopen("tempfile1", "r") or die("Unable to open file!");
		$nem = fread($file,filesize("tempfile1"));
		echo fread($file,filesize("tempfile1"));
		fclose($file);

	}
	elseif ($nemgelen != 0) {
		#dosyaya yaz tempe yaz
		$file = fopen("tempfile1", "w") or die("Unable to open file!");
		fwrite($file, $nemgelen);
		fclose($file);
		$nem = $nemgelen;
	}

	include 'localization/'.LANGUAGE.'.lang.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Pardus ARM Topluluk - Web Bilgi Ekranı</title>
		<link rel="stylesheet" href="stylesheets/main.css">
		<script src="javascript/raphael.2.1.0.min.js"></script>
	    <script src="javascript/justgage.1.0.1.min.js"></script>

	    <script>
			window.onload = doLoad;

			function doLoad()
			{
			setTimeout( "refresh()", 30*1000 ); //Timeout Burada!!
			}

			function refresh()
			{
			window.location.reload( false );
			}
	    </script>
	</head>

	<body>
		<div id="container">
				<img id="logo" src="images/logo.png">
				<div id="title">Web Bilgi Ekranı</div>
				
				<div id="tempgauge"></div>
				<div id="humidity"></div>
		</div>


		<script>
		    var t = new JustGage({
		    id: "tempgauge",
		    value: <?php echo $temp; ?>,
		    min: -10,
		    max: 50,
		    title: "<?php echo TXT_TEMPERATURE; ?>",
		    label: "°C"
		    });
		</script>

		<script>
		    var t = new JustGage({
		    id: "humidity",
		    value: <?php echo $nem; ?>,
		    min: 30,
		    max: 45,
		    title: "<?php echo TXT_HUMIDITY; ?>",
		    label: "%"
		    });
		</script>

		
	</body>
</html>
