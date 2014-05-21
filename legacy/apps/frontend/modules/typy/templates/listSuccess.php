<?php use_helper('Typerzy')
?>
<h1>Typy</h1>

<table cellspacing="0" cellpadding="0">
<thead>
<tr>
  <th>Data</th>
  <th>Mecz</th>
  <th>Twój typ</th>
  <th>Punkty</th>
  <th>Akcja</th>
</tr>
</thead>
<tbody>
<?php foreach ($typs as $typ): ?>
<tr>
	  <td><?php echo $typ -> getMecz() -> getData() ?></td>
      <td><?php echo $typ->getMecz() ?></td>
      <td align="center"><?php echo $typ->getGole1() ?> : <?php echo $typ->getGole2() ?></td>
      <td> <?php echo $typ -> getPunkty() ?></td>
      <?php $suma += $typ -> getPunkty() ?>
      <td><?php echo link_to_typ_edytuj($typ -> getMecz())?></td>
  </tr>
<?php endforeach; ?>
<tr>
	<td colspan="3" align="right">Suma:</td>
	<th><?php echo $suma ?></th>
</tr>
</tbody>
</table>

