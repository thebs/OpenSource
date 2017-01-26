<?php

if(!isset($_SESSION['register'])){
	exit();
}

$fullname = $_SESSION['fullname'];

?>


<div id="content-user" style="text-align: right;margin: 10px 20px 10px 0;">
	<form>
		Welcome <?php echo $_SESSION['register']; ?>
		<input id="logout" type='submit' name='logout' value='Log Out'>
	</form>
</div>


<div id="screen"></div>

<div id="car-on-user"></div>


<script type="text/javascript">
	var n = 1;

	function sendMe(x, y) {

		//document.getElementById('test').innerHTML = n++;

		document.getElementById('bnRace').disabled = true;

		var xhttp;

		if (window.XMLHttpRequest) {
			// code for modern browsers
		    xhttp = new XMLHttpRequest();
	    } else {
	    	// code for old IE browsers
	    	xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		xhttp.open("GET", "take-score.php?u="+x+"&p="+y, true);
		xhttp.send();
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
				document.getElementById('car-on-user').innerHTML = data;
			}
		}

		xhttp.open("GET", "car.php", true);
		xhttp.send();

		setTimeout("getCar()", 1000);
	}

	/*function getScreen() {
		var xhttp;

		var w = screen.availWidth;
		var h = screen.availHeight;

		if (window.XMLHttpRequest) {
			// code for modern browsers
		    xhttp = new XMLHttpRequest();
	    } else {
	    	// code for old IE browsers
	    	xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		xhttp.open("GET", "screen.php?w="w, true);
		xhttp.send();

		setTimeout("getScreen()", 1000);
	}*/

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
				document.getElementById('screen').innerHTML = data;
			}
		}

		xhttp.open("GET", "user-get-data.php", true);
		xhttp.send();

		setTimeout("getData()", 1000);
	}

	getData();
	getCar();
	//getScreen();
	

</script>