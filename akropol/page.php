<?
get_header();
?>
<? $field = get_post_meta(get_the_ID(), 'multiupload', true); ?>
<? if (!empty($field) && !(count($field)==1 && $field[0] == "http://placehold.it/100x100" )) { ?>
  <div class="site-showcase">
  <? if (count($field) > 1) { ?>
    <div class="owl-carousel owl-theme owl-loaded bannerCarousel">
      <? foreach ($field as $key => $imgurl) { ?>
        <div class="owl-item-inner" style="background-image: url('<?= $imgurl ?>');">
        </div>
      <?
      } ?>
    </div>
   <? } else { ?>
    <div class="parallax page-header-agents page-header"
         style="background-image:url('<?= $field[0] ?>');">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="header-h1">
            <h1><? the_title() ?></h1>
          </div>
        </div>
      </div>
    </div>
    </div>
  <? }
  ?>
  </div>
<? } ?>
  <div class="main" role="main">
    <div id="content" class="content full">
      <div class="container">
        <div class="page">
          <div class="row">
            <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
            <div class="col-xs-12">
              <? if (have_posts()) :
                while (have_posts()) :
                  the_post();
                  ?>
                  <? if (empty($field) || (count($field)==1 && $field[0] == "http://placehold.it/100x100" )) { ?>
                    <h1><? the_title() ?></h1>
                  <? } ?>
                  <? the_content(); ?>
                <? endwhile;
              endif;
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<? get_footer(); ?>