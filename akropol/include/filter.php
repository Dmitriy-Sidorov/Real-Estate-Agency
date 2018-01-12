<?
if (!empty($_GET['max_area'])) {
  $max_area = $_GET['max_area'];
} else {
  $max_area = "";
}
if (!empty($_GET['min_area'])) {
  $min_area = $_GET['min_area'];
} else {
  $min_area = "";
}
if (!empty($_GET['max_price'])) {
  $max_price = $_GET['max_price'];
} else {
  $max_price = "";
}
if (!empty($_GET['min_price'])) {
  $min_price = $_GET['min_price'];
} else {
  $min_price = "";
}
if (!empty($_GET['max_storey'])) {
  $max_storey = $_GET['max_storey'];
} else {
  $max_storey = "";
}
if (!empty($_GET['min_storey'])) {
  $min_storey = $_GET['min_storey'];
} else {
  $min_storey = "";
}
if (!empty($_GET['rooms'])) {
  $rooms = $_GET['rooms'];
} else {
  $rooms = "";
}
if (!empty($_GET['novostroy'])) {

  //print_r($_GET);
  $novostroy = array();
  foreach($_GET['novostroy'] as $nov) {

    if($nov != 0)
      $novostroy[] = $nov;
  }
} else {
  $novostroy = array();
}
if (!empty($_GET['type'])) {
  $type = $_GET['type'];
} else {
  $type = "";
}

$metaquery = array();
if (!empty($min_storey) && !empty($max_storey)) {
  $metaquery[] = array(
      'key' => 'floor',
      'value' => array($min_storey, $max_storey),
      'type' => 'numeric',
      'compare' => 'BETWEEN'
  );
} else {
  if (!empty($min_storey)) {
    $metaquery[] = array(
        'key' => 'floor',
        'value' => $min_storey,
        'type' => 'numeric',
        'compare' => '>='
    );
  }
  if (!empty($max_storey)) {
    $metaquery[] = array(
        'key' => 'floor',
        'value' => $max_storey,
        'type' => 'numeric',
        'compare' => '<='
    );
  }
}
if (!empty($min_price) && !empty($max_price)) {
  $metaquery[] = array(
      'key' => 'price',
      'value' => array($min_price, $max_price),
      'type' => 'numeric',
      'compare' => 'BETWEEN'
  );
} else {
  if (!empty($min_price)) {
    $metaquery[] = array(
        'key' => 'price',
        'value' => $min_price,
        'type' => 'numeric',
        'compare' => '>='
    );
  }
  if (!empty($max_price)) {
    $metaquery[] = array(
        'key' => 'price',
        'value' => $max_price,
        'type' => 'numeric',
        'compare' => '<='
    );
  }
}
if (!empty($min_area) && !empty($max_area)) {
  $metaquery[] = array(
      'key' => 'square',
      'value' => array($min_area, $max_area),
      'type' => 'numeric',
      'compare' => 'BETWEEN'
  );
} else {
  if (!empty($min_area)) {
    $metaquery[] = array(
        'key' => 'square',
        'value' => $min_area,
        'type' => 'numeric',
        'compare' => '>='
    );
  }
  if (!empty($max_area)) {
    $metaquery[] = array(
        'key' => 'square',
        'value' => $max_area,
        'type' => 'numeric',
        'compare' => '<='
    );
  }
}

if (!empty($_GET['rooms'])) {
  $metaquery[] = array(
      'key' => 'rooms',
      'value' => $rooms,
      'type' => 'numeric',
      'compare' => '='
  );
}
if (!empty($_GET['novostroy'])) {

    $metaquery[] = array(
        array(
            'key' => 'novostroyka',
            'value' => $novostroy,
            'compare' => 'IN',
        ));

}
$taxquery = array();
if (!empty($_GET['type']) && $_GET['type'] != 0) {
  $taxquery[] = array(
      'taxonomy' => 'object_category',
      'field'    => 'id',
      'terms'    => $type,
      'operator' => 'IN',
  );
}
?>
<!--<pre>-->
<!--  --><?//print_r($metaquery)?>
<!--</pre>-->
<div class="container">
  <div class="sidebar top-sidebar row">
    <div class="widget top-widget widget_search_properties_new">
      <div class="full-search-form new-full-search-form clearfix">
        <form method="get" action="<?= $_SERVER['REQUEST_URI'] ?>">
          <div class="row clearfix">
            <div class="filter-range col-sm-3">
              <label>Цена от...</label>
              <input type="text" name="min_price" class="form-control" placeholder="Не важно" value="<?= $min_price ?>">
              <label>Цена до...</label>
              <input type="text" name="max_price" class="form-control" placeholder="Не важно" value="<?= $max_price ?>">
            </div>
            <div class="filter-range col-sm-3">
              <label>Площадь от…</label>
              <input type="text" name="min_area" class="form-control"
                     placeholder="Не важно" value="<?= $min_area ?>">
              <label>Площадь&nbsp;до…</label>
              <input type="text" name="max_area" class="form-control" placeholder="Не важно" value="<?= $max_area ?>">
            </div>
            <div class="filter-range col-sm-3">
              <label>Этаж от...</label>
              <input type="text" name="min_storey" class="form-control" placeholder="Не важно"
                     value="<?= $min_storey ?>">
              <label>Этаж до...</label>
              <input type="text" name="max_storey" class="form-control" placeholder="Не важно"
                     value="<?= $max_storey ?>">
            </div>
            <div class="filter-range col-sm-3"> <!--Вторичка/новостройка и тип новостройки-->
             <label>Выберите тип</label>
              <select class="form-control" name="type">
                <option value="0">Новостройка / Вторичка</option>
                <option value="159"<?if($type == 159) echo ' selected'?>>Новостройка</option>
                <option value="160"<?if($type == 160) echo ' selected'?>>Вторичка</option>
              </select>
              
              <label>Выберите новостройку</label>
              <?
              $novo = new WP_Query(array(
                      'post_type' => 'katalog_novostroek',
                      "posts_per_page" => '-1',
                      'paged' => get_query_var('paged'),
                  )
              );

              $arrNov = array();
              if ($novo->have_posts()):
                while ($novo->have_posts()):$novo->the_post();
                  $arrNov[] = array('name' => get_the_title(), 'id' => $post->ID);
                endwhile; ?>
              <? endif; ?>
              <? wp_reset_query(); ?>
              <select class="form-control" id="novostroy" name="novostroy[]" multiple="multiple">
<!--                <option value="0">Выберите новостройку...</option>-->
                <? foreach ($arrNov as $el) { ?>
                  <option value="<?= $el['id'] ?>"
                  <?if(in_array($el['id'], $novostroy)) echo 'выбрано'?>>
                  	<?= $el['name'] ?>
                  </option>
                <? } ?>
              </select>           
            </div>
            <div class="filter-range col-sm-4"> <!--Количество комнат-->
             <label>Количество комнат</label>
              <input type="text" name="rooms" class="form-control" placeholder="Не важно" value="<?= $rooms ?>">
            </div>
            <div class="filter-range col-sm-4">
              <label>&nbsp;</label>
              <button type="submit" class="btn btn-primary btn-block btnSubmit"><i class="fa fa-search"></i> Найти
              </button>
            </div>
            <div class="filter-range col-sm-4">
              <label>&nbsp;</label>
              <a href='<?= preg_replace('/^([^?]+)(\?.*?)?(#.*)?$/', '$1$3', $_SERVER['REQUEST_URI']); ?>'
                 class="btn btn-primary btn-block btnSubmit btnRemove"><i class="fa fa-times" aria-hidden="true"></i>
                Сбросить фильтр
              </a>
            </div>

          </div>
        </form>
      </div>
    </div>


  </div>
</div>