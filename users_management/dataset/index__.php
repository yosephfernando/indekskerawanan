<!DOCTYPE html>
<html>

<head>
	<title>IKPM</title>
</head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

<body>
	<div class="container col-md-6 mt-4">
		<h1 style="text-align:center">SKORING GATRA</h1>
		<div class="container col-md-6 mt-4">
			<div class="card">
				<div class="card-header bg-dark text-white ">
					<left>
						<h3>ANALISA SENTIMEN MEDIA </h3>
					</left>
					<form action="sentiment_media.php" class="btn btn-sm btn-primary float-left">
						Tanggal Proses : <input type="date" value="<?php echo date("Y-m-d"); ?>" name="tanggal">
						<input type="submit">
					</form>
				</div>
			</div>
			<script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
			<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		</div>
</body>

</html>