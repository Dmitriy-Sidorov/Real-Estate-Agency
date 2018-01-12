<? get_header(); ?>

<?$objects_tag = $wp_query->query['tags_object'];?>
<?
$true_taxonomy = 'tags_object'; // таксономия - регион
$myterm = get_term_by('slug' , $objects_tag, $true_taxonomy);
$description = $myterm->name;
//print_r($myterm);
?>
  <div class="site-showcase">
    <!-- Start Page Header -->
    <div class="clearfix hover" id="gmap"><span onclick="ymapOn();">Показать карту</span></div>
    <!-- End Page Header -->
  </div>
<? include get_template_directory() . "/include/filter.php"; ?>
  <div class="main" role="main">
    <div id="content" class="content full">
      <div class="container">
        <div class="row">
				<div class="col-md-12">
						<div class="block-heading"><h4><span class="heading-icon"><i class="fa fa-hashtag" aria-hidden="true"></i></span><?=$description?></h4></div>
					</div>
          <div class="navObjects">
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
							<span class="current">#<?=$description?></span>
            </div>
          </div>
          <div class="property-listing">
            <ul class="col-md-12" id="property_grid_holder">
              <?
              global $wp_query;
              query_posts(
                  array_merge(
                      array('meta_query' => $metaquery), // это параметр который добавили мы
                      array('tax_query' => $taxquery), // это параметр который добавили мы
                      $wp_query->query // это массив базового запроса текущей страницы
                  )
              );
              if (have_posts()):
              while (have_posts()):
                the_post(); ?>
                <? $total_images = 0; ?>
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
                <? $map = get_field("map"); ?>
                <li class="type-rent col-md-12" itemscope="" itemtype="http://schema.org/Product">
                  <div id="property<?= get_the_ID() ?>" style="display:none;">
                    <span class="property_address"><? the_field("address") ?></span>
                    <span class="property_price">
                                            <span><?=$ot?><? the_field("price") ?></span>
                                            <strong>руб.</strong>
                                        </span>
                    <span class="latitude"><?= $map["lat"] ?></span>
                    <span class="longitude"><?= $map["lng"] ?></span>
                    <span
                        class="property_image_map"><? $src = wp_get_attachment_image_src(get_post_thumbnail_id(), '150-100-size');
                      echo $src[0]; ?></span>
                    <span class="property_url"><? the_permalink(); ?></span>
                    <span class="property_image_url"><?= get_template_directory_uri() ?>/images/map-marker.png</span>
                  </div>
                  <div class="col-md-4"><a
                        href="<? the_permalink(); ?>"
                        class="property-featured-image" itemprop="image"><?php the_post_thumbnail('600-400-size'); ?>
                      <span class="images-count">
                        <i class="fa fa-picture-o"></i> <?= $total_images ?></span>
                      <? if ($cat !== "") { ?>
                        <span class="badges badge-sale"><?= $cat ?></span>
                      <? } ?>
                    </a></div>
                  <div class="col-md-8">
                    <div class="property-info">
                      <?
                      if (!empty(get_field("price"))) {
                        echo '<div class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="price">'.$ot . number_format(get_field("price"), 0, ',', ' ') . '</span><strong itemprop="priceCurrency" content="RUB">руб.</strong></div>';
                      }
                      ?>
                      <h3>
                        <a itemprop="name"
                           href="<? the_permalink(); ?>"><? the_title() ?></a>
                      </h3>
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
                      </span></a><br>
                      <span itemprop="description"><?= the_excerpt() ?></span>
                    </div>
                    <? if (!empty(get_field("square")) || !empty(get_field("rooms")) || !empty(get_field("floor")) || !empty(get_field("all_floor"))) {
                      echo '<div class="property-amenities clearfix">';


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
                </li>
              <? endwhile; ?>
            </ul>
            <div class="col-md-12 text-center">
              <br>
              <? pagination(); ?>
            </div>
            <? else: ?>
              <div class="col-md-12">
                Объектов не найдено
              </div>
            <? endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <? wp_reset_query(); ?>
  </div>
  <script>
    var properties = [];
    <?
    $query["paged"] = "1";
    $query["posts_per_page"] = "9999";
    $query["post_type"] = "objects";
    $all_property = get_posts($query);
    if(1 || isset($_GET["test"])){
    foreach($all_property as $prop_obj){
    //$property_images = get_post_meta($prop_obj->ID, 'imic_property_sights', false);
    //$total_images = count($property_images);
    $total_images = 0;
    $field = get_post_meta($prop_obj->ID, 'multiupload', true);
    if (!empty($field) && !(count($field) === 1 && $field[0] === "http://placehold.it/100x100")) {
      $total_images = count($field);
    }
    $property_term_type = '';
    $property_area = get_field("square", $prop_obj->ID);
    $property_rooms = get_field('rooms', $prop_obj->ID);
    $property_storey = get_field('floor', $prop_obj->ID);
    $property_address = get_field('address', $prop_obj->ID);
    $property_city = "";
    $property_price = get_field('price', $prop_obj->ID);
    $property_longitude_and_latitude = get_field("map", $prop_obj->ID);
    $currency_symbol = "руб.";
    $thumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($prop_obj->ID), '150-100-size');
    if (!empty($src)):
      $image_container = '<span class ="property_image_map">' . $src[0] . '</span>';
    else:
      $image_container = '';
    endif;
    $property_price = '<span>' . number_format($property_price, 0, ',', ' ') . ' </span><strong>' . $currency_symbol . '</strong>';

    if (!empty($property_area)) {
      $property_area = 'Площадь<text>: </text><strong>' . $property_area . '<text> м<sup>2</sup></text></strong>';
    }
    if (!empty($property_rooms)) {
      $property_rooms = 'Комнат<text>: </text><strong>' . $property_rooms . '</strong>';
    }

    if (!empty($property_storey)) {
      $property_storey = 'Этаж<text>: </text><strong>' . $property_storey . '</strong>';
    }

    if (!empty($property_storeys)) {
      $property_storeys = 'Этажность<text>: </text><strong>' . $property_storeys . '</strong>';
    }

    ?>
    properties.push({
      title: '<?=$property_address?>',
      price: '<?=$property_price?>',
      storey: '<?=$property_storey?>',
      rooms: '<?=$property_rooms?>',
      area: '<?=$property_area?>',
      lat: '<?=$property_longitude_and_latitude['lat']?>',
      lng: '<?=$property_longitude_and_latitude['lng']?>',
      thumb: '<?=$thumb_src[0]?>',
      url: '<? echo get_permalink($prop_obj->ID)?>',

    });
    <?
    }
    /*echo "<pre>";
    print_r($all_property);
    echo "</pre>";*/
    }
    ?>
  </script>
  <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript" async defer></script>
  <script type="text/javascript">
    //ymaps.ready(init); // карта соберется после загрузки скрипта и элементов
    var myMap; // заглобалим переменную карты чтобы можно было ею вертеть из любого места

    function ymapOn() {
      jQuery("#gmap").removeClass('hover');
      jQuery("#gmap").html('');
      // функция - собиралка карты и фигни
      //var properties = [];
      /*jQuery('ul#property_grid_holder li').each(function (i) {
       properties.push({
       title: jQuery(this).find('.property_address').text(),
       price: jQuery(this).find('.property_price').html(),
       storey: jQuery(this).find('.storey').html(),
       rooms: jQuery(this).find('.rooms').html(),
       area: jQuery(this).find('.area').html(),
       lat: jQuery(this).find('.latitude').text(),
       lng: jQuery(this).find('.longitude').text(),
       thumb: jQuery(this).find('.property_image_map').text(),
       url: jQuery(this).find('.property_url').text(),
       icon: jQuery(this).find('.property_image_url').text()
       });
       });*/
      myMap = new ymaps.Map("gmap", { // создаем и присваиваем глобальной переменной карту и суем её в див с id="map"
        center: [56.845623, 35.905864], // ну тут центр
        behaviors: ['default', 'scrollZoom'], // скроллинг колесом
        zoom: 8 // тут масштаб
      });
      myMap.controls // добавим всяких кнопок, в скобках их позиции в блоке
          .add('zoomControl', {left: 5, top: 5}) //Масштаб
          .add('typeSelector') //Список типов карты
          .add('mapTools', {left: 35, top: 5}) // Стандартный набор кнопок
          .add('searchControl'); // Строка с поиском
      /**
       * Создадим кластеризатор, вызвав функцию-конструктор.
       * Список всех опций доступен в документации.
       * @see http://api.yandex.ru/maps/doc/jsapi/2.x/ref/reference/Clusterer.xml#constructor-summary
       */
      clusterer = new ymaps.Clusterer({
        /**
         * Через кластеризатор можно указать только стили кластеров,
         * стили для меток нужно назначать каждой метке отдельно.
         * @see http://api.yandex.ru/maps/doc/jsapi/2.x/ref/reference/option.presetStorage.xml
         */
        preset: 'twirl#greenClusterIcons',
        /**
         * Ставим true, если хотим кластеризовать только точки с одинаковыми координатами.
         */
        groupByCoordinates: false,
        /**
         * Опции кластеров указываем в кластеризаторе с префиксом "cluster".
         * @see http://api.yandex.ru/maps/doc/jsapi/2.x/ref/reference/Cluster.xml
         */
        clusterDisableClickZoom: false
      });


      var ymarkers = new Array();
      var bal_content;
      for (var i = 0; i < properties.length; i++) {

        bal_content = '<div class="map-property">' +
            '<h4 class="property-title"><a class="title-link" href="' + properties[i].url + '">' + properties[i].title + '</a></h4>' +
            '<a href="' + properties[i].url + '"><img class="property-thumb" src="' + properties[i].thumb + '" alt="' + properties[i].title + '"/></a>' +
            '<div class="baloon_text"><p><span class="price">' + properties[i].price + '</span></p>';
        if (properties[i].rooms != undefined)
          bal_content = bal_content + '<p><span class="rooms">' + properties[i].rooms + '</span></p>';
        if (properties[i].area != undefined)
          bal_content = bal_content + '<p><span class="area">' + properties[i].area + '</span></p>';
        if (properties[i].storey != undefined)
          bal_content = bal_content + '<p><span class="storey">' + properties[i].storey + '</span></p>';

        bal_content = bal_content + '<a class="btn btn-primary btn-sm" href="' + properties[i].url + '">Подробнее</a></div><div class="clearfix"></div></div>';
        ymarkers[i] = new ymaps.Placemark(
            [properties[i].lat, properties[i].lng],
            {
              balloonContent: bal_content,
              clusterCaption: properties[i].title
            },
            {
              // Один из двух стандартных макетов
              // меток со значком-картинкой:
              // - default#image - без содержимого;
              // - default#imageWithContent - с текстовым
              // содержимым в значке.
              //iconLayout: 'default#image',
              //iconImageHref: properties[i].icon,
              //iconImageSize: [20, 30]


            }
        );
        //myMap.geoObjects.add(ymarkers[i]);
      }
      clusterer.options.set({
        gridSize: 80,
        clusterDisableClickZoom: false
      });
      clusterer.add(ymarkers);
      clusterer.events.once('objectsaddtomap', function () {
        myMap.setBounds(clusterer.getBounds());
      });
      clusterer.events
      // Можно слушать сразу несколько событий, указывая их имена в массиве.
          .add(['mouseenter', 'mouseleave'], function (e) {
            var target = e.get('target'), // Геообъект - источник события.
                eType = e.get('type'), // Тип события.
                zIndex = Number(eType === 'mouseenter') * 1000; // 1000 или 0 в зависимости от типа события.

            target.options.set('zIndex', zIndex);
          });
      myMap.geoObjects.add(clusterer);
    }
  </script>
<? get_footer(); ?>