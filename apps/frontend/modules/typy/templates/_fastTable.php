<table class="fastTable">
<?php $i=1 ?>
<?php foreach($punkty as $punkt): ?>
	<tr>
		<td class="table_lp"><?php echo $i++ ?></td>
		<td class="table_user"><?php echo $punkt -> getsfGuardUser() -> getProfile() -> getFullname() ?></td>
		<?php if($sf_user->isAuthenticated()):?>
		<td class="table_user"><?php echo $punkt->getsfGuardUser()->getProfile()->getPieniadze()?> zł</td>
		<?php endif; ?>
		<td class="table_points"><?php echo $punkt -> getPunkty() ?></td>
	</tr>
<?php endforeach; ?>
<tr>
	<td><?php echo link_to("Cała tabela", 'punkty')?></td>
</tr>
</table>
