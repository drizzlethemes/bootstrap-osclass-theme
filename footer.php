<footer>
	Footer
</footer>

<script src="<?php echo osc_current_web_theme_url('lib/popper.js/popper.min.js'); ?>"></script>
<script src="<?php echo osc_current_web_theme_url('lib/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo osc_current_web_theme_url('lib/fineuploader/jquery.fineuploader.min.js'); ?>"></script>
<script src="<?php echo osc_current_web_theme_url('lib/jquery-validation/jquery.validate.min.js'); ?>"></script>
<?php osc_run_hook('footer'); ?>
<script type="text/javascript">
$(function () {
	'use strict'

	$('[data-toggle="offcanvas"]').on('click', function () {
		$('.offcanvas-collapse').toggleClass('open')
	})
})
</script>
</body>
</html>