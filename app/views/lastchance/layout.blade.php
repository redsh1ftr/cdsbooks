<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Invoice</title>
	<style>
	
		body {


		}

		.wrapper{
			margin-top: -20px;
			position: absolute;
			width: 100%;
			max-width: 700px;
			height: 917px;
			page-break-before: avoid;
			background-repeat: no-repeat;
		}


		.title{
			position: absolute;
			margin-left:35%;
			vertical-align: center;
			margin-right: 20%;
			font-size: 18px;
			color:#000000;

		}

		.fax{
			position: absolute;
			margin-top: 800px;
			color: #000000;
			font-size: 13px;
		}

		.legalese{
			position: absolute;
			margin-top: 15px;
			margin-left: 10%;
			font-size: 9px;
			width: 80%;

		}

		.infobox{
			position: absolute;
			margin-top: 130px;
			margin-left: 10px;
			max-width: 630px;
			font-size: 12px;

		}

		.format{
			position: absolute;
			margin-top: 400px;
			max-width: 650px;
		}


		.dowant{
			position: absolute;
			margin-top: 530px;
			max-width: 650px;

		}

	

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			font-size: 32px;
			margin: 16px 0 0 0;
		}
	</style>
</head>




<body>



<div class="wrapper">

@yield('main')

</div>

</body>

</html>