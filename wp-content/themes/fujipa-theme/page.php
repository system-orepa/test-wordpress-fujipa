<?php
/*
Template Name: About
*/
?>   

<?php get_header(); ?>

<center>
<div>
    
		<?php if(have_posts()): while(have_posts()): the_post(); ?> <!-- ループ開始 -->

	<!-- 固定ページ作成日時を表示 -->	
		<!-- <?php echo get_the_date(); ?> -->
	<!-- 固定ページ　サイトカテゴリーを表示 -->
		<!-- <?php the_category(', '); ?> -->
	<!-- 固定ページ　サイトタイトルを表示 -->
		<!-- <?php the_title(); ?> -->
	<!-- カレンダーを表示 -->
	　　<?php the_content(続きを読む); ?>
	<?php endwhile; endif; ?> <!-- ループ終了 -->

</div>
	
</center>	
<?php get_footer(); ?>
