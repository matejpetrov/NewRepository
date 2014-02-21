
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

<title>Dashboard Template for Bootstrap</title>

<!-- Bootstrap core CSS -->
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css"
	type="text/css" rel="stylesheet" media="screen" />

<!-- Custom styles for this template -->
<link href="<?php echo base_url();?>assets/css/dashboard.css"
	rel="stylesheet">

<!-- Just for debugging purposes. Don't actually copy this line! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Отворете ги Прозорците</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="#">Активни Корисници</a></li>
					<li><a href="<?php echo base_url();?>controller_klienti_main/view_lista_klienti">Сите Корисници</a></li>
					<li><a href="#">Мои Корисници</a></li>
				</ul>
				<form class="navbar-form navbar-right">
					<input type="text" class="form-control" placeholder="Search...">
				</form>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">
					<li class="active"><a href="<?php echo base_url();?>controller_klienti_main/view_dodadi_klient">Додади нов клиент</a></li>
					<li><a href="#">Распоред</a></li>
					<li><a href="<?php echo base_url();?>controller_klienti_nadvoresni/view_lista_terapevti">Терапевти</a></li>
					<li><a href="#">Наставници</a></li>
					<li><a href="#">Одговорни од Фирми</a></li>
					<li><a href="#">Мој Профил</a></li>
				</ul>

			</div>

			<div class="col-md-10 col-md-offset-2 main">
	
       <?php echo $var;?>
          
        </div>
				</div>
			</div>
		</div>
	

	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="../../assets/js/docs.min.js"></script>
</body>
</html>
