<div class="menu">
<ul>
	<li>
		<?php echo link_to('Home', '@homepage') ?>
	</li>
	<li class="important">
	<?php echo link_to('Zasady !','user/zasady') ?>
	</li>
	<?php if($sf_user->isAuthenticated()): ?>
	<li>
		<?php echo link_to('Wyloguj '.$sf_user->getProfile()->getFullName(), 'logout') ?>
	</li>
	<li>
		<?php echo link_to('Twoje typy', 'typy/list?id='.$sf_user->getProfile()->getUserId()) ?>
	</li>
	<?php else: ?>
	<li>
		<?php echo link_to('Zaloguj','login') ?>
	</li>
	<li>
		<?php echo link_to('Zarejestruj','user/signin') ?>
	</li>
	<?php endif; ?>
	<li class="special">
		<?php $c = new Criteria() ?>
		<a>WYGRAJ <?php $elo = sfGuardUserProfilePeer::doCount($c); echo $elo * 10 ?> zl</strong>!</a>
	</li>
</ul>
</div>
