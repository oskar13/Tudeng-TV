<!DOCTYPE html>
<html>
	<head>


		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<!--<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />-->
		
		<link href="http://fonts.googleapis.com/css?family=Economica:400,700,400italic,700italic" rel="stylesheet" type="text/css">

		<?php wp_head(); ?>


	</head>
	<body>
		<div id="wrapper">
			<div id="container">
			<!--Header - this can be included everywhere!-->
			<header>
				<a href="index.php"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" /></a>
				<span>
					<a href="#">EST</a>
					<a href="#">ENG</a>
				</span>
			</header>
			<!--Navigation bar (animated with CSS3)-->
			<!--
			<nav>
				<a href="index.php">Avaleht</a>
				<a href="uudised.php">Uudised</a>
				<a href="fookus.php">Fookus</a>
				<a href="arhiiv.php">Arhiiv</a>
				<a href="meeskond.php">Meeskond</a>
				<a href="toetajad.php">Toetajad</a>
				<a href="galerii.php">Galerii</a>
				<a href="kontakt.php">Kontakt</a>
			</nav>
			-->
		<nav>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
