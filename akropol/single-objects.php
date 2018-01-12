<?
get_header(); ?>
  <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript" async defer></script>
<?php while (have_posts()):the_post(); ?>
  <div class="main" role="main">
  <div id="content" class="content full">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="single-property" itemscope="" itemtype="http://schema.org/Product">
            <span class="property_zoom_level" id="15"></span>
            <h1 class="property-title page-title"><?php echo get_the_title(); ?></h1>
             <div class="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList">
              <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a href="/" itemprop="item" class="home">
                  <span itemprop="name">Главная</span>
                </a>
              </span>
              <span class="sep"> / </span>
              <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a href="/objects-all/" itemprop="item">
                  <span itemprop="name">Объекты</span>
                </a>
              </span>
              <span class="sep"> / </span>
              <?
              $true_taxonomy = 'object_category'; // таксономия - регион
              $true_terms = wp_get_post_terms($post->ID, $true_taxonomy, array("fields" => "ids")); // вытаскиваем ID элементов, присвоенных посту
              if ($true_terms) {
                $term_array = trim(implode(',', (array)$true_terms), ' ,');
                $neworderterms = get_terms($true_taxonomy, 'orderby=none&include=' . $term_array);
                foreach ($neworderterms as $orderterm) {
                  echo '<span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a href="' . get_term_link($orderterm) . '"><span itemprop="name">' . $orderterm->name . '</span></a></span><span class="sep"> / </span>';
                }
              }
              ?>
              <span class="current"><? the_title();?></span>
              </div>
                <? $map = get_field("map"); ?>
                <div id="property<?= get_the_ID() ?>" style="display:none;">
                <span class="property_address"><? the_field("address") ?></span>
                <!-- цена -->
				<?php
					/*$all_the_tags = get_the_terms($post->ID, 'tags_object');
					if( $all_the_tags ){
						foreach($all_the_tags as $this_tag) {
							if ($this_tag->slug == "novostroyka" ) {
								echo '<span class="property_price"><span>от ' . the_field("price") . '</span><strong>руб.</strong></span>';
							} 
							else {
								echo '<span class="property_price"><span>' . the_field("price") . '</span><strong>руб.</strong></span>';
							}
						}
					}*/
				?>
                <span class="property_price"><span><? the_field("price") ?></span><strong>руб.</strong></span>
                <span class="latitude"><?= $map["lat"] ?></span>
                <span class="longitude"><?= $map["lng"] ?></span>
                <span
                    class="property_image_map"><? $src = wp_get_attachment_image_src(get_post_thumbnail_id(), '150-100-size');
                  echo $src[0]; ?></span>
                    <span class="property_url"><? the_permalink(); ?></span>
                    <span class="property_image_url"><?= get_template_directory_uri() ?>/images/map-marker.png</span>
              </div>
              
              <a class="accent-color" style="cursor:default; text-decoration:none;"><span class="location"><i
                      class="fa fa-map-marker"></i>
                  <?
                  $true_taxonomy = 'district'; // таксономия - регион
                  $true_terms = wp_get_post_terms($post->ID, $true_taxonomy, array("fields" => "ids")); // вытаскиваем ID элементов, присвоенных посту
                  if ($true_terms) {
                    $term_array = trim(implode(',', (array)$true_terms), ' ,');
                    $neworderterms = get_terms($true_taxonomy, 'orderby=none&include=' . $term_array);
                    $i = 1;
                    foreach ($neworderterms as $orderterm) {
                      if ($i !== 1) echo ", ";
                      echo $orderterm->name;
                      $i = 0;
                    }
                  }
                  $true_taxonomy = 'object_category'; // таксономия - регион
                  $true_terms = wp_get_post_terms($post->ID, $true_taxonomy, array("fields" => "ids")); // вытаскиваем ID элементов, присвоенных посту
                  if ($true_terms) {
                    $term_array = trim(implode(',', (array)$true_terms), ' ,');
                    $neworderterms = get_terms($true_taxonomy, 'orderby=none&include=' . $term_array);
                    $cat = '';
                    $ot = '';
                    if (!empty($neworderterms)) {
                      foreach ($neworderterms as $term) {
                        if ($term->term_id == 159) {
                          $ot = "от ";
                        }
                      }
                    }
                    if (!empty($neworderterms)) {
                      foreach ($neworderterms as $term) {
                        if ($term->term_id == 39) {
                          $cat = "Продажа";
                          break;
                        } elseif ($term->term_id == 40) {
                          $cat = "Аренда";
                          break;
                        }
                      }
                    }
                  }
                  ?>
                      </span></a>
              <span itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                <span itemprop="price">
                  <div class="price">
                    <span class=""><?=$ot?><?= number_format(get_field("price"), 0, ',', ' ') ?></span>
                    <strong>руб.</strong>
                  </div>
                </span>
                <span itemprop="priceCurrency" content="RUB"></span>
              </span>
              <span style="display: none;" itemprop="name"><? the_title() ?></span>
              <div class="price"><span
                    class=""><?= number_format(round(get_field("price") / get_field("square")), 0, ',', ' ') ?></span><strong>руб. за м<sup>2</sup></strong></div>
              <a data-target="#yourPriceModal" data-toggle="modal"
                 class="btn a--yourPriceModal">Предложите свою цену</a>

                <? if (!empty(get_field("square")) || !empty(get_field("rooms")) || !empty(get_field("floor")) || !empty(get_field("all_floor"))) {
                  ?>
                  <div class="property-amenities clearfix"><?
                  if ($cat !== '') { ?>
                    <span class="area"><strong><i class="fa fa-home" aria-hidden="true"></i></strong><text> </text><?php echo $cat; ?></span>
                  <? }
                  if (!empty(get_field("square"))) {
                    echo '<span class="area">Площадь<text>: </text><strong>' . get_field("square") . '<text> м<sup>2</sup></text></strong></span>';
                  }
                  if (!empty(get_field("rooms"))) {
                    echo '<span class="rooms">Комнат<text>: </text><strong>' . get_field("rooms") . '</strong></span>';
                  }

                  if (!empty(get_field("floor"))) {
                    echo '<span class="storey">Этаж<text>: </text><strong>' . get_field("floor") . '</strong></span>';
                  }

                  if (!empty(get_field("all_floor"))) {
                    echo '<span class="storeys">Этажей<text>: </text><strong>' . get_field("all_floor") . '</strong></span>';
                  }
                  ?></div><?
                } ?>
                <div class="property-slider">
                  <?php $field = get_post_meta(get_the_ID(), 'multiupload', true); ?>
                  <? if (!empty($field) && !(count($field) === 1 && $field[0] === "http://placehold.it/100x100")) { ?>
                    <div id="property-images" class="flexslider">
                      <ul class="slides">
                          <? foreach ($field as $key => $imgurl) { ?>
                           	<? $id = get_attachment_id_by_url($imgurl); ?>
                            <? $image = wp_get_attachment_image_src($id, '1042-auto-size', ''); ?>
                            <li class="item">
								<img src="<?= $image[0] ?>"
								title="<?php echo get_the_title($id); ?>"
								alt="<?php echo get_the_title(); echo ' &mdash; '; echo get_the_title($id); ?>"
								itemprop="image">
                            </li>
                            <?
                          } ?>
                        </ul>
                      </div>
                          <? if (count($field) > 1) { ?>
                      <div id="property-thumbs" class="flexslider">
                      <ul class="slides">
                                      <? foreach ($field as $key => $imgurl) { ?>
                                        <? $id = get_attachment_id_by_url($imgurl); ?>
                                        <? $image = wp_get_attachment_image_src($id, '600-400-size', ''); ?>
                                        <li class="item"><img src="<?= $image[0] ?>" alt="" itemprop="image"></li>
                                        <?
                                      } ?>
                                    </ul>
                      </div><?php } ?>
                  <? } else {
                    echo get_the_post_thumbnail(get_the_ID(), '600-400-size');
                  } ?>
                  </div>
										<?/*$args = array(
											'post_parent' => $post->ID,
											'post_type' => 'attachment',
											'orderby' => 'menu_order', // сортировка, menu_order - по выставленному в админке порядку, можно также сортировать по имени или дате добавления 
											'order' => 'ASC',
											'numberposts' => 999, // количество выводимых изображений
											'post_mime_type' => 'image'
										);
										if ( $images = get_children( $args ) ) {
											// если никаких изображений в пост не добавлено, то не выводим вообще ничего
											echo '<div id="sliderbody"><div id="slider">';
													foreach( $images as $image ) {
														echo wp_get_attachment_image( $image->ID, 'trueslider' );
													}
											echo '</div></div>'; 
										}*/?>
                  <div class="header_line_ipoteka"><a onclick="yaCounter38924025.reachGoal('To-Mortgage'); return true;"
                                                      target="_blank"
                                                      href="https://unicom24.ru/ipoteka_v3/?key=wzxbhapuprsmbvkhjbnshzhuixbtdzpc&price=<?php
                                                      if (get_field("price") != "") {
                                                        echo get_field("price");
                                                      } else {
                                                        echo "2000000";
                                                      }
                                                      ?>&build=<?php
                                                      $terms = get_the_terms($post->ID, 'object_category');
                                                      if ($terms) {
                                                        $term = array_shift($terms);
                                                        if ($term->slug == 'kvartiry-v-novostroykakh') {
                                                          echo "квартира%20в%20строящейся%20новостройке";
                                                        } elseif ($term->slug == 'kvartiry-vtorichnyye') {
                                                          echo "квартира%20на%20вторичном%20рынке";
                                                        } elseif ($term->slug == 'ground-area') {
                                                          echo "земельный%20участок";
                                                        } elseif ($term->slug == 'house') {
                                                          echo "дом,%20дача";
                                                        } elseif ($term->slug == 'room') {
                                                          echo "доля%20в%20квартире";
                                                        }
                                                      }
                                                      ?>&photo=<?php the_post_thumbnail_url(); ?>">Выбери лучшее предложение по ипотеке!</a>
                  </div>
					<div class="row">
						<div class="col-md-8">
							<div class="tabs agentWrap">

								<div class="property-description tab-content descr-tab-contant">
									<div id="description" class=" tab-pane active" itemprop="description">
										<h2 class="descrObj">Описание объекта недвижимости</h2>
										<?php the_content(); ?>
									</div>

									<div id="address">
										<strong>Адрес объекта:</strong>
										<?the_field("address")?>
									</div>
									<div>
										<?$NovostroykaId = get_field("novostroyka");?>
										<?$NovostroykaName = get_the_title($NovostroykaId);?>
										<?if(!empty($NovostroykaId)) {?>
											<strong>Новостройка:</strong>
											<a href="/object_category/sale/?novostroy%5B%5D=<?=$NovostroykaId?>">
												<?=$NovostroykaName?>
											</a>
										<?}?>
									</div>
									<a class="a--naProsmotr" data-target="#naProsmotrModal" data-toggle="modal">Записаться на просмотр</a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<?$agentId = get_field("agent");?>
								<div class="agentWrap">
									<h3>Риэлтор АН «Акрополь»</h3>
									<?php $userMobileNo = get_field("phone", $agentId); ?>
									<div class="row">

										<div class="col-md-6">
											<?php
											$thumb_id = get_post_thumbnail_id($agentId);
											$agent_image = wp_get_attachment_image_src($thumb_id,'full', true);
											$userName = get_the_title($agentId);
											$description = get_the_content($agentId);
											if (!empty($agent_image)) { ?>
												<img src="<? echo $agent_image[0]; ?>">
											<?php } else {?>
												<img src="<?=get_template_directory()?>/images/default_agent.png">
											<? } ?>
										</div>
										<div class="col-md-6">
											<h3 class="agentName">
												<a href="<?=get_permalink($agentId)?>">
													<?php echo $userName; ?>
												</a>
											</h3>
											<div class="user-info new-user-info">
												<?php $email_agent = get_field('email', $agentId);
												if (!empty($email_agent)) {
													echo '<a href=mailto:'. esc_html($email_agent) .'>'. esc_html($email_agent) .'</a>';
												} ?>
											</div>
											<a data-target="#agentmodal" data-toggle="modal" class="btn btn-primary pull-right btn-sm newSendAgent">Отправить письмо</a>
										</div>
										<div class="col-md-12">
											<div class="contact-info">
												<div class="user-info agentPhoneHover">
													<span>Показать телефон</span><br>
													<span class="agentPhoneHover--phone">
													<div class="fa fa-phone"></div>
													8 (9XX) XXX-XX-XX</span>
												</div>
												<div class="user-info agentPhone text-center" style="display: none;">
													<div class="fa fa-phone"></div>
													<?php if (!empty($userMobileNo)) {
																																echo esc_html($userMobileNo);
																															  } ?>
												</div>
											</div>
										</div>


									</div>
								</div>
						</div>
					</div>
            </div>
          <?php
          $property_category = get_the_term_list($post->ID, 'object_category', '<li class="property-type">', ', ', '</li>');
          $property_tags = get_the_term_list($post->ID, 'tags_object', '<li class="property-tag">', ', ', '</li>');

          if( is_string( $property_category ) || is_string( $property_tags ) ) {
            echo '<div class="type-tag">';

            if( is_string( $property_category ) )
              echo '<div>Категории:</div><ul>' . $property_category . '</ul>';
            unset( $property_category );

            if( is_string( $property_tags ) )
              echo '<div>#Теги:</div><ul>' . $property_tags . '</ul>';
            unset( $property_tags );

            echo '</div>';
          }
          ?>
            <div class="site-showcase">
              <!-- Start Page Header -->
              <div class="clearfix map-single-page" id="onemap"></div>
              <!-- End Page Header -->
              <!-- Start Related Properties -->
              <div id="related-properties-block">
                <?$property_type = get_the_terms($post->ID, 'object_category');?>
                <?$slug = array();?>
                <?foreach($property_type as $type) {
                  array_push($slug, $type->slug);
                } ?>
                <?php query_posts(
                    array(
                    'post_type' => 'objects',
                    'post_status' => 'publish',
                    'tax_query' => array(
                    array(
                        'taxonomy' => 'object_category',
                        'field' => 'slug',
                        'terms' => $slug
                    )),
                    'posts_per_page' => 3,
                        'post__not_in' => array($post->ID)
                    )
                );
                if ($wp_query->post_count != 0) { ?>
                  <h3>Похожие объекты</h3>
                  <hr>
                  <div class="property-grid">
                    <ul class="grid-holder col-3">
                      <?php if (have_posts()):while (have_posts()):the_post();
                        $total_images = 0; ?>
                        <? $field = get_post_meta(get_the_ID(), 'multiupload', true); ?>
                        <? if (!empty($field) && !(count($field) === 1 && $field[0] === "http://placehold.it/100x100")) { ?>
                          <? $total_images = count($field); ?>
                        <? } ?>
                        <? $true_taxonomy = 'object_category'; // таксономия - регион
                        $true_terms = wp_get_post_terms($post->ID, $true_taxonomy, array("fields" => "ids")); // вытаскиваем ID элементов, присвоенных посту
                        if ($true_terms) {
                          $term_array = trim(implode(',', (array)$true_terms), ' ,');
                          $neworderterms = get_terms($true_taxonomy, 'orderby=none&include=' . $term_array);
                          //foreach ($neworderterms as $orderterm) {
                          //echo '<span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a href="' . get_term_link($orderterm) . '"><span itemprop="name">' . $orderterm->name . '</span></a></span><span class="sep"> / </span>';
                          //}
                        }
                        $cat = '';
                        $ot = '';
                        if (!empty($neworderterms)) {
                          foreach ($neworderterms as $term) {
                            if ($term->term_id == 159) {
                              $ot = "от ";
                            }
                          }
                        }
                        if (!empty($neworderterms)) {
                          foreach ($neworderterms as $term) {
                            if ($term->term_id == 39) {
                              $cat = "Продажа";
                              break;
                            } elseif ($term->term_id == 40) {
                              $cat = "Аренда";
                              break;
                            }
                          }
                        }
                        ?>
                        <? $map = get_field("map");
                        ?>
                        <li class="grid-item type">
                          <div class="property-block">
                            <a href="<?php the_permalink(); ?>"
                               class="similar-property property-featured-image">
                              <?php the_post_thumbnail('600-400-size'); ?>
                              <span class="images-count">
                                                                <i class="fa fa-picture-o"></i>
                                <?php echo $total_images; ?>
                                                            </span>
                              <?php if ($cat != "") { ?>
                                <span
                                    class="badges"><?php echo $cat; ?></span>
                              <?php } ?>
                            </a>
                            <div class="property-info">
                              <h4>
                                <a href="<?php the_permalink(); ?>"><?php the_field("address") ?></a>
                              </h4>
                              <a class="accent-color" style="cursor:default; text-decoration:none;"><span class="location"><i
                                      class="fa fa-map-marker"></i>
                                  <?
                                  $true_taxonomy = 'district'; // таксономия - регион
                                  $true_terms = wp_get_post_terms($post->ID, $true_taxonomy, array("fields" => "ids")); // вытаскиваем ID элементов, присвоенных посту
                                  if ($true_terms) {
                                    $term_array = trim(implode(',', (array)$true_terms), ' ,');
                                    $neworderterms = get_terms($true_taxonomy, 'orderby=none&include=' . $term_array);
                                    $i = 1;
                                    foreach ($neworderterms as $orderterm) {
                                      if ($i !== 1) echo ", ";
                                      echo $orderterm->name;
                                      $i = 0;
                                    }
                                  }
                                  ?>
                              </span></a>

                              <?php if (get_field("price") != "") {?>
                                <div class="price"><span class=""><?=$ot?><?echo  number_format(get_field("price"), 0, ',', ' ');?></span><strong>руб.</strong></div>
                              <? } ?>
                            </div>
                            <? if (!empty(get_field("square")) || !empty(get_field("rooms")) || !empty(get_field("floor")) || !empty(get_field("all_floor"))) {
                              ?><div class="property-amenities clearfix"><?


                              if (!empty(get_field("square"))) {
                                echo '<span class="area">Площадь<text>: </text><strong>' . get_field("square") . '<text> м<sup>2</sup></text></strong></span>';
                              }
                              if (!empty(get_field("rooms"))) {
                                echo '<span class="rooms">Комнат<text>: </text><strong>' . get_field("rooms") . '</strong></span>';
                              }

                              if (!empty(get_field("floor"))) {
                                echo '<span class="storey">Этаж<text>: </text><strong>' . get_field("floor") . '</strong></span>';
                              }

                              if (!empty(get_field("all_floor"))) {
                                echo '<span class="storeys">Этажей<text>: </text><strong>' . get_field("all_floor") . '</strong></span>';
                              }

                            } ?>
                          </div>
                          </div>
                        </li>
                      <?php endwhile; endif;
                      wp_reset_query(); ?>
                    </ul>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<? endwhile; ?>
<? get_footer(); ?>