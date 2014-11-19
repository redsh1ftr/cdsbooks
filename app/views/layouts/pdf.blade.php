<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Invoice</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {


		}

		.wrapper{
			margin-top: -20px;
			position: absolute;
			background-image: url('http://localhost/img/invoice.png');
			width: 100%;
			height: 917px;
			page-break-before: avoid;
			background-repeat: no-repeat;
		}

		.address {
			position: absolute;
			margin-top:140px;
			width:200px;
			height: 40px;
			font-size: 12px;
		}

		.invoice {
			position: absolute;
			float: right;
			margin-left: 540px;
			
			font-size: 10px;
		}

		.jobnum{
			position: absolute;
			margin-top: 170px;
			margin-left: 190px;
			color: #ffffff;
			font-size: 12px;
		}

		.terms{
			position: absolute;
			margin-top: 170px;
			margin-left: 405px;
			color: #ffffff;
			font-size: 12px;
		}

		.duedate{
			position: absolute;
			margin-top: 170px;
			margin-left: 520px;
			width: 70px;
			color: #ffffff;
			font-size: 12px;
		}

		.description{
			position: absolute;
			margin-top: 232px;
			margin-left: 30px;
			color: #ffffff;
			font-size: 12px;
		}

		.amount{
			position: absolute;
			margin-top: 232px;
			margin-left: 600px;
			color: #ffffff;
			font-size: 12px;
		}

		.total{			
			position: absolute;
			margin-top: 560px;
			margin-left: 500px;
			color: #000000;
			font-size: 24px;
		}

		.paymentinstr{
			position: absolute;
			margin-top: 620px;
			margin-left: 80px;
			width:80%;
			color: #000000;
			font-size: 10px;
			text-align: center;

		}

		.invoicedate{
			position: absolute;
			float: right;
			margin-top: 73px;
			margin-left: 530px;
			font-size: 12px;
		}

		.invoicenum{
			position: absolute;
			float: right;
			margin-top: 100px;
			margin-left: 530px;
			font-size: 12px;
		}

		.invoicedatedata{
			position: absolute;
			float: right;
			margin-top: 73px;
			margin-left: 600px;
			font-size: 12px;
		}

		.invoicenumdata{
			position: absolute;
			float: right;
			margin-top: 100px;
			margin-left: 600px;
			font-size: 12px;
		}

		.jobnumdata{
			position: absolute;
			margin-top: 198px;
			margin-left: 190px;
			color: #000000;
			font-size: 12px;
		}

		.duedatedata{
			position: absolute;
			margin-top: 198px;
			margin-left: 520px;
			color: #000000;
			font-size: 12px;
		}


		.termsdata{
			position: absolute;
			margin-top: 198px;
			margin-left: 405px;
			color: #000000;
			font-size: 12px;
		}	

		.filenum{
			position: absolute;
			margin-top: 252px;
			margin-left: 30px;
			color: #000000;
			font-size: 12px;
		}

		.subpdata{
			position: relative;
			color: #000000;
			width: 350px;
			font-size: 12px;
		}

		.jobdata{
			position: relative;
			color: #000000;
			font-size: 12px;
		}

		.totaldata{			
			position: absolute;
			margin-top: 550px;
			margin-left: 600px;
			color: #000000;
			font-size: 12px;
		}

		.createinvoice{
			position: absolute;
			margin-top: 200px;
			margin-left: 700px;
			color: #000000;
			font-size: 12px;
		}

		.lineitems{
			position: absolute;
			margin-top: 240px;
			margin-left: 30px;
			font-size: 12px;
			word-wrap: break-word;

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