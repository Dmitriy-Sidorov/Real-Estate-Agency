<?
get_header(); ?>
<?php while (have_posts()):the_post(); ?>
  <div class="main" role="main">
  <? $field = get_post_meta(get_the_ID(), 'multiupload', true); ?>
  <? if (!empty($field) && !(count($field) === 1 && $field[0] === "http://placehold.it/100x100")) { ?>
    <div class="site-showcase">
      <? if (count($field) > 1) { ?>
        <div class="page-header-absolute page-header">
          <div class="header-h1">
            <h1><? the_title() ?></h1>
          </div>
        </div>
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
  <div id="content" class="content full">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <? $stoimost = get_field("cost"); ?>
          <? $sdacha = get_field("sroki"); ?>
          <? $ipoteka = get_field("ipoteka"); ?>
          <? $video = get_field("video"); ?>
          <? $infrastruktura = get_field("infrastruktura"); ?>
          <? $fond = get_field("fond"); ?>

          <div class="nav-lending">
            <nav class="navigation novostroyNav">
              <ul id="menu-second-menu" class="sf-menu sf-js-enabled">
                  <li><a href="#stoimost">Стоимость квартир</a></li>
                
                <? if ($sdacha != "") {?>
                  <li><a href="#sdacha">Сроки сдачи домов</a></li>
                <?}?>
                <? if ($ipoteka != "") {?>
                  <li><a href="#ipoteka">Ипотека</a></li>
                <?}?>
                <? if ($infrastruktura != "") {?>
                  <li><a href="#infrastruktura">Инфраструктура</a></li>
                <?}?>
                <li><a href="/katalog_novostroek">Другие новостройки</a></li>
              </ul>
            </nav>
          </div>
					<div class="lending-page">
            <p>
              <? the_content() ?>
            </p>
            <? include get_template_directory() . "/include/prosmotr.php"; ?>
						
						<div class="list-link-property">
                <div id="stoimost">
								<h2>Стоимость квартир</h2>
					
					<?$query = new WP_Query(array('post_type'=>'objects','post_status'=>'publish', "posts_per_page" => '-1','meta_query' => array(
              array(
                  'key' => 'novostroyka',
                  'value' => get_the_ID(),
                  'type' => 'numeric',
                  'compare' => '=',
              )
          )));
          $arrS = array();
					$minPriceS = 9999999999;
					$minAreaS = 9999999999;
					$arr1 = array();
					$minPrice1 = 9999999999;
					$minArea1 = 9999999999;
          $arr2 = array();
					$minPrice2 = 9999999999;
					$minArea2 = 9999999999;
          $arr3 = array();
					$minPrice3= 9999999999;
					$minArea3= 9999999999;
          $arr4 = array();
					$minPrice4= 9999999999;
					$minArea4= 9999999999;
          $arr5 = array();
					$minPrice5= 9999999999;
					$minArea5= 9999999999;
          $ids = 0;
          $id1 = 0;
          $id2 = 0;
          $id3 = 0;
          $id4 = 0;
          $id5 = 0;
          while($query->have_posts()):$query->the_post();
            $post_meta = get_post_meta( $query->post->ID, "" );
						//echo (int)$post_meta['rooms'][0];
						/* STUDY */
						if (strtolower($post_meta['rooms'][0]) === 'студия') {
							if((int)$post_meta["price"][0] < (int)$minPriceS) {
								$minPriceS = $post_meta["price"][0];
							}
							if((float)$post_meta["square"][0] < (float)$minAreaS) {
								$minAreaS = $post_meta["square"][0];
                $ids = $query->post->ID;
							}
							array_push($post_meta, $query->post->ID);
							array_push($arrS, $post_meta);
						}
						/* 1 rooms */
						if ((int)$post_meta['rooms'][0] == 1) {
							if((int)$post_meta["price"][0] < (int)$minPrice1) {
								$minPrice1 = $post_meta["price"][0];
							}
							if((float)$post_meta["square"][0] < (float)$minArea1) {
								$minArea1 = $post_meta["square"][0];
                $id1 = $query->post->ID;
							}
							array_push($post_meta, $query->post->ID);
							array_push($arr1, $post_meta);
						}
						/* 2 rooms */
						if ((int)$post_meta['rooms'][0] == 2) {
							if((int)$post_meta["price"][0] < (int)$minPrice2) {
								$minPrice2 = $post_meta["price"][0];
							}
							if((float)$post_meta["square"][0] < (float)$minArea2) {
								$minArea2 = $post_meta["square"][0];
                $id2 = $query->post->ID;
							}
							array_push($post_meta, $query->post->ID);
							array_push($arr2, $post_meta);
						}
						/* 3 rooms */
						if ((int)$post_meta['rooms'][0] == 3) {
							if((int)$post_meta["price"][0] < (int)$minPrice3) {
								$minPrice3 = $post_meta["price"][0];
							}
							if((float)$post_meta["square"][0] < (float)$minArea3) {
								$minArea3 = $post_meta["square"][0];
                $id3 = $query->post->ID;
							}
							array_push($post_meta, $query->post->ID);
							array_push($arr3, $post_meta);
						}
						/* 4 rooms */
						if ((int)$post_meta['rooms'][0] == 4) {
							if((int)$post_meta["price"][0] < (int)$minPrice4) {
								$minPrice4 = $post_meta["price"][0];
							}
							if((float)$post_meta["square"][0] < (float)$minArea4) {
								$minArea4 = $post_meta["square"][0];
                $id4 = $query->post->ID;
							}
							array_push($post_meta, $query->post->ID);
							array_push($arr4, $post_meta);
						}
						/* 5 rooms */
						if ((int)$post_meta['rooms'][0] == 5) {
							if((int)$post_meta["price"][0] < (int)$minPrice5) {
								$minPrice5 = $post_meta["price"][0];
							}
							if((float)$post_meta["square"][0] < (float)$minArea5) {
								$minArea5 = $post_meta["square"][0];
                $id5 = $query->post->ID;
							}
							array_push($post_meta, $query->post->ID);
							array_push($arr5, $post_meta);
						}
          endwhile;wp_reset_postdata();
          ?>
          <div class="row rowKv">
					<?/* STUDY */?>
					<?if (!empty($arrS[0])) {?>
              <div class="col-md-4 col-sm-6">
                <div class="kvImage">
                  <a href="/object_category/sale/?novostroy%5B%5D=<?=get_the_ID()?>&rooms=студия" class="similar-property property-featured-image"><?php echo get_the_post_thumbnail($ids,'600-400-size'); ?></a>
                </div>
                <a href="/object_category/sale/?novostroy%5B%5D=<?=get_the_ID()?>&rooms=студия">
                  <h3>Квартиры-студии<br>от <?=number_format($minPriceS, 0, ',', ' ')?> руб,<br>площадь от <?=$minAreaS?>&nbsp;м<sup>2</sup></h3>
                </a>

<!--						<ul>-->
<!--						--><?//foreach($arrS as $obj) {
//							$id = $obj[0];
//							?>
<!--							<li>-->
<!--								<a href="--><?php //echo get_permalink($id); ?><!--">Квартира-студия&nbsp; --><?//=number_format($obj['price'][0], 0, ',', ' ')?><!--&nbsp;руб, площадь — --><?//=$obj['square'][0]?><!--&nbsp;м<sup>2</sup></a>-->
<!--							</li>-->
<!--						--><?//}?>
<!--						</ul>-->
            </div>
					<?}?>	
					<?/* 1 rooms */?>
<!--                  <pre>--><?//print_r($arr1)?><!--</pre>-->
					<?if (!empty($arr1[0])) {?>
              <div class="col-md-4 col-sm-6">
                <div class="kvImage">
                  <a href="/object_category/sale/?novostroy%5B%5D=<?=get_the_ID()?>&rooms=1" class="similar-property property-featured-image"><?php echo get_the_post_thumbnail($id1,'600-400-size'); ?></a>
                </div>
                <a href="/object_category/sale/?novostroy%5B%5D=<?=get_the_ID()?>&rooms=1">
						<h3>Однокомнатные<br>от <?=number_format($minPrice1, 0, ',', ' ')?> руб,<br>площадь от <?=$minArea1?>&nbsp;м<sup>2</sup></h3>
                  </a>

<!--						<ul>-->
<!--						--><?//foreach($arr1 as $obj) {
//							$id = $obj[0];
//							?>
<!--							<li>-->
<!--								<a href="--><?php //echo get_permalink($id); ?><!--">Однокомнатная&nbsp;квартира --><?//=number_format($obj['price'][0], 0, ',', ' ')?><!--&nbsp;руб, площадь — --><?//=$obj['square'][0]?><!--&nbsp;м<sup>2</sup></a>-->
<!--							</li>-->
<!--						--><?//}?>
<!--						</ul>-->
                </div>
					<?}?>	
					<?/* 2 rooms */?>	
					<?if (!empty($arr2[0])) {?>
            <div class="col-md-4 col-sm-6">
              <div class="kvImage">
                <a href="/object_category/sale/?novostroy%5B%5D=<?=get_the_ID()?>&rooms=2" class="similar-property property-featured-image"><?php echo get_the_post_thumbnail($id2,'600-400-size'); ?></a>
              </div>
              <a href="/object_category/sale/?novostroy%5B%5D=<?=get_the_ID()?>&rooms=2">
						<h3>Двухкомнатные<br>от <?=number_format($minPrice2, 0, ',', ' ')?> руб,<br>площадь от <?=$minArea2?>&nbsp;м<sup>2</sup></h3>
                </a>
<!--						<ul>-->
<!--						--><?//foreach($arr2 as $obj) {
//							$id = $obj[0];
//							?>
<!--							<li>-->
<!--								<a href="--><?php //echo get_permalink($id); ?><!--">Двухкомнатная&nbsp;квартира --><?//=number_format($obj['price'][0], 0, ',', ' ')?><!--&nbsp;руб, площадь — --><?//=$obj['square'][0]?><!--&nbsp;м<sup>2</sup></a>-->
<!--							</li>-->
<!--						--><?//}?>
<!--						</ul>-->
                </div>
					<?}?>
					<?/* 3 rooms */?>	
					<?if (!empty($arr3[0])) {?>
            <div class="col-md-4 col-sm-6">
              <div class="kvImage">
                <a href="/object_category/sale/?novostroy%5B%5D=<?=get_the_ID()?>&rooms=3" class="similar-property property-featured-image"><?php echo get_the_post_thumbnail($id3,'600-400-size'); ?></a>
              </div>
              <a href="/object_category/sale/?novostroy%5B%5D=<?=get_the_ID()?>&rooms=3">
						<h3>Трехкомнатные<br>от <?=number_format($minPrice3, 0, ',', ' ')?> руб,<br>площадь от <?=$minArea3?>&nbsp;м<sup>2</sup></h3>
                </a>
<!--						<ul>-->
<!--						--><?//foreach($arr3 as $obj) {
//							$id = $obj[0];
//							?>
<!--							<li>-->
<!--								<a href="--><?php //echo get_permalink($id); ?><!--">Трехкомнатная&nbsp;квартира --><?//=number_format($obj['price'][0], 0, ',', ' ')?><!--&nbsp;руб, площадь — --><?//=$obj['square'][0]?><!--&nbsp;м<sup>2</sup></a>-->
<!--							</li>-->
<!--						--><?//}?>
<!--						</ul>-->
                </div>
					<?}?>
					<?/* 4 rooms */?>	
					<?if (!empty($arr4[0])) {?>
            <div class="col-md-4 col-sm-6">
              <div class="kvImage">
                <a href="/object_category/sale/?novostroy%5B%5D=<?=get_the_ID()?>&rooms=4" class="similar-property property-featured-image"><?php echo get_the_post_thumbnail($id4,'600-400-size'); ?></a>
              </div>
              <a href="/object_category/sale/?novostroy%5B%5D=<?=get_the_ID()?>&rooms=4">
						<h3>Четырехкомнатные<br>от <?=number_format($minPrice4, 0, ',', ' ')?> руб,<br>площадь от <?=$minArea4?>&nbsp;м<sup>2</sup></h3>
                </a>
<!--						<ul>-->
<!--						--><?//foreach($arr4 as $obj) {
//							$id = $obj[0];
//							?>
<!--							<li>-->
<!--								<a href="--><?php //echo get_permalink($id); ?><!--">Четырехкомнатная&nbsp;квартира --><?//=number_format($obj['price'][0], 0, ',', ' ')?><!--&nbsp;руб, площадь — --><?//=$obj['square'][0]?><!--&nbsp;м<sup>2</sup></a>-->
<!--							</li>-->
<!--						--><?//}?>
<!--						</ul>-->
              </div>
					<?}?>
					<?/* 5 rooms */?>	
					<?if (!empty($arr5[0])) {?>
            <div class="col-md-4 col-sm-6">
              <div class="kvImage">
                <a href="/object_category/sale/?novostroy%5B%5D=<?=get_the_ID()?>&rooms=5" class="similar-property property-featured-image"><?php echo get_the_post_thumbnail($id5,'600-400-size'); ?></a>
              </div>
              <a href="/object_category/sale/?novostroy%5B%5D=<?=get_the_ID()?>&rooms=5">
						<h3>Многокомнатные<br>от <?=number_format($minPrice5, 0, ',', ' ')?> руб,<br>площадь от <?=$minArea5?>&nbsp;м<sup>2</sup></h3>
                </a>
<!--						<ul>-->
<!--						--><?//foreach($arr5 as $obj) {
//							$id = $obj[0];
//							?>
<!--							<li>-->
<!--								<a href="--><?php //echo get_permalink($id); ?><!--">Пятикомнатная&nbsp;квартира --><?//=number_format($obj['price'][0], 0, ',', ' ')?><!--&nbsp;руб, площадь — --><?//=$obj['square'][0]?><!--&nbsp;м<sup>2</sup></a>-->
<!--							</li>-->
<!--						--><?//}?>
<!--						</ul>-->
              </div>
					<?}?></div>

                  <?//= $stoimost ?>
                </div>
              </div>
            

            <? if ($sdacha != "") { ?>
              <div id="sdacha">
                <?= $sdacha ?>
              </div>
            <? } ?>

            <? if ($ipoteka != "") { ?>
              <div id="ipoteka">
                <?= $ipoteka ?>
              </div>
            <? } ?>

            <? include get_template_directory() . "/include/ipoteka.php"; ?>

            <? if ($video != "") { ?>
              <div id="video">
                <?= $video ?>
              </div>
            <? } ?>

            <? if ($infrastruktura != "") { ?>
              <div id="infrastruktura">
                <?= $infrastruktura ?>
              </div>
            <? } ?>

            <? if ($fond != "") { ?>
              <div id="fond">
                <?= $fond ?>
              </div>
            <? } ?>


            <? include get_template_directory() . "/include/question.php"; ?>
            <p><a href="/katalog-novostroek">Каталог новостроек</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
<? endwhile; ?>
<? get_footer(); ?>