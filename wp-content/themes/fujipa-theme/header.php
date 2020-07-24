<html lang="ja">
<head>
	<link rel="shortcut icon" href="http://booking.orepa.jp/booking-fujipa/wp-content/uploads/2018/12/favicon.ico">
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" type="text/css" />
<!-- Custom styles for this template -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" type="text/css" />

<!-- Orepa default HomePage styles -->	
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css" type="text/css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/default.css" type="text/css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/component-top.css" type="text/css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/component-fruit.css" type="text/css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/fonts/icomoon/icomoon.css" type="text/css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/fixmenu.css" type="text/css" />
<link rel="shortcut icon" href="https://booking.orepa.jp/fujipa/wp-content/uploads/2018/12/favicon.ico">
<!-- MTS simplebooking C styles -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/mtssb-front.css" type="text/css" />

	
<title>【検証サイト】山梨FUJIフルーツパーク ご予約ページ</title>

<meta name="description" content="ご予約ページ">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/fade.js"></script>

<!-- top menu -->
<script>
$(function() {
    $('#navToggle').click(function(){//headerに .openNav を付加・削除
        $('header').toggleClass('openNav');
    });
});
</script>

<!-- top main -->
<script type="text/javascript">
if (OCwindowWidth() <= 900) {
	open_close("newinfo_hdr", "newinfo");
}
</script>

<!-- 予約ページトップの期間を選択するプルダウン対応 2018.11.18 kazuya.okamoto -->

<script>
jQuery(function () {
  // プルダウン変更時に遷移
  $('select[name=pulldown1]').change(function() {
    if ($(this).val() != '') {
      window.location.href = $(this).val();
    }
  });
  // ボタンを押下時に遷移
  $('#location').click(function() {
    if ($(this).val() != '') {
      window.location.href = $('select[name=pulldown2]').val();
    }
  });
});
</script>

</head>

<header>


    <!-- ==== top menu ==== -->


<!-- 翻訳　-->
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'ja', includedLanguages: 'ar,de,en,es,fr,id,it,ja,ko,nl,th,tl,vi,zh-CN,zh-TW', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</header>

	
<body>
	<!-- サイトのタイトル -->
		<!-- <div><?php bloginfo('name'); ?></div> --> 
	<!-- キャチフレーズ -->
		<!-- <div><?php bloginfo('description'); ?></div> -->

	
<div class="main clearfix">
	
	<!-- 施設のロゴを入れる -->
    <center><img src="<?php echo get_template_directory_uri(); ?>/img/fujipa_name.gif" class="fujipa-name" style="width:100%; max-width:410px; margin-top:-40px; margin-bottom:-5px;"></center>


	
  <nav id="menu" class="nav">
    <ul>
      <li> <a href="http://www.fujipa.orepa.jp/"> <span class="icon"> <i aria-hidden="true" class="icon-home"></i> </span> <span style="font-weight:bold">ホーム</span> </a> </li>
      <li> <a href="http://www.fujipa.orepa.jp/event/index.html"> <span class="icon"> <i aria-hidden="true" class="icon-event"></i> </span> <span style="font-weight:bold">セットプラン</span> </a> </li>
      <li> <a href="http://www.fujipa.orepa.jp/fruit/strawberry_index.html#strawberry"> <span class="icon"> <i aria-hidden="true" class="icon-fruit"></i> </span> <span style="font-weight:bold">果物狩り</span> </a> </li>
      <li> <a href="http://www.fujipa.orepa.jp/menu/index.html"> <span class="icon"> <i aria-hidden="true" class="icon-food"></i> </span> <span style="font-weight:bold">お食事</span> </a> </li>
	<li><a href="http://www.fujipa.orepa.jp/sweets/index.html"><span class="icon"><i aria-hidden="true" class="icon-ichigo2"></i></span>	<span style="font-weight:bold">スイーツ</span></a></li>
      <li> <a href="http://www.fujipa.orepa.jp/guide/index.html"> <span class="icon"> <i aria-hidden="true" class="icon-shop"></i> </span> <span style="font-weight:bold">館内案内</span> </a> </li>
      <li> <a href="http://www.fujipa.orepa.jp/login/index-login.html"> <span class="icon"> <i aria-hidden="true" class="icon-pass"></i> </span> <span style="font-weight:bold">業者専用</span> </a> </li>
    </ul>
  </nav>
</div>
</div>


	
<script>
			//  The function to change the class
			var changeClass = function (r,className1,className2) {
				var regex = new RegExp("(?:^|\\s+)" + className1 + "(?:\\s+|$)");
				if( regex.test(r.className) ) {
					r.className = r.className.replace(regex,' '+className2+' ');
			    }
			    else{
					r.className = r.className.replace(new RegExp("(?:^|\\s+)" + className2 + "(?:\\s+|$)"),' '+className1+' ');
			    }
			    return r.className;
			};	

			//  Creating our button in JS for smaller screens
			var menuElements = document.getElementById('menu');
			menuElements.insertAdjacentHTML('afterBegin','<button type="button" id="menutoggle" class="navtoogle" aria-hidden="true"><i aria-hidden="true" class="icon-menu"> </i> Menu</button>');

			//  Toggle the class on click to show / hide the menu
			document.getElementById('menutoggle').onclick = function() {
				changeClass(this, 'navtoogle active', 'navtoogle');
			}

			// http://tympanus.net/codrops/2013/05/08/responsive-retina-ready-menu/comment-page-2/#comment-438918
			document.onclick = function(e) {
				var mobileButton = document.getElementById('menutoggle'),
					buttonStyle =  mobileButton.currentStyle ? mobileButton.currentStyle.display : getComputedStyle(mobileButton, null).display;

				if(buttonStyle === 'block' && e.target !== mobileButton && new RegExp(' ' + 'active' + ' ').test(' ' + mobileButton.className + ' ')) {
					changeClass(mobileButton, 'navtoogle active', 'navtoogle');
				}
			}
</script>

