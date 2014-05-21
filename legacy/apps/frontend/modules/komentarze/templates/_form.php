
<div style="">
<?php echo form_tag('komentarze/comment')?>
	<?php echo label_for('tresc','Treść') ?>
	<br />
	
	<?php echo textarea_tag('tresc',$sf_params -> get('tresc'), array('width' => '300')) ?>
	<br />
	<?php echo submit_tag('dodaj komentarz') ?>
</form>
</div>
