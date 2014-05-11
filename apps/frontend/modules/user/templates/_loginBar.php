<?php if($sf_user->isAuthenticated()): ?>
	<div class="is_logged">
		<?php echo link_to('Wyloguj '.$sf_user->getProfile()->getFullName(), 'logout') ?>
	</div>
<?php endif ?>