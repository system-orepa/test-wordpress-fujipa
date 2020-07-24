<?php

	include '../../../wp-load.php';


        /**
         * ログ出力 処理を開始  20200719 kazuya.okamoto add GitHub TEST コメント追記しました。
         * 
         */

        // ログファイル内 日時出力用
        $now_date = date("Y-m-d H:i:s",strtotime('+32400 second'));

        // ログファイル名 日付出力用 
        $now_date_filename = date("Ymd",strtotime('+32400 second'));

        $log_filename = "../../../../../../log/fruit/fruit-fujipa-add-".$now_date_filename.".log";

        file_put_contents($log_filename, $now_date." ######### 取り込み処理を開始します ######### "."\n", FILE_APPEND);


        /**
         * pdbでwordpressデータを取得する
         * No,Date,Name,Adult,Child,Baby,Time,Lunch,TEL,備考,表示,受付日時,WebID,Mail,じゃらん予約番号
         */


	global $wpdb;

	$now_time = time();

	$sql = "SELECT booking_id,booking_time,confirmed,client,note,created
        	FROM wp_mtssb_booking
        	WHERE CONFIRMED = 0 AND booking_time >= $now_time
        	ORDER BY BOOKING_ID ASC
        	LIMIT 1";

	$mtssb_booking_data = $wpdb->get_results($sql, ARRAY_A);

	if (empty($mtssb_booking_data)){
                // ログ出力
  		file_put_contents($log_filename, $now_date." 登録する予約データは存在しません "."\n", FILE_APPEND);
  		exit("登録する予約データは存在しません");
	}


        /**
         * mts_simple_booking データベースから取得したデータをFruit データベースへ登録する形式に変換する 
         * 
         */

	foreach ($mtssb_booking_data as $value) {

  	$value['client'] = unserialize($value['client']);

  	// 日付

  	$fruit_booking_date = date('Ymd',$value['booking_time']);
  	$fruit_booking_date2 = date('ymd',$value['booking_time']);
  	echo " fruit_booking_date        => ".$fruit_booking_date."\n";

  	// 名前

  	$fruit_booking_name = $value['client']['name'];
  	echo " fruit_booking_name        => ".$fruit_booking_name."\n";

  	// 大人

  	$fruit_booking_adult = $value['client']['adult'];
  	echo " fruit_booking_adult       => ".$fruit_booking_adult."\n";


  	// 子供

  	$fruit_booking_child = $value['client']['child'];
  	echo " fruit_booking_child       => ".$fruit_booking_child."\n";

  	// 幼児

  	$fruit_booking_baby = $value['client']['baby'];
  	echo " fruit_booking_baby        => ".$fruit_booking_baby."\n";

  	// 時間

  	$fruit_booking_time = date('Hi',$value['booking_time']);
  	echo " fruit_booking_time        => ".$fruit_booking_time."\n";

  	// Lunch

  	$fruit_booking_lunch = 0;
  	echo " fruit_booking_lunch       => ".$fruit_booking_lunch."\n";

  	// TEL

  	$fruit_booking_tel = $value['client']['tel'];
  	echo " fruit_booking_tel         => ".$fruit_booking_tel."\n";

  	// 備考

  	$fruit_booking_bikou = 1;
  	echo " fruit_booking_bikou       => ".$fruit_booking_bikou."\n";

  	// 表示

  	$fruit_booking_indication = 1;
  	echo " fruit_booking_indication  => ".$fruit_booking_indication."\n";

  	// 受付日付

  	$fruit_booking_created_date = $value['created'];
  	$fruit_booking_created = date('Ymd',strtotime($fruit_booking_created_date));
  	echo " fruit_booking_created     => ".$fruit_booking_created."\n";

  	// 場所 * unuse

  	// $fruit_booking_place = 1;
  	// echo " fruit_booking_place       => ".$fruit_booking_place."\n";

  	// WebID ※日付6桁 + 予約ID 下5桁
 
  	$booking_id_right5 = substr("00{$value['booking_id']}",-5);
  	$fruit_booking_webid = "$fruit_booking_date2"."$booking_id_right5";
  	echo " fruit_booking_webid       => ".$fruit_booking_webid."\n";

  	// メールアドレス

  	$fruit_booking_email = $value['client']['email'];
  	echo " fruit_booking_email       => ".$fruit_booking_email."\n";

  	// じゃらん予約番号

  	$fruit_booking_jalan = null;
  	echo " fruit_booking_jalan       => ".$fruit_booking_jalan."\n";

  	// 改行

  	echo "---"."\n";

  	// NOTE

  	$fruit_booking_note = $value['note'];
  	echo " fruit_booking_note        => ".$fruit_booking_note."\n";

  	// booking_id

  	$mtssb_booking_id = $value['booking_id'];

  	// 改行
  	echo "\n"."\n";

  	}


        /**
         * データベースへの登録情報をログファイルにまとめて出力する 
         *
         */

        file_put_contents($log_filename, $now_date." 予約ID           => ".$mtssb_booking_id."\n", FILE_APPEND);
        file_put_contents($log_filename, $now_date." 予約日           => ".$fruit_booking_date."\n", FILE_APPEND);
        file_put_contents($log_filename, $now_date." 予約者名         => ".$fruit_booking_name."\n", FILE_APPEND);
        file_put_contents($log_filename, $now_date." 予約人数.大人    => ".$fruit_booking_adult."\n", FILE_APPEND);
        file_put_contents($log_filename, $now_date." 予約人数.子供    => ".$fruit_booking_child."\n", FILE_APPEND);
        file_put_contents($log_filename, $now_date." 予約人数.幼児    => ".$fruit_booking_baby."\n", FILE_APPEND);
        file_put_contents($log_filename, $now_date." 予約時間         => ".$fruit_booking_time."\n", FILE_APPEND);
        file_put_contents($log_filename, $now_date." Lunch            => ".$fruit_booking_lunch."\n", FILE_APPEND);
        file_put_contents($log_filename, $now_date." 電話番号         => ".$fruit_booking_tel."\n", FILE_APPEND);
        file_put_contents($log_filename, $now_date." 備考             => ".$fruit_booking_bikou."\n", FILE_APPEND);
        file_put_contents($log_filename, $now_date." 表示             => ".$fruit_booking_indication."\n", FILE_APPEND);
        file_put_contents($log_filename, $now_date." 予約受付日付     => ".$fruit_booking_created."\n", FILE_APPEND);
        // file_put_contents($log_filename, $now_date." 場所             => ".$fruit_booking_place."\n", FILE_APPEND);
        file_put_contents($log_filename, $now_date." WebID            => ".$fruit_booking_webid."\n", FILE_APPEND);
        file_put_contents($log_filename, $now_date." メールアドレス   => ".$fruit_booking_email."\n", FILE_APPEND);
        file_put_contents($log_filename, $now_date." じゃらん予約番号 => ".$fruit_booking_jalan."\n", FILE_APPEND);
        file_put_contents($log_filename, $now_date." メモ             => ".$fruit_booking_note."\n", FILE_APPEND);



 
 
        /**
         * MTS Simple Booking のデータベースから取得したデータをFruitデータベース登録用の配列にまとめる
         * 
         */

  	global $fruit_insert_array;
  	$fruit_insert_array = [];
  	$fruit_insert_array[] = $fruit_booking_date; 
  	$fruit_insert_array[] = $fruit_booking_name;
  	$fruit_insert_array[] = $fruit_booking_adult;
  	$fruit_insert_array[] = $fruit_booking_child;
  	$fruit_insert_array[] = $fruit_booking_baby;
  	$fruit_insert_array[] = $fruit_booking_time;
  	$fruit_insert_array[] = $fruit_booking_lunch;
  	$fruit_insert_array[] = $fruit_booking_tel;
  	$fruit_insert_array[] = $fruit_booking_bikou;
  	$fruit_insert_array[] = $fruit_booking_indication;
  	$fruit_insert_array[] = $fruit_booking_created;
  	// $fruit_insert_array[] = $fruit_booking_place;
  	$fruit_insert_array[] = $fruit_booking_webid;
  	$fruit_insert_array[] = $fruit_booking_email;
  	$fruit_insert_array[] = $fruit_booking_jalan;
	// $fruit_insert_array[] = $fruit_booking_note;

  	// var_dump($fruit_insert_array);

        /**
         * Fruit データベースへ配列にまとめたデータを登録する
         * 
         */

	$serverName = '192.168.1.203';
	$database = 'FujiFruit';
	$uid = 'orepa2';
	$pwd = 'orepapass';


        /**
         * 「いちご狩り一般予約」テーブルに登録する
         *
         */

	$sql = "INSERT INTO いちご狩り一般予約 
	(日付,名前,大人,小人,幼児,時間,Lunch,TEL,備考,表示,受付日付,WebID,メールアドレス,じゃらん予約番号)
	VALUES
	('" . implode( "','", $fruit_insert_array) . "')";

	echo $sql."\n";

       	// ログ出力 SQL
       	file_put_contents($log_filename, $now_date." -------------------------------------------- "."\n", FILE_APPEND);
       	file_put_contents($log_filename, $now_date." * [ いちご狩り一般予約 ] へ登録開始 "."\n", FILE_APPEND);
       	file_put_contents($log_filename, $now_date." -------------------------------------------- "."\n", FILE_APPEND);
       	file_put_contents($log_filename, $sql."\n", FILE_APPEND);


	$dbh1 = new PDO( "sqlsrv:server=$serverName;Database = $database", $uid, $pwd);
	$stmt = $dbh1->prepare($sql);
	$stmt->execute();
	$dbh1 = null;

	// ログ出力 登録完了
        file_put_contents($log_filename, $now_date." -------------------------------------------- "."\n", FILE_APPEND);
       	file_put_contents($log_filename, $now_date." * [ いちご狩り一般予約 ] へ登録完了 "."\n", FILE_APPEND);
       	file_put_contents($log_filename, $now_date." -------------------------------------------- "."\n", FILE_APPEND);


        /**
         * 「いちご狩り一般予約W備考」に登録するために [いちご狩り一般予約]に登録した No. の値を取得
         *
         */

	$sql = "SELECT No FROM いちご狩り一般予約
	WHERE WebID = '$fruit_booking_webid'
	ORDER BY No DESC";

	echo $sql."\n";

	// ログ出力 SQL
	file_put_contents($log_filename, $now_date." -------------------------------------------- "."\n", FILE_APPEND);
	file_put_contents($log_filename, $now_date." * [ いちご狩り一般予約 ] からNoを取得開始 "."\n", FILE_APPEND);
	file_put_contents($log_filename, $now_date." -------------------------------------------- "."\n", FILE_APPEND);
	file_put_contents($log_filename, $sql."\n", FILE_APPEND);

	$dbh2 = new PDO( "sqlsrv:server=$serverName;Database = $database", $uid, $pwd);
	$stmt = $dbh2->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetch();

	$result = $results['No'];

	// 例外処理

        if (empty($result)){
	// ログ出力
	file_put_contents($log_filename, $now_date." ERROR : [No] の取得に失敗しました。処理を終了します。 "."\n", FILE_APPEND);
	exit("ERROR [No] の取得に失敗しました。");
	}

	echo "No. = ".$result."\n";
	$dbh2 = null;

	// ログ出力 登録完了
        file_put_contents($log_filename, $now_date." No               => ".$result."\n", FILE_APPEND);
	file_put_contents($log_filename, $now_date." -------------------------------------------- "."\n", FILE_APPEND);
	file_put_contents($log_filename, $now_date." * [ いちご狩り一般予約 ] からNoを取得完了 "."\n", FILE_APPEND);
	file_put_contents($log_filename, $now_date." -------------------------------------------- "."\n", FILE_APPEND);



        /**
         * 「いちご狩り一般予約W備考」に登録する 
         *
         */

	$dbh3 = new PDO( "sqlsrv:server=$serverName;Database = $database", $uid, $pwd);

	$note_write_data = mb_substr("WEB {$fruit_booking_note}",0,32,"UTF-8"); 

	$sql = "INSERT INTO いちご狩り一般予約W備考
	(No,備考)
	VALUES
	('$result','$note_write_data')";

	echo $sql."\n";


	// ログ出力 SQL
	file_put_contents($log_filename, $now_date." -------------------------------------------- "."\n", FILE_APPEND);
	file_put_contents($log_filename, $now_date." * [ いちご狩り一般予約W備考 ] へ登録開始 "."\n", FILE_APPEND);
	file_put_contents($log_filename, $now_date." -------------------------------------------- "."\n", FILE_APPEND);
	file_put_contents($log_filename, $sql."\n", FILE_APPEND);


	$stmt = null;

	$stmt = $dbh3->prepare($sql);
	$stmt->execute();
	$dbh3 = null;


	// ログ出力 登録完了
	file_put_contents($log_filename, $now_date." -------------------------------------------- "."\n", FILE_APPEND);
	file_put_contents($log_filename, $now_date." * [ いちご狩り一般予約W備考 ] へ登録完了 "."\n", FILE_APPEND);
	file_put_contents($log_filename, $now_date." -------------------------------------------- "."\n", FILE_APPEND);



        /**
         * MTS Simple Booking のデータベースの Confirmed の値を1にセットする
         * 
         */

	$wpdb->update(
		'wp_mtssb_booking',
 		array(
     			'CONFIRMED' => '1'
  		),
 		array(
     			'booking_id'=>$mtssb_booking_id
  		)
	);


	// ログ出力 Confirmed の値を 1 にセット
	file_put_contents($log_filename, $now_date." -------------------------------------------- "."\n", FILE_APPEND);
	file_put_contents($log_filename, $now_date." Confirmed の値を 1 に更新完了 "."\n", FILE_APPEND); 
	file_put_contents($log_filename, $now_date." -------------------------------------------- "."\n", FILE_APPEND);



        /**
         * ログ出力 処理完了
         *
         */

        file_put_contents($log_filename, $now_date." ######### 取り込み処理が完了しました ######### "."\n", FILE_APPEND);
        file_put_contents($log_filename, " "."\n", FILE_APPEND);




?>
