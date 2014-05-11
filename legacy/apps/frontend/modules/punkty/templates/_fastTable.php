<?php echo $sf_user->isAuthenticated()?>
<?php if($sf_user->isAuthenticated()):?>
<?php include_partial('typy/fastTable', array('punkty' => $punkty))?>
<?php endif; ?>