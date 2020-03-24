<footer class="bg-light pt-5 pb-5 text-muted">
	<div class="container">
		<div class="row">
			<div class="col">
				<ul class="nav mb-2 footer-nav">
					<li class="nav-item"><a class="nav-link pl-0" href="<?php echo osc_base_url(); ?>"><?php _e('Home', 'bootstrap'); ?></a></li>
		        <?php osc_reset_static_pages();
		        while( osc_has_static_pages() ) { ?>
		        	<li class="nav-item"><a class="nav-link" href="<?php echo osc_static_page_url(); ?>"><?php echo osc_static_page_title(); ?></a></li>
		        <?php } ?>
		        	<li class="nav-item"><a class="nav-link" href="<?php echo osc_contact_url(); ?>"><?php _e('Contact', 'bootstrap'); ?></a></li>
		        </ul>
		        <?php if(osc_get_preference('footer_link', 'bootstrap') !== '0') { ?>
		        	<p class="m-0">&copy; <?php echo date('Y'); ?> <?php echo osc_page_title(); ?>.</p>
		        	<p class="m-0">
		        		<?php echo sprintf(__('Designed and developed by <a href="%s">DrizzleThemes</a>.'), 'https://drizzlethemes.com/'); ?>&nbsp;
		        		<?php echo sprintf(__('Powered by <a href="%s">Osclass</a>'), 'https://osclasscommunity.com/'); ?>
		        	</p>
		        <?php } ?>
		    </div>
		    <div class="col-auto ml-auto">
		    	<a class="back-to-top btn btn-sm btn-light" href="#">Back to Top &uarr;</a>
		    </div>
		</div>
	</div>
</footer>

<script src="<?php echo osc_current_web_theme_url('lib/popper.js/popper.min.js'); ?>"></script>
<script src="<?php echo osc_current_web_theme_url('lib/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo osc_current_web_theme_url('lib/fineuploader/jquery.fineuploader.min.js'); ?>"></script>
<script src="<?php echo osc_current_web_theme_url('lib/jquery-validation/jquery.validate.min.js'); ?>"></script>
<?php osc_run_hook('footer'); ?>
<script type="text/javascript">
$(document).ready(function() {
	$('input[type=text]').addClass('form-control');
    $('input[type=password]').addClass('form-control');
    $('select').addClass('form-control');
    $('.home-search select[name=sCategory]').addClass('form-control-lg');
    $('textarea').addClass('form-control');
    $('input[type=checkbox]').addClass('form-check-input');
    $('#item-post #plugin-hook').addClass('mt-4');
    $('.paginate ul').addClass('pagination');
    $('.paginate ul li').addClass('page-item');
    $('.paginate ul li .searchPaginationSelected').parent().addClass('active');
    $('.paginate ul li a').addClass('page-link');
    $('.paginate ul li span').addClass('page-link');

    //Scroll to Top
    $(window).scroll(function () {
		if ($(this).scrollTop() > 50) {
			$('.back-to-top').fadeIn();
		} else {
			$('.back-to-top').fadeOut();
		}
	});
	// scroll body to 0px on click
	$('.back-to-top').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 400);
		return false;
	});
});
</script>
</body>
</html>