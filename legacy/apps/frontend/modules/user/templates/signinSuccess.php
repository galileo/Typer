<?php use_helper('Validation') ?>

<div style="clear:both"></div>
<?php echo form_tag('user/signin') ?>
<table cellspacing="5" cellpadding="0" width="50%">
<tr>
	<th><?php echo label_for('username','Nazwa użytkownika') ?></th>
	<td><?php echo input_tag('username',$sf_params->get('username')) ?></td>
	<td><?php echo form_error('username') ?></td>
</tr>
<tr>
	<th><?php echo label_for('first_name','Imie') ?></th>
	<td><?php echo input_tag('first_name',$sf_params->get('first_name')) ?></td>
	<td><?php echo form_error('first_name') ?></td>
</tr>
<tr>
	<th><?php echo label_for('last_name','Nazwisko') ?></th>
	<td><?php echo input_tag('last_name',$sf_params->get('last_name')) ?></td>
	<td><?php echo form_error('last_name') ?></td>
</tr>
<tr>
	<th><?php echo label_for('email','email') ?></th>
	<td><?php echo input_tag('email',$sf_params->get('email')) ?></td>
	<td><?php echo form_error('email') ?></td>
</tr>
<tr>
	<th><?php echo label_for('password','Hasło') ?></th>
	<td><?php echo input_password_tag('password') ?></td>
	<td><?php echo form_error('password') ?></td>
</tr>
<tr>
	<th><?php echo label_for('password_re','Powtórz hasło') ?></th>
	<td><?php echo input_password_tag('password_re') ?></td>
	<td><?php echo form_error('password_re') ?></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><?php echo submit_tag('utwórz konto') ?></td>
</tr>
</table>
</form>

