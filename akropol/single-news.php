<?
get_header();?>
<?php while(have_posts()):the_post(); ?>
	<?
	$image = '';
	$thumb_size = 'full';

	if ( '' != get_the_post_thumbnail() ) {
	$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),$thumb_size);
	$image = $image[0];
	} ?>
	<div class="parallax page-header-agents page-header" style="background-image:url(<?the_field("banner_img");?>);">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="header-h1">
						<h1><?the_title()?></h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="main" role="main">
	<div id="content" class="content full">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<header class="single-post-header clearfix">

						<h2 class="post-title"><?php the_title(); ?></h2>
					</header>
					<article class="post-content" itemscope="" itemtype="http://schema.org/Article">
						<div class="post-meta meta-data">
							<span><i class="fa fa-calendar"></i><span itemprop="datePublished"><? echo get_the_date(); ?></span></span>
							<!--<span><i class="fa fa-user"></i><span itemprop="author"><?php//  $author_id = $post->post_author; the_author_meta('first_name', $author_id); ?></span></span>-->
							<span><i class="fa fa-tag"></i>Рубрики: <?php the_category(', '); ?></span>
							<!--<span><?php// comments_popup_link('<i class="fa fa-comment"></i>'.__('No comments yet','framework'), '<i class="fa fa-comment"></i>1', '<i class="fa fa-comment"></i>%', 'comments-link',__('Comments are off for this post','framework')); ?></span>-->
						</div>
						<?php if ( '' != get_the_post_thumbnail() ) { ?>
							<!--<div class="featured-image"> <img src="<?php /*echo $image; */?>" alt=""> </div>-->
						<?php } echo "<span itemprop='articleBody'>"; the_content();echo "</span>";


						wp_link_pages();

						if (has_tag()) {
							echo'<div class="post-meta">';
							echo'<i class="fa fa-tags"></i>';
							the_tags('', ', ');
							echo'</div>';
						} ?>
					</article>
					<?php// comments_template('', true); ?>
				</div>
				<!-- Start Sidebar -->

			</div>
		</div>
	</div>
	</div>
	<?endwhile;?>
<? get_footer(); ?>