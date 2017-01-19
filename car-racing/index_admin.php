<?php

// will allow only admin
if($_SESSION['register'] != 'admin'){
	exit();	
}

?>

<div id="content-admin" style="text-align: right;margin: 10px 20px 10px 0;">
	<form>
		Welcome <?php echo $_SESSION['register']; ?>
		<button id="logout" type='submit' name='logout'>Log Out</button>
	</form>
</div>

<div id="scoreTable"></div>
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
				document.getElementById('scoreTable').innerHTML = data;
			}
		}

		xhttp.open("GET", "admin-get-data.php", true);
		xhttp.send();

		setTimeout("getCar()", 1000);
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

		setTimeout("getData()", 1000);
	}

	getData();
	getCar();

</script>