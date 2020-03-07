<!DOCTYPE html>
<html lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo meta_title(); ?></title>
	<link href="<?php echo osc_current_web_theme_url('lib/fontawesome/css/all.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo osc_current_web_theme_url('lib/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo osc_current_web_theme_url('lib/fineuploader/fineuploader.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://getbootstrap.com/docs/4.4/examples/offcanvas/offcanvas.css">
    <link href="<?php echo osc_current_web_theme_url('assets/css/style.css'); ?>" rel="stylesheet">
</head>
<body <?php drizzle_bodyClass(); ?>>
<header>
	<nav class="navbar navbar-expand-lg">
		<a class="navbar-brand mr-auto mr-lg-0" href="#">Offcanvas navbar</a>
		<button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Notifications</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Profile</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Switch account</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
					<div class="dropdown-menu" aria-labelledby="dropdown01">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>
</header>