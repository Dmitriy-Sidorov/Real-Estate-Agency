<? get_header();?>

	<? if(have_posts()) :
		while(have_posts()) :
		the_post();
		?>
		
	<div class="news_item">
		<div class="article_item">
			<h2><a href="<? the_permalink();?>"><? the_title();?></a></h2>
			<? if(has_post_thumbnail()){?>
			<div class="alignleft"><a href="<? the_permalink();?>"><? the_post_thumbnail('thumb');?></a></div>
			<?}?>
			<? the_excerpt();?>
			<div class="date"><?php echo dateToRussian(get_the_date('j F Y')) ?></div>
		</div>
		<div class="hr_dash_solid"></div>	
		
		<?
		endwhile;
		endif;
		?>

		<? wp_pagenavi() ?>
        
<? get_footer();?>        