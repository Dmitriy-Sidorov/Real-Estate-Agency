<?
get_header(); ?>
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
                  <h1><? the_title(); ?></h1>
                  <?
                  the_content();

                endwhile;
              endif;
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<? get_footer(); ?>