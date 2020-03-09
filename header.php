<!DOCTYPE html>
<html lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="title" content="<?php echo osc_esc_html(meta_title()); ?>" />
	<?php if( meta_description() != '' ) { ?><meta name="description" content="<?php echo osc_esc_html(meta_description()); ?>" /><?php } ?>
	<?php if( osc_get_canonical() != '' ) { ?><link rel="canonical" href="<?php echo osc_get_canonical(); ?>"/><?php } ?>
	<title><?php echo meta_title(); ?></title>
	<link rel="shortcut icon" href="<?php echo osc_current_web_theme_url('favicon.ico'); ?>">
	<link href="<?php echo osc_current_web_theme_url('lib/fontawesome/css/all.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo osc_current_web_theme_url('lib/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo osc_current_web_theme_url('lib/fineuploader/fineuploader.css'); ?>" rel="stylesheet">
	<link href="<?php echo osc_current_web_theme_url('assets/css/style.css'); ?>" rel="stylesheet">
	<!-- jQuery always Head -->
    <script src="<?php echo osc_current_web_theme_url('lib/jquery/jquery-3.2.1.min.js'); ?>"></script>
    <!-- Header Hook -->
    <?php osc_run_hook('header'); ?>
</head>
<body <?php drizzle_bodyClass(); ?>>
<header class="bg-dark">
	<div class="container">
		<nav class="navbar pl-0 pr-0 navbar-expand-lg navbar-dark">
			<a class="navbar-brand" href="<?php echo osc_base_url(); ?>">
				<?php echo drizzle_themeLogo(); ?>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenus">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarMenus">
				<ul class="navbar-nav ml-auto">
					<?php if( osc_users_enabled() ) { ?>
	        		<?php if( osc_is_web_user_logged_in() ) { ?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
							<?php echo sprintf(__('Hi %s', 'bootstrap'), osc_logged_user_name()); ?>
						</a>
						<div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo osc_user_dashboard_url(); ?>"><?php _e('Listings', 'bootstrap'); ?></a>
                            <a class="dropdown-item" href="<?php echo osc_user_profile_url(); ?>"><?php _e('Settings', 'bootstrap'); ?></a>
                        </div>
					</li>
	        		<li class="nav-item">
	        			<a class="nav-link" href="<?php echo osc_user_logout_url(); ?>">Logout</a>
					</li>
	        		<?php } else { ?>
					<li class="nav-item">
						<a class="nav-link" role="button" href="<?php echo osc_user_login_url(); ?>">Login</a>
					</li>
					<?php if(osc_user_registration_enabled()) { ?>
					<li class="nav-item">
						<a class="nav-link" role="button" href="<?php echo osc_register_account_url() ; ?>">Register</a>
					</li>
					<?php } ?>
	        		<?php } ?>
	        		<?php } ?>
					<li class="nav-item">
						<a class="nav-link btn btn-primary" role="button" href="<?php echo osc_item_post_url(); ?>">Publish an Ad</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</header>

<?php osc_show_flash_message(); ?>