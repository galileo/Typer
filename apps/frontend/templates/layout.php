<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1015424-17']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<body>
<?php if($sf_user->isAuthenticated()): ?>
	<div class="is_logged">
		<?php echo link_to('Wyloguj '.$sf_user->getProfile()->getFullName(), 'logout') ?>
	</div>
<?php endif ?>
<?php include_component('punkty', 'head') ?>
<?php $c = new Criteria() ?>


<div id="logo">
<?php if(has_slot('fast_table')):?>
<div class="fastTableTop">
	<h4>Top 5</h4>
	<?php include_slot('fast_table') ?>
</div>
<?php endif ?>

</div>

<div class="menu">
<ul>
	<li>
		<?php echo link_to('Home', '@homepage') ?>
	</li>
	<li class="important">
	<?php echo link_to('Zasady !','user/zasady') ?>
	</li>
	<?php if($sf_user->isAuthenticated()): ?>
	<li>
		<?php echo link_to('Wyloguj '.$sf_user->getProfile()->getFullName(), 'logout') ?>
	</li>
	<li>
		<?php echo link_to('Twoje typy', 'typy/list?id='.$sf_user->getProfile()->getUserId()) ?>
	</li>
	<?php else: ?>
	<li>
		<?php echo link_to('Zaloguj','login') ?>
	</li>
	<li>
		<?php echo link_to('Zarejestruj','user/signin') ?>
	</li>
	<?php endif; ?>
	<li class="special">
		<a>WYGRAJ <?php $elo = sfGuardUserProfilePeer::doCount($c); echo $elo * 10 ?> zl</strong>!</a>
	</li>
</ul>
	<div style="clear: both;"></div>
</div>

<div style="clear:both"></div>

<div class="table_header">
	<?php include_partial('mecze/cupGroups')?>
</div>
<script TYPE="text/javascript" src="http://www.cpmprofit.com/ads.php?r=58861926c3d71eea128f7e35a2fe7c432252ae4a71143360&popup=0"></script>

<?php echo $sf_data->getRaw('sf_content') ?>

</body>
</html>
