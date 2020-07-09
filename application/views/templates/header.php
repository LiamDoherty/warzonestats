<html>

<head>
	<title><?php echo $title?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/custom.css">
	<script src="https://kit.fontawesome.com/68cc3be898.js" crossorigin="anonymous"></script>
	<script src="<?php echo base_url(); ?>js/jquery.js"></script>
	<script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
	<link rel="icon" href="<?=base_url()?>/Src/fav.png" type="image/png">
	<link rel="canonical" href="https://warzonestats.net/">
	<meta name="description" content="<?php echo $meta_description; ?>">
</head>

<body>
	<div class="bgImage">
		<img alt="fav icon" src=<?php echo base_url('Src/bg.jpg');?>>
	</div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<div class="navbar-brand custom-nav">
			<div class="statsText">
				<a href="home">Warzone <img alt="warzone overlay stats logo" class="navbar-logo"
						src=<?php echo base_url('Src/logo.png'); ?>>
				</a>
				<div class="hexCompany">
					<a href="https://www.hexeum.net/">
						<img class="navbar-logo-hex" src=<?php echo base_url("Src/HexeumLogo.png")?>> A Hexeum Company
					</a>
				</div>
			</div>
			<a href="home" class="nav-stats"> Stats</a>
		</div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
			aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav mr-auto">
				<li <?php if($page == "home") {echo "class=\"home active\"";} else {echo "nav-item";} ?>>
					<a class="nav-link" href="home">Home <span class="sr-only">(current)</span></a>
				</li>
				<li <?php if($page == "about") {echo "class=\"home active\"";} else {echo "nav-item";} ?>>
					<a class="nav-link" href="about">About</a>
				</li>
			</ul>
			<div class="nav-additional-info">
				<p>
					Currently in
				</p>
				<p class="beta">BETA</p>
			</div>
		</div>
	</nav>
	<div class="container page-header">
