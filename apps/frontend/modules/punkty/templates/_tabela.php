<div style="float:right">
<table cellpadding="0" cellspacing="0" style="border: 3px solid #2C97EF">
<tr>
	<td style="color:#2C97EF; text-align: center;" colspan="2">Tabela Graczy</td>
</tr>
<tr>
	<th colspan="2"><?php echo $turniej -> getNazwa() ?></th>
</tr>
<tr>
	<td></td>	
	<td>Gracz</td>
	<td>Punkty</td>
</tr>
<?php $i=1 ?>
<?php foreach($punkty as $punkt): ?>
	<tr>
		<th><?php echo $i++ ?></td>
		<td><?php echo $punkt -> getsfGuardUser() -> getProfile() -> getFullname() ?></td>
		<th><?php echo $punkt -> getPunkty() ?></th>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div style="clear:both"></div>
<br />