<?
/**
 * Template Name: Главная
 * @package WordPress
 */

get_header(); ?>
	<div class="site-showcase">
		<div class="owl-carousel owl-theme owl-loaded mainCarousel">
			<div>
				<a href="http://tvoyanovostroyka.ru/" target="_blank">
					<div class="owl-item1" style="background-image:url('wp-content/uploads/2017/11/banner-strahovka.jpg');"></div>
					
				</a>
			</div>
			<!--<div>
				<a href="/katalog-novostroek">
					<div class="owl-item1" style="background-image:url('wp-content/uploads/2017/06/novostroika.jpg');"></div>

				</a>
			</div>
			<div>
				<a href="/pokupka-v-ipoteku">

					<div class="owl-item1" style="background-image:url('/wp-content/uploads/2017/06/ipoteka.jpg');"></div>
				</a>
			</div>
			<div>
				<a data-target="#consultModal" data-toggle="modal">

					<div class="owl-item1" style="background-image:url('/wp-content/themes/akropol/images/dreams.jpg');"></div>
				</a>
			</div>-->
		</div>
		<div class="main" role="main">
			<div id="content" class="content full">
				<div class="featured-blocks">
					<div class="container">
						<div class="row">
							<a href="http://akropol69.ru/katalog_novostroek/">
								<div class="col-md-4 col-sm-4 col-xs-6 featured-block"><img width="365" height="365" src="/wp-content/uploads/2016/07/New-building-365x365.jpg" class="attachment-365-365-size size-365-365-size" alt="Новостройки, новые жилые дома, купить">
									<h3>Новостройки</h3>
								</div>
							</a>
							<a href="/object_category/sale/kvartira-sale/">
								<div class="col-md-4 col-sm-4 col-xs-6 featured-block"><img width="365" height="365" src="/wp-content/uploads/2017/03/kvartiry-365x365.jpg" class="attachment-365-365-size size-365-365-size" alt="">
									<h3>Квартиры</h3>
								</div>
							</a>
							<a href="/object_category/sale/room/">
								<div class="col-md-4 col-sm-4 col-xs-6 featured-block"><img width="365" height="365" src="/wp-content/uploads/2016/07/Apartments-and-Rooms-365x365.jpg" class="attachment-365-365-size size-365-365-size" alt="Квартиры и комнаты, Квартира, комната, купить, риэлтор, агенство недвижимости">
									<h3>Комнаты</h3>
								</div>
							</a>
							<a href="/object_category/sale/house/">
								<div class="col-md-4 col-sm-4 col-xs-6 featured-block"><img width="365" height="365" src="/wp-content/uploads/2016/07/Houses-and-Land-365x365.jpg" class="attachment-365-365-size size-365-365-size" alt="Дома и земельные участки, дом, участок, земля, купить">
									<h3>Дома, коттеджи, таунхаусы, дачи</h3>
								</div>
							</a>
							<a href="/object_category/sale/ground-area-sale/">
								<div class="col-md-4 col-sm-4 col-xs-6 featured-block"><img width="365" height="365" src="/wp-content/uploads/2016/12/zemelnyy-uchastok-365x365.jpg" class="attachment-365-365-size size-365-365-size" alt="">
									<h3>Земельные участки</h3>
								</div>
							</a>
							<a href="/object_category/sale/commerce-sale/">
								<div class="col-md-4 col-sm-4 col-xs-6 featured-block"><img width="365" height="365" src="/wp-content/uploads/2017/03/26-2-365x365.jpg" class="attachment-365-365-size size-365-365-size" alt="">
									<h3>Коммерческая недвижимость</h3>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="spacer-40"></div>
				<div class="container">
					<div class="row">
						<div class="property-columns" id="latest-properties">
							<div class="col-md-12">
								<div class="block-heading">
									<h4><span class="heading-icon"><i
                    class="fa fa-caret-right icon-design"></i><i class="fa fa-leaf"></i></span>Недавно добавленные
									</h4>
								</div>
							</div>
							<ul>
								<? query_posts(array('post_type' => 'objects', 'post_status' => 'publish', 'posts_per_page' => 6));

          if (have_posts()):while (have_posts()):the_post();
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
															<li class="grid-item type col-md-4 col-sm-6">
																<div class="property-block">
																	<a href="<?php the_permalink(); ?>" class="similar-property property-featured-image">
																		<?php the_post_thumbnail('600-400-size'); ?>
																		<span class="images-count">
                                                                <i class="fa fa-picture-o"></i>
                    <?php echo $total_images; ?>
                                                            </span>
																		<?php if ($cat != "") { ?>
																		<span class="badges"><?php echo $cat; ?></span>
																		<?php } ?>
																	</a>
																	<div class="property-info">
																		<h4>
																			<a href="<?php the_permalink(); ?>">
																				<?php the_title() ?>
																			</a>
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

																		<?php if (get_field("price") != "") { ?>
																		<div class="price"><span class=""><?=$ot?><? echo number_format(get_field("price"), 0, ',', ' '); ?></span><strong>руб.</strong>
																		</div>
																		<? } ?>
																	</div>
																	<? if (!empty(get_field("square")) || !empty(get_field("rooms")) || !empty(get_field("floor")) || !empty(get_field("all_floor"))) {
                ?>
																		<div class="property-amenities clearfix">
																			<?


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
															<? endwhile; endif;
          wp_reset_query(); ?>
							</ul>
						</div>
					</div>
				</div>
				<div id="featured-properties">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="block-heading">
									<h4><span class="heading-icon"><i
                    class="fa fa-caret-right icon-design"></i><i class="fa fa-leaf"></i></span>Горячая недвижимость
									</h4>
								</div>
							</div>
						</div>
						<? query_posts(array('post_type' => 'objects', 'post_status' => 'publish', 'posts_per_page' => -1,'meta_query' => array(
          array(
              'key' => 'hot',
              'value' => 1,
              'type' => 'binary',
              'compare' => '=',
          )
      )));
      if (have_posts()):
      echo '
      <div class="row">' ?>

							<ul class="owl-carousel owl-properties col-md-12">
								<?while (have_posts()):the_post();
  $total_images = 0; ?>
									<? $field = get_post_meta(get_the_ID(), 'multiupload', true); ?>
										<? if (!empty($field) && !(count($field) === 1 && $field[0] === "http://placehold.it/100x100")) { ?>
											<? $total_images = count($field); ?>
												<? } ?>
													<li class="item property-block">
														<?if (has_post_thumbnail()):
    echo '<a href="' . get_permalink() . '" class="property-featured-image">';
    the_post_thumbnail('365-365-size');
    echo '<span class="images-count"><i class="fa fa-picture-o"></i> ' . $total_images . '</span>';
  $true_taxonomy = 'object_category'; // таксономия - регион
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
    } if ($cat != "") { ?>
															<span class="badges"><?php echo $cat; ?></span></a>
															<?php }

  endif;?>

															<div class="property-info">
																<h4>
																	<a href="<?php the_permalink(); ?>">
																		<?php the_title() ?>
																	</a>
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
													</li>
													<?endwhile;
echo '</ul></div>';
endif;
wp_reset_query();
?>
					</div>
				</div>
				<div class="padding-tb45 bottom-blocks">
					<div class="container">
						<div class="row">
							<div id="pl-223" class="panel-layout">
								<div id="pg-223-0" class="panel-grid panel-no-style">
									<div id="pgc-223-0-0" class="panel-grid-cell">
										<div id="panel-223-0-0-0" class="so-panel widget widget_sow-editor panel-first-child panel-last-child" data - index="0">
											<div class="col-md-12 features-list panel-widget-style panel-widget-style-for-223-0-0-0">
												<div class="so-widget-sow-editor so-widget-sow-editor-base">
													<div class="siteorigin-widget-tinymce textwidget">
														<ul>
															<li class="cust-icon-box">
																<div class="icon icon-h1">
																	<i class="fa fa-building" aria - hidden="true"></i >
                                </div >
                                <div class="text" >
                                  <h1 > Агентство недвижимости «Акрополь» </h1 >
                                  <p > Хотите продать или купить недвижимость ? Ищете реальную цену за свой объект ? Устали
    от бесконечных просмотров и бессмысленных звонков ? Тогда пришло время обратиться за
                                    помощью к профессионалам!</p >
                                  <p > Агентство «Акрополь» быстро и эффективно решит все ваши проблемы, связанные с
                                    приобретением, отчуждением, сдачей внаём недвижимости . Приоритеты компании —
                                    оперативность, безопасность и компетентность .</p ></div >
                              </li >
                              <li class="cust-icon-box" >
                                <div class="icon" >
                                  <i class="fa fa-star" aria - hidden = "true" ></i >
                                </div >
                                <div class="text" >
                                  <h2 > Почему именно «Акрополь» ?</h2 >
                                  <p > Агентство недвижимости «Акрополь» — это опытная компания, профессионально
                                    занимающаяся сопровождением аренды, покупки и продажи любых объектов в Твери . С нами
                                    работают профессиональные агенты, которые уделяют максимум внимания своим объектам и
                                    направлениям .</p >
                                  <p > На сайт недвижимости стекаются интересные предложения, прошедшие предварительную
                                    селекцию . Широкие возможности позволяют нам проверить «чистоту» объекта, установить
                                    возможные нюансы предстоящей сделки .</p ></div >
                              </li >
                              <li class="cust-icon-box" >
                                <div class="icon" >
                                  <i class="fa fa-list-ol" aria - hidden = "true" ></i >
                                </div >
                                <div class="text" >
                                  <h2 > 4 причины работать с компанией «Акрополь» </h2 >
                                  <ol style = "border-top: none; margin: 0; padding: 0; padding-left: 16px;" >
                                    <li > Компетентность . Мы отлично разбираемся в особенностях своего труда, поэтому
                                      гарантируем клиентам правильное выполнение всех процедур .
                                    </li >
                                    <li > Оперативность . Компания «Акрополь» стремится завершить сделку так быстро,
                                      насколько это возможно, не в ущерб её качеству .
                                    </li >
                                    <li > Реальная экономия . Работая с нами, вы сохраните своё время и сбережёте нервы,
                                      сможете установить рыночную цену объекта .
                                    </li >
                                    <li > Ответственность . Мы в ответе за своих риэлторов и совершаемые ими действия, а
                                      отношения с клиентами закрепляются договорами .
                                    </li >
                                  </ol >
                                  <p > Агентство недвижимости «Акрополь» следует современным тенденциям, стремясь
                                    предугадать потребности рынка . У нас вы найдёте сведения о новостройках, новости
                                    отрасли, получите ценную информацию интересующей тематики .</p ></div >
                              </li >
                              <li class="cust-icon-box" >
                                <div class="icon" >
                                  <i class="fa fa-list-ul" aria - hidden = "true" ></i >
                                </div >
                                <div class="text" >
                                  <h2 > Компания «Акрополь» занимается всеми направлениями деятельности </h2 >
                                  <ul style = "list-style-type: disc; border-top: none; margin: 0; padding: 0; padding-left: 16px;" >
                                    <li >Новостройки. Предлагаем <a
                                          href = "http://akropol69.ru/katalog_novostroek/" > купить новую квартиру в
                                        Твери </a > в ведущих ЖК по привлекательным ценам .
                                    </li >
                                    <li >Вторичные квартиры.
                                      Жильё от собственников в различных районах города отлично подходит для быстрого
										переезда (<a href="http://akropol69.ru/pokupka-i-prodazha-kvartir/">каталог квартир</a>).
                                    </li >
                                    <li >Комнаты.
                                      Доли в праве собственности заинтересуют молодые семьи, которые только начинают
                                      совместную жизнь .
                                    </li >
                                    <li >Дома,
                                        коттеджи, таунхаусы, дачи. Мы поможем купить <a href = "http://akropol69.ru/pokupka-doma-kottedzha-taunxausa-dachi/" >дом в Твери</a > в черте города либо
                                      за его границами, подберём объект нужной этажности, планировки .
                                    </li >
                                    <li >Земельные
                                        участки. На предложении есть интересные варианты под строительство
                                      собственного жилья, дачи .
                                    </li >
                                    <li >Коммерческая
                                        недвижимость. Отдельное направление работы — поиск предложений для аренды и
                                      продажи магазинов, офисов, павильонов и аналогичных объектов .
                                    </li >
                                  </ul >
                                </div >
                              </li >
                              <li class="cust-icon-box" >
                                <div class="icon" >
                                  <i class="fa fa-phone" aria - hidden = "true" ></i >
                                </div >
                                <div class="text" >
                                  <h2 > С чего начинается работа ?</h2 >
                                  <p > Наше агентство недвижимости в Твери провело предварительную подготовку и выбрало
                                    для вас интересные предложения по интересующим направлениям . Вы можете подыскать
                                    конкретный вариант и связаться с нами, чтобы договориться о просмотре, получить
                                    дополнительную информацию .</p >
                                  <p > Или обратитесь напрямую в наш офис, свяжитесь с риэлторами, которые подберут для
                                    вас другие предложения по интересующему направлению . Взаимоотношения закрепляются
                                    договором, поэтому ваши права — надёжно защищены .</p ></div >
                              </li >
                              <li class="cust-icon-box" >
                                <div class="icon" >
                                  <i class="fa fa-info" aria - hidden = "true" ></i >
                                </div >
                                <div class="text" >
                                  <h2 > Мы решаем все проблемы своего клиента </h2 >
                                  <ol style = "border-top: none; margin: 0; padding: 0; padding-left: 16px;" >
                                    <li > Проверка «чистоты» . Независимо от интересующей услуги(покупка, аренда),
                                      специалисты проверят отсутствие обременений, споров вокруг квартиры, дома .
                                    </li >
                                    <li > Выявление потенциальных неприятностей . В процессе работы мы подскажем клиенту,
                                      стоит ли связываться с тем или иным вариантом, насколько оправдан риск .
                                    </li >
                                    <li > Установление рыночной цены . Как покупатели, так и продавцы смогут узнать,
                                      сколько в действительности стоит их объект .
                                    </li >
                                    <li > Правовое сопровождение и обеспечение . Сотрудники подготовят предварительный и
                                      основной договор, помогут оформить отчуждение и приобретение права на
                                      недвижимость .
                                    </li >
                                  </ol >
                                  <p > Не теряйте времени: позвоните нам как можно скорее или посетите офис . Мы готовы
                                    работать с вами!</p >
                                  <h2 > Остались вопросы ? Оставьте заявку и мы перезвоним вам!</h2 >
                                  <blockquote >
                                    <div style = "overflow: auto;" ><span style = "float: left; margin: 0;" ><i
                                            class="fa fa-none" style = "float: left;" ></i > <a class="btn btn-callback"
                                                                                            style = "float: left; margin: 0;"
                                                                                            data - target = "#wannaaskmodal"
                                                                                            data - toggle = "modal" > Задать вопрос </a ></span ><span
                                          style = "font-size: 21px; margin-left: 15px; line-height: 37px; float: left;" > 48 - 30 - 03 | 64 - 07 - 79 </span >
                                    </div >
                                  </blockquote >
                                </div >
                              </li >
                            </ul >
                          </div >
                        </div >
                      </div >
                    </div >
                  </div >
                </div >
              </div >
              <div class="col-md-5 widget latest_news column" ></div >
            </div >
          </div >
        </div >
      </div >
    </div >
  </div >

<? get_footer(); ?>
<? get_footer(); ?>
