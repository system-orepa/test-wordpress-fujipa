    <p class="pagetop"><a href="#wrap">▲</a></p>
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js">
    </script>
    <script>
		$(document).ready(function() {
		var pagetop = $('.pagetop');
		$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
		pagetop.fadeIn();
		} else {
		pagetop.fadeOut();
		}
		});
		pagetop.click(function () {
		$('body, html').animate({ scrollTop: 0 }, 500);
		return false;
		});
		});
    </script>
    

    <!-- ==== footer mikanchan ==== -->
    <p style="position: relative;">
    <span style="position: absolute; top: -45px; left: 131px; width: 160px; height: 110px;">
    <img src="<?php echo get_template_directory_uri(); ?>/img/mikanchan4.gif" width="148" height="117" >
    </span><br/>
    </p>
    
    <!-- ==== footer ==== -->
<footer>
  <h3>CONTENTS</h3>
  <a href="http://fujipa.orepa.jp/">HOME</a> / <a href="http://fujipa.orepa.jp/event/index.html">セットプラン</a> / <a href="http://www.fujipa.orepa.jp/fruit/strawberry_index.html#strawberry">果物狩り</a> / <a href="http://fujipa.orepa.jp/menu/index.html">お食事</a> /  <a href="http://www.fujipa.orepa.jp/sweets/index.html">スイーツ</a> /  <a href="http://fujipa.orepa.jp/guide/index.html">館内案内</a> / <a href="http://fujipa.orepa.jp/login/index-login.html">業者専用</a> / <a href="http://fujipa.orepa.jp/access/index.html">アクセス</a> / <a href="http://fujipa.orepa.jp/faq/index.html">よくある質問</a>  / <a href="http://blog.orepa.jp/">FARM NEWS</a> </font><br>
  <br>
<center>
	<img src="<?php echo get_template_directory_uri(); ?>/img/fujipa_logo.gif" width="54" height="42" class="o_logo"><b style="padding:0 5px;">山梨FUJIフルーツパーク</b><a href="https://www.facebook.com/%E5%B1%B1%E6%A2%A8FUJI%E3%83%95%E3%83%AB%E3%83%BC%E3%83%84%E3%83%91%E3%83%BC%E3%82%AF-613197262465364/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/facebook_link.gif" width="29" height="29" class="o_logo"></a><a href="https://twitter.com/g_orepa" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/twitter_link.gif" width="29" height="29" class="o_logo"></a></center>
  〒406-0802<br>
  山梨県笛吹市御坂町金川原888<br>
  TEL/055-262-7211<br>
  FAX/055-262-7212<br>
</footer>
