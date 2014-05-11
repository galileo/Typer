<div id="pula">
Pula<strong> <?php echo $zaplacili * 10 ?> </strong> zł <span>|</span>
Przewidywana pula<strong> <?php echo $wszyscy * 10 ?> </strong> zł <span>|</span>
Użytkownicy<strong> <?php echo $wszyscy  ?> </strong><span>|</span>
wpłaciło<strong> <?php echo $zaplacili ?> </strong><span>|</span>
<?php if(!$sf_user-> isAuthenticated()): ?>
<?php echo link_to('Dołącz do NICH !', 'user/signin') ?>
<?php endif; ?>
</div>