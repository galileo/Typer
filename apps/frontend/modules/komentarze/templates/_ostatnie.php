<?php if($sf_user->isAuthenticated()): ?>

	<div class="comments">
		<?php foreach($komentarze as $komentarz):?>
			<p>
				<span class="date"><?php echo $komentarz -> getCreatedAt('d.m h:i:s') ?></span>
				<span class="author"><?php echo $komentarz -> getsfGuardUser() -> getProfile() -> getFullname() ?></span>
				<span class="content" colspan="3"><?php echo nl2br( $komentarz -> getTresc()) ?></span>
			</p>
		<?php endforeach; ?>
		
		<?php include_component('komentarze','form'); ?>
	</div>

<?php endif; ?>
