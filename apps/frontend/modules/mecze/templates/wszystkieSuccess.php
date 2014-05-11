<?php use_helper('Typerzy') ?>

<div>
<h2>Wszystkie mecze</h2>
<?php include_partial('mecze/lista', array('sf_user' => $sf_user, 'mecze' => $mecze))?>
</div>