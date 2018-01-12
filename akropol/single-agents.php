<?
get_header(); ?>
<?php while (have_posts()):the_post(); ?>
  <div class="main" role="main">
  <div id="content" class="content full">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList">
              <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a href="/" itemprop="item" class="home">
                  <span itemprop="name">Главная</span>
                </a>
              </span>
            <span class="sep"> / </span>
            <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a href="/agents/" itemprop="item">
                  <span itemprop="name">Наши агенты</span>
                </a>
              </span>
            <span class="sep"> / </span>
            <span class="current"><? the_title();?></span>
          </div>
          <?$query = new WP_Query(array("posts_per_page" => '-1','order'=> "DESC", 'orderby' => "date",'post_type'=>'objects','post_status'=>'publish', 'meta_query' => array(
              array(
                  'key' => 'agent',
                  'value' => get_the_ID(),
                  'type' => 'numeric',
                  'compare' => '=',
              )
          )));
          $count = 0;
          $arrID = array();
          while($query->have_posts()):$query->the_post();
            $count++;
            array_push($arrID, $query->post->ID);
          endwhile;wp_reset_postdata();
          ?>
          <div class="single-agent">
			<a href="#object-realtor">
				<div class="counts pull-right">
					<strong>
							<?=$count?>
						  </strong>
					<span>объектов</span>
				</div>
			</a>
            <h2 class="page-title"><? the_title() ?></h2>
            <div class="row">
              <?php
              if (!empty(get_the_post_thumbnail())) { ?>
                <div class="col-md-4 col-sm-4">
                  <?= get_the_post_thumbnail() ?>
                </div>
              <? } else { ?>
                <div class="col-md-4 col-sm-4">
                  <img src="<?=get_template_directory_uri()?>/images/default_agent1.png" alt="<? the_title() ?>"
                       class="img-thumbnail">
                </div>
                <?
              }
              ?>
              <div class="col-md-4 col-sm-6">
                <div class="agent-contact-details">
                  <h4>Контактные данные</h4>
                  <?php
                  /* Display Agent Contact/Social Details
                                   ==========================================*/
                  //Agent Contact Details
                  $userMobileNo = get_field("phone");
                  $user_position = get_field("position");
                  $user_email = get_field("email");
                  if (!empty($userMobileNo) || !empty($user_email) || !empty($user_position)) {
                    echo '<ul class="list-group">';
                    // Display Agent Mobile Number
                    if (!empty($user_position)) {
                      echo '<li class="list-group-item"> <span class="badge">' . $user_position . '</span> Должность </li>';
                    }
                    if (!empty($userMobileNo)) {
                      echo '<li class="list-group-item"> <span class="badge">' . $userMobileNo . '</span> Номер агента </li>';
                    }
                    // Display Agent Email Address
                    if (!empty($user_email)) {
                      echo '<li class="list-group-item"> <span class="badge">' . $user_email . '</span> Email</li>';
                    }

                    echo '</ul>';
                  } ?>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <?php if (!empty($user_email)) { ?>
                  <div class="agent-contact-form">
                    <h4>Форма обратной связи</h4>
                    <form method="post" id="agentcontactform" name="agentcontactform" class="agent-contact-form"
                          action="<?php echo get_template_directory_uri() ?>/mail/agent_contact.php">
                      <input type="email" id="email" name="Email Address" class="form-control"
                             placeholder="Ваш email адресс">
                      <textarea name="comments" id="comments" class="form-control"
                                placeholder="Введите письмо" cols="10" rows="5"></textarea>
                      <input type="hidden" value="" name="subject" id="subject">
                      <input type="hidden" name="image_path" id="image_path"
                             value="<?php echo get_template_directory_uri(); ?>">
                      <input id="agent_email" name="agent_email" type="hidden" value="<?php echo $user_email; ?>">
                      <p class="formObyaz">Нажимая «Отправить», вы <a href="/soglasie-na-obrabotku-personalnyih-dannyih"
                                                                      target="_blank">даёте своё согласие на обработку
                          персональных данных</a></p>
                      <button type="submit" class="btn btn-primary pull-right">Отправить</button>
                    </form>
                  </div>
                  <div class="clearfix"></div>
                  <div id="message"></div>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="spacer-20"></div>
          <!-- Start Related Properties -->
          <?php if($count > 0) {?>
            <h3 id="object-realtor">Объекты риэлтора</h3>
            <hr>
            <div class="property-grid">
              <ul class="col-3 owl-carousel owl-agents owl-theme">
                <?$query1 = new WP_Query(array(
                    'order'=> "DESC",
                    'orderby' => "date",
                    'post_type'=>'objects',
                    'post_status'=>'publish',
                    'post__in' => $arrID,
                    'posts_per_page' => -1
                ));

                ?>
                <?while($query1->have_posts()):$query1->the_post();
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
                  <li class="item">
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
                <?php endwhile;  wp_reset_postdata(); ?>
              </ul>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
<? endwhile; ?>
<? get_footer(); ?>