<?php
osc_add_hook('header', 'drizzle_followConstruct');
drizzle_addBodyClass('home');

osc_current_web_theme_path('header.php'); ?>

<main>
	<section class="jumbotron">
		<div class="container">
			<form action="<?php echo osc_base_url(true); ?>" method="get" class="home-search nocsrf">
				<input type="hidden" name="page" value="search" />
				<div class="form-row">
					<div class="col-7">
						<input type="text" name="sPattern" class="form-control form-control-lg" placeholder="<?php echo osc_esc_html(__(osc_get_preference('keyword_placeholder', 'bootstrap'), 'bootstrap')); ?>">
					</div>
					<div class="col">
						<?php osc_categories_select('sCategory', null, __('Select a category', 'bootstrap')) ; ?>
					</div>
					<div class="col-auto">
						<button type="submit" class="btn btn-lg btn-primary"><?php _e("Search", 'bootstrap'); ?></button>
					</div>
				</div>
			</form>
		</div>
	</section>

	<section class="home-categories">
		<div class="container">
			<?php echo drizzle_categoryList(); ?>
		</div>
	</section>
</main>

<?php osc_current_web_theme_path('footer.php'); ?>