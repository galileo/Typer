<table cellpadding="0" cellspacing="0" width="600">
<?php foreach($mecze as $mecz): ?>

	<tr>
		<td><?php echo $mecz -> getData() ?> </td>
		<td><?php echo link_to($mecz->getZespol1() . ' - ' . $mecz->getZespol2(), 'mecze/typyLista?mecz='.$mecz->getId()); ?></td>
		<td><?php echo $mecz -> getWynik()?></td>
		<?php if($sf_user -> isAuthenticated()): ?>
			
				<td><?php echo sprintf(
						'%s [%d]',
						$mecz->getTwojTyp(),
						$mecz->getTypyIlosc()
				); ?></td>
				<th>
				<?php echo link_to_typ_edytuj($mecz) ?>
				</th>		
		<?php endif ?>
	</tr>
	<tr>
		<td><div id='mecz_<?php echo $mecz -> getId() ?>'></div></td>
	</tr>
<?php endforeach; ?>
</table>