<html>
<head>

    <?php include_http_metas() ?>
    <?php include_metas() ?>

    <?php include_title() ?>

    <link rel="shortcut icon" href="/favicon.ico"/>

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-1015424-17']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();

    </script>

</head>
<body>
<?php include_partial('user/loginBar', array('sf_user' => $sf_user)) ?>

<div id="page" class="container">
    <?php include_partial('user/menu', array('sf_user' => $sf_user)) ?>

    <div id="logo">
        <img src="<?php echo url_for("@homepage"); ?>images/world-cup-2014.jpg"/>

        <div class="fastTableTop">
            <h4>Top 5</h4>
            <?php include_component('punkty', 'fastTable', array('limit' => 5)); ?>
        </div>
    </div>
    <div id="content" class="span-13">
        <?php if ($sf_user->isAuthenticated()): ?>
            <div class="menu">
                <ul>
                    <li>
                        <?php echo link_to('Dzisiaj', '@homepage') ?>
                    </li>
                    <li>
                        <?php echo link_to('Wszystkie mecze', 'mecze/wszystkie') ?>
                    </li>
                    <li>
                        <?php echo link_to("Tabela", 'punkty') ?>
                    </li>
                    <li>
                        <?php echo link_to('Moje typy', 'typy/list?id=' . $sf_user->getProfile()->getUserId()) ?>
                    </li>
                    <li>
                        <?php echo link_to('Wyloguj ' . $sf_user->getProfile()->getFullName(), 'logout') ?>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
        <br/><br/><br/><br/>

        <h3>To już 8 lat od naszej pierwszej rozgrywki!</h3>
        <h4>3 mistrzostwa świata!</h3>
        <ul>
            <li><a href="http://world-cup-2014.ktotowygra.pl/">World Cup 2014 - Brazylia</a> <strong>Pula OBY WIĘCEJ!</strong></li>
            <li><a href="http://euro-2012.ktotowygra.pl/">Euro 2012 - Polska i Ukraina</a> <strong>Pula 330 zł</strong></li>
            <li><a href="http://world-cup-2010.ktotowygra.pl/">World Cup 2010 - RPA</a> <strong>Pula 280 zł</strong></li>
            <li><a href="http://euro-2008.ktotowygra.pl/">Euro 2008 - Austria i Szwajcaria</a> <strong>Pula 100 zł</strong></li>
            <li>Wrold Cup 2006 - Niemcy (Format miejsc w grupach)</li>
        </ul>
        <?php echo $sf_data->getRaw('sf_content') ?>
    </div>
    <div class="span-5">
        <?php include_partial('mecze/cupGroups') ?>
    </div>
    <div class="span-9 last">
        <?php include_component('komentarze', 'ostatnie', array('sf_user' => $sf_user)); ?>
    </div>
    <div id="footer">
        <h4>Created by Kamil Ronewicz "<a href="http://galileoprime.com">Galileo Prime</a>"</h4>
    </div>
</div>

</body>
</html>