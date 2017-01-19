<?php

// will allow only admin
if($_SESSION['register'] != 'admin'){
	exit();	
}

?>

<div id="content-admin" style="text-align: right;margin: 10px 20px 0 0; font-size: 16px; font-weight: bold;">
	<form action="admin-get-data.php">
		Welcome <?php echo $_SESSION['register']; ?>
		<button id="start" type='submit' name='start'>Start</button>
		<button id="stop" type='submit' name='stop'>Stop</button>
		<button id="edit" type='submit' name='edit'>Edit</button>
		<button id="logout" type='submit' name='logout'>Log Out</button>
	</form>
</div>

<div id="get-data"></div>
<div id="carScreen"></div>

<script type="text/javascript">

	function getData() {
		var xhttp;

		if (window.XMLHttpRequest) {
			// code for modern browsers
		    xhttp = new XMLHttpRequest();
	    } else {
	    	// code for old IE browsers
	    	xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		xhttp.onreadystatechange = function (){
			if (this.readyState == 4 && this.status == 200){
				var data = xhttp.responseText;
				document.getElementById('get-data').innerHTML = data;
			}
		}

		xhttp.open("GET", "admin-get-data.php", true);
		xhttp.send();

		setTimeout("getData()", 1000);
	}

	function getCar() {
		var xhttp;

		if (window.XMLHttpRequest) {
			// code for modern browsers
		    xhttp = new XMLHttpRequest();
	    } else {
	    	// code for old IE browsers
	    	xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		xhttp.onreadystatechange = function (){
			if (this.readyState == 4 && this.status == 200){
				var data = xhttp.responseText;
				document.getElementById('carScreen').innerHTML = data;
			}
		}

		xhttp.open("GET", "car.php", true);
		xhttp.send();

		setTimeout("getCar()", 1000);
	}

	getData();
	getCar();

</script>