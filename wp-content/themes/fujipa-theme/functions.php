<?php
 
if ( ! function_exists( 'lab_setup' ) ) :
 
function lab_setup() {
	/*
	 * 自動フィードリンク
	 * 参照：https://wpdocs.osdn.jp/%E8%87%AA%E5%8B%95%E3%83%95%E3%82%A3%E3%83%BC%E3%83%89%E3%83%AA%E3%83%B3%E3%82%AF
	 */
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * titleを自動で書き出し
	 * 参照：http://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_theme_support#Title_.E3.82.BF.E3.82.B0
	 */
	add_theme_support( 'title-tag' );
	
	/*
	 * アイキャッチ画像を設定できるようにする
	 * 参照：http://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_theme_support#.E6.8A.95.E7.A8.BF.E3.82.B5.E3.83.A0.E3.83.8D.E3.82.A4.E3.83.AB
	 */
	add_theme_support( 'post-thumbnails' );
	
	/*
	 * 検索フォーム、コメントフォーム、コメントリスト、ギャラリー、キャプションでHTML5マークアップの使用を許可します
	 * 参照：http://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_theme_support#HTML5
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/*function include_php_shortcode($atts) {    
	global $original_array;
	ob_start();
	$original_array=$atts;
	get_template_part($original_array['slug']);
	return ob_get_clean();
    }
    add_shortcode("include_php", "include_php_shortcode");
	 * テーマカスタマイザーにおける編集ショートカット機能の使用
	 * 参照：https://celtislab.net/archives/20161222/wp-customizer-edit-shortcut/
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/*
	 * カスタムメニュー位置を定義
	 * 参照：https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_nav_menus
	 */
	register_nav_menus( array(
		'global' => 'グローバルナビ',
	) );
	
}
endif;
add_action( 'after_setup_theme', 'lab_setup' );
 
/*
 * 動画や写真を投稿する際のコンテンツの最大幅を設定
 * 参照：https://wpdocs.osdn.jp/%E3%82%B3%E3%83%B3%E3%83%86%E3%83%B3%E3%83%84%E5%B9%85
 */
function lab_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lab_content_width', 640 );
}
add_action( 'after_setup_theme', 'lab_content_width', 0 );
 
/*
 * サイドバーを定義
 * 参照：http://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_sidebar
 */
function lab_widgets_init() {
	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'description'   => 'ここにウィジェットを追加',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'lab_widgets_init' );
 
/*
 * スクリプトを読み込み
 * wp_enqueue_styleについて参照：https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/wp_enqueue_style
 * wp_enqueue_scriptについて参照：https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/wp_enqueue_script
 */
function lab_scripts() {
	wp_enqueue_style( 'lab-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'lab_scripts' );


/*
 * kazuya.okamoto add
 */ 

add_filter('mtssb_download_list_name', 'download_list_name');
function download_list_name($name) {
    return 'list.csv';
}

add_filter('mtssb_download_list_order', 'download_list_order');
function download_list_order($items) {
    return array(
		'reserve_id' => '予約ID',
        'booking_time' => '予約日時',
		'client.name' => '予約者名',
		'client.tel' => '電話番号',
		'client.email' => 'メールアドレス',
		'client.adult' => '人数（大人）',
		'client.child' => '人数（子供）',
		'client.baby' => '人数（幼児）',
		'note' => 'お問い合わせ',
		'confirmed' => '確認（済）',
		'user_id' => '確認（CXL）',
		'parent_id' => '確認（30分）'
    );
}

/*
 * タイムテーブルカレンダーの表示修正
 * add by kazuya.okamoto
 * 2019.11.04
 */ 

// タイムテーブルのタイトル変更
/*
add_filter('mtssb_timetable_name', 'timetableName', 10, 2);
function timetableName($str, $param) {
      return $str . ' のご予約 ';
}
*/

// 予約フォーム 残数表示
add_filter('mtssb_timetable_select_option', 'timeSelectOption', 10, 2);
function timeSelectOption($str, $param) {
    return sprintf('%s～  残%d',date('H:i', $param['time']), $param['remain']);
}
 
// 予約フォーム送信ボタン表示変更
add_filter('mtssb_daily_timetable_submit', 'timeSelectBtn', 10, 2);
function timeSelectBtn($str, $param) {
    return '予約する';
}

?>
