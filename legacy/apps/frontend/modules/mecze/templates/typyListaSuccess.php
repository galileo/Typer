<h1><?php echo sprintf('%s %s', $mecz->getDruzyny() , $mecz->getWynik()
		)?></h1>

<h3>Typy użytkowników:</h3>
<table cellpadding="0" cellspacing="0">
	
	<?php if($mecz -> getTyps()): ?>
		<?php foreach($mecz -> getTyps() as $typ): ?>
			<tr <?php echo ($typ->getsfGuardUser()->getId()==$sf_user->getGuardUser()->getId()) ? 'class="mojTyp"' : ''?>> 
				<td><?php echo $typ -> getUpdatedAt(); ?></td>
				<td><?php echo $typ -> getsfGuardUser() -> getProfile() -> getFullname() ?></td>
				<?php if(!$mecz->getAktywny()):?>
					<td><?php echo $typ -> getWynik() ?></td>
					<td><?php echo $typ -> getPunkty() ?></td>
				<?php else: ?>
					<td>Typy będą widoczne po zakończeniu typowania. Na godzinę przed rozpoczęciem meczu.</td>
				<?php endif; ?>
			</tr>
		<?php endforeach; ?>
	<?php else: ?>
		<tr><th colspan="2"> Tego meczu nikt nie typował.</th></tr>
	<?php endif; ?>
</table>
