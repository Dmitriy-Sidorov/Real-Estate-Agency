<?
/**
 * Template Name: Агенты
 * @package WordPress
 */

get_header(); ?>
  <div class="parallax page-header-agents page-header"
       style="background-image:url(http://akropol69.ru/wp-content/uploads/2017/10/Background-about-us-min.jpg);">
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
  <div class="main" role="main">
    <div id="content" class="content full">
      <div class="container">
        <ul class="row">
          <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>

          <div class="col-md-12">
            <div class="block-heading"><h4><span class="heading-icon"><i class="fa fa-caret-right icon-design"></i><i
                      class="fa fa-users"></i></span>Все агенты</h4></div>
            <div class="agents-listing">
              <ul>
              <?
              query_posts(array(
                      'post_type' => 'agents',
                      "posts_per_page" => '-1',
                      'paged' => get_query_var('paged'),
                  )
              );
              if (have_posts()):
              while (have_posts()):
              the_post(); ?>
              <li class="col-md-12">
                <div class="col-md-4">
                  <a href="<?=get_permalink()?>" class="agent-featured-image">
                    <?if (!empty(get_the_post_thumbnail())) {?>
                      <?=get_the_post_thumbnail()?>
                    <?} else {?>
                        <img src="<?=get_template_directory_uri()?>/images/default_agent1.png" alt="<?the_title()?>">
                    <?}
                    ?>
                  </a>
                </div>
                <div class="col-md-8">
                  <div class="agent-info">
                    <div class="row">
                      <div class="col-md-5 col-sm-5 col-xs-5"><h3><a href="<?=get_permalink()?>"><?the_title()?></a></h3>
                        <div class="contact-info">
                          <div class="user-info">
                            <div class="fa fa-phone"></div>
                            <?=the_field("phone")?>
                          </div>
                          <div class="user-info">
                            <div class="fa fa-envelope"></div>
                            <?=the_field("email")?>
                          </div>
                        </div>
                      </div>
                      <?$query = new WP_Query(array('post_type'=>'objects',"posts_per_page" => '-1','post_status'=>'publish', 'meta_query' => array(
                          array(
                            'key' => 'agent',
                            'value' => get_the_ID(),
                            'type' => 'numeric',
                            'compare' => '=',
                          )
                      )));
                        $count = 0;
                        while($query->have_posts()):$query->the_post();
                          $count++;
                        endwhile;wp_reset_postdata();

                      ?>
                      <div class="col-md-7 col-sm-7 col-xs-7">
						  <a href="<?=get_permalink()?>#object-realtor"><div class="counts"><strong><?=$count?></strong><span>Объектов</span></div></a>
                      </div>
                    </div>
                    <h4><?=the_field("position")?></h4></div>
                  <div class="agent-contacts clearfix"></div>
                  <div class="col-md-12 agent-margin-lg"></div>
                </div>
                <div class="agent-contacts clearfix btn-agents"><a href="<?=get_permalink()?>"
                                                                   class="btn btn-primary pull-right btn-sm">Страница
                    агента</a></div>
              </li>
            <? endwhile; ?>
            </ul>
            <div class="col-md-12 text-center">
              <? pagination(); ?>
            </div>
            <? else: ?>
            </div>
              <div class="col-md-12">
                Элементов не найдено
              </div>
            <? endif; ?>
            </div>
          </div>
        </div>
      </div>

      <? wp_reset_query(); ?>
<? get_footer(); ?>