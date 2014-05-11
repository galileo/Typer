<?php echo form_tag('@typ_update')?>
<table cellpadding="0" cellspacing="0">
	<tr>
	<th>
	<?php echo $typ->getMecz() ?>
	</th>
	<td>
	<?php echo input_hidden_tag('id',$typ -> getId()) ?>
	<?php echo input_hidden_tag('mecz_id', $typ -> getMeczId()) ?>
	<?php echo input_tag('gole1',$typ->getGole1()) ?>
	:
	<?php echo input_tag('gole2',$typ->getGole2()) ?>
	<?php echo submit_tag('zapisz') ?>
	</td>
	</tr>
</table>
</form>