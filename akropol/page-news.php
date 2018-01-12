<?
/**
 * Template Name: Новости
 * @package WordPress
 */

get_header(); ?>

  <div class="main" role="main">
    <div id="content" class="content full">
      <div class="container">
        <div class="row">
          <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
          <div class="col-md-12">
            <ul class="grid-holder col-3">
              <?
              query_posts(array(
                      'post_type' => 'post',
                      "posts_per_page" => '20',
                      'paged' => get_query_var('paged'),
                  )
              );
              if (have_posts()):
                while (have_posts()):the_post(); ?>
                  <?php
                  $yourTaxonomy = 'category'; // Задаем таксономию

                  $category = get_the_terms( $postId, $yourTaxonomy );
                  $useCatLink = false; // Делаем рубрики ссылками

                  if ($category){

                    $category_display = '';
                    $category_link = '';

                    if ( class_exists('WPSEO_Primary_Term') ) {

                      $wpseo_primary_term = new WPSEO_Primary_Term( 'event_cat', get_the_id() );
                      $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
                      $term = get_term( $wpseo_primary_term );

                      if (is_wp_error($term)) {

                        $category_display = $category[0]->name;
                        $category_link = get_bloginfo('url') . '/' . 'event-category/' . $term->slug;

                      } else {

                        $category_display = $term->name;
                        $category_link = get_term_link( $term->term_id );

                      }
                    }
                    else {

                      $category_display = $category[0]->name;
                      $category_link = get_term_link( $category[0]->term_id );

                    }
                    if ( !empty($category_display) ){

                      if ( $useCatLink == true && !empty($category_link) ){

                        $cat = '<a href="'.$category_link.'">'.$category_display.'</a>';

                      } else {

                        $cat = $category_display;

                      }
                    }
                  }
                  ?>
                  <li class="grid-item post format-">
                    <div class="grid-item-inner">
                      <?
                      $thumb_id = get_post_thumbnail_id();
                      $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
                      ?>
                      <a href="<? the_permalink() ?>" class="newsThumb" style="background-image: url(<?=$thumb_url[0]?>);"></a>
                        <div class="grid-content">
                        <h4><a href="<? the_permalink() ?>"><? the_title() ?></a></h4>
                        <span class="meta-data">
                          <span><i class="fa fa-calendar"></i><?the_time('d.m.Y');?></span>
                          <span><a href="#!"><i class="fa fa-tag"></i>
                              <?=$cat?>
                            </a></span></span>
                        <p><? the_excerpt()?></p>
                      </div>
                    </div>
                  </li>
                <? endwhile;?>
                </ul>
                <div class="col-md-12 text-center">
                  <?pagination();?>
                </div>
              <?else:?>
                <div class="col-md-12">
                  Новостей не найдено
                </div>
              <? endif; ?>
            </ul>
          </div>
        </div>
      </div>
      <? wp_reset_query(); ?>
    </div>
  </div>
<? get_footer(); ?>