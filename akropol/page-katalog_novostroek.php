<?
/**
 * Template Name: Каталог новостроек
 * @package WordPress
 */

get_header(); ?>

  <div class="main" role="main">
    <div id="content" class="content full">
      <div class="container">
        <div class="row">
          <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
          <div class="col-md-12">
            <h1><? the_title() ?></h1>
            <div class="catalog">
            <?$content = get_the_content();?>
            <?
            query_posts(array(
                    'post_type' => 'katalog_novostroek',
                    "posts_per_page" => '20',
                    'paged' => get_query_var('paged'),
                )
            );
            if (have_posts()):
              while (have_posts()):the_post(); ?>
                <div class="col-md-3 col-sm-4 col-xs-6 featured-block catalog-novostroek">
                  <a href="<?= get_permalink() ?>" target="_blank"><br>
                    <? if (!empty(get_the_post_thumbnail())) { ?>
                      <?= get_the_post_thumbnail() ?>
                    <? } else { ?>
                      <img src="<?=get_template_directory()?>/images/nofoto.png" alt="<? the_title() ?>"
                           class="img-thumbnail">
                    <? } ?>
                  </a>
                  <p></p>
                  <h3><a href="<?= get_permalink() ?>" target="_blank"><? the_title() ?></a></h3>
                </div>
              <? endwhile; ?>
            <? else: ?>
              <div class="col-md-12">
                Новостроек не найдено
              </div>
            <? endif; ?>
            <? wp_reset_query(); ?>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="col-md-12">
            <p></p>
            <?=$content?>
            <p></p>
            <?include get_template_directory()."/include/question.php";?>
          </div>
        </div>
      </div>
    </div>
  </div>
<? get_footer(); ?>