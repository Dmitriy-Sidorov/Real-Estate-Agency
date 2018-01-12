<?
function dateToRussian($date)
{
  $date = explode(".", $date);

  $array_month = array(
      "01" => "января",
      "02" => "февраля",
      "03" => "марта",
      "04" => "апреля",
      "05" => "мая",
      "06" => "июня",
      "07" => "июля",
      "08" => "августа",
      "09" => "сентября",
      "10" => "октября",
      "11" => "ноября",
      "12" => "декабря",

  );


  return $date[0] . " " . $array_month[$date[1]] . " " . $date[2];
}

function getNewsDate($date)
{
  $array_month = array(
      "1" => "января",
      "2" => "февраля",
      "3" => "марта",
      "4" => "апреля",
      "5" => "мая",
      "6" => "июня",
      "7" => "июля",
      "8" => "августа",
      "9" => "сентября",
      "10" => "октября",
      "11" => "ноября",
      "12" => "декабря",

  );

  return $array_month[$date[0]] . " " . $date[1];
}

add_theme_support('post-thumbnails');
/* ------------------------------------------------------------------------------------
Add Image Size */
add_image_size('600-400-size', 600, 400, true);
add_image_size('80-80-size', 80, 80, true);
add_image_size('150-100-size', 150, 100, true);
add_image_size('140-47-size', 140, 47, true);
add_image_size('1200-500-size', 1200, 500, true);
add_image_size('365-365-size', 365, 365, true);
add_image_size('100-67-size', 100, 67, true);
add_image_size('1042-auto-size', 1042, 9999999);
/* -------------------------------------------------------------------------------------
  Menu option
  ----------------------------------------------------------------------------------- */
add_action('after_setup_theme', 'theme_register_nav_menu');
function theme_register_nav_menu()
{
  register_nav_menu('primary', 'Главное меню');
}

/* -------------------------------------------------------------------------------------
  For Paginate
  ----------------------------------------------------------------------------------- */
if (!function_exists('pagination')) {
  function pagination($pages = '', $range = 4)
  {
    $showitems = ($range * 2) + 1;
    global $paged;
    if (empty($paged))
      $paged = 1;
    if ($pages == '') {
      global $wp_query;
      $pages = $wp_query->max_num_pages;
      if (!$pages) {
        $pages = 1;
      }
    }
    if (1 != $pages) {
      echo '<ul class="pagination">';
      echo '<li><a href="' . get_pagenum_link(1) . '" title="First"><i class="fa fa-chevron-left"></i></a></li>';
      for ($i = 1; $i <= $pages; $i++) {
        if (1 != $pages && (!($i >= $paged + $range + 3 || $i <= $paged - $range - 3) || $pages <= $showitems)) {
          echo ($paged == $i) ? "<li class=\"active\"><span>" . $i . "</span></li>" : "<li><a href='" . get_pagenum_link($i) . "' class=\"\">" . $i . "</a></li>";
        }
      }
      echo '<li><a href="' . get_pagenum_link($pages) . '" title="Last"><i class="fa fa-chevron-right"></i></a></li>';
      echo '</ul>';
    }
  }
}
/* -------------------------------------------------------------------------------------
  For Remove Dimensions from thumbnail image
  ----------------------------------------------------------------------------------- */
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);
function remove_thumbnail_dimensions($html)
{
  $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
  return $html;
}

class My_Walker_Nav_Menu extends Walker_Nav_Menu
{
  function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
  {
    $id_field = $this->db_fields['id'];
    if (is_object($args[0])) {
      $args[0]->has_children = !empty($children_elements[$element->$id_field]);
    }
    return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
  {
    global $wp_query;
    $indent = ($depth) ? str_repeat("\t", $depth) : '';
    $class_names = $value = '';
    $classes = empty($item->classes) ? array() : (array)$item->classes;
    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
    $class_names = ' class="' . esc_attr($class_names) . '"';
    $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
    $data_value = '';
    if (is_object($args) && $args->has_children) {
      $data_value = 'data-toggle="dropdown"';

    } else {
      $data_value = "";
    }
    if (!is_object($args)) {
      return;
    }
    $item_output = $args->before;
    $item_output .= '<a ' . $data_value . ' ' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;
    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id);

  }

  function start_lvl(&$output, $depth = 0, $args = array())
  {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }
}

function my_category_order($orderby, $args)
{
  if ($args['orderby'] == 'sort')
    return 't.sort';
  else
    return $orderby;
}

add_filter('get_terms_orderby', 'my_category_order', 10, 2);

function add_scripts()
{
  $theme_uri = get_template_directory_uri();


  wp_register_script('jquery', $theme_uri . '/js/jquery-3.2.1.min.js', array(), '', true);
  wp_register_script('miniscripts', $theme_uri . '/js/miniscripts.js', array(), '', true);
  //wp_register_script('jquery.maskedinput', $theme_uri . '/js/jquery.maskedinput.js', array(), '', true);
  //wp_register_script('jquery.cookie', $theme_uri . '/js/jquery.cookie.js', array(), '', true);
  wp_register_script('init', $theme_uri . '/js/init.js', array(), '', true);
  //wp_register_script('sweetalert.min', $theme_uri . '/js/sweetalert.min.js', array(), '', true);
  //wp_register_script('bootstrap', $theme_uri . '/js/bootstrap.js', array(), '', true);
  //wp_register_script('owl.carousel.min', $theme_uri . '/libs/owlCarousel/owl.carousel.min.js', array(), '', true);
  wp_register_script('masonry', $theme_uri . '/js/masonry.min.js', array(), '', true);
  wp_register_script('script', $theme_uri . '/js/script.js', array(), '', true);
  //wp_register_script('colorbox', $theme_uri . '/js/jquery.colorbox-min.js', array(), '', true);
  wp_register_script('multiselect', $theme_uri . '/libs/multiselect/js/bootstrap-multiselect.js', array(), '', true);
  wp_register_script('fancybox', $theme_uri . '/libs/fancybox/jquery.fancybox.pack.js', array(), '', true);
  wp_register_script('custom', $theme_uri . '/js/custom.js', array(), '', true);

  wp_enqueue_script('jquery');
  wp_enqueue_script('miniscripts');
  //wp_enqueue_script('bootstrap');
  //wp_enqueue_script('owl.carousel.min');
  //wp_enqueue_script('jquery.cookie');
  wp_enqueue_script('init');
  //wp_enqueue_script('sweetalert.min');
  wp_enqueue_script('masonry');
  wp_enqueue_script('script');
  //wp_enqueue_script('jquery.maskedinput');
  wp_enqueue_script('multiselect');
  wp_enqueue_script('fancybox');
  wp_enqueue_script('custom');

}

add_action('wp_enqueue_scripts', 'add_scripts');

// регистрируем стили
add_action('wp_enqueue_scripts', 'add_styles');

// регистрируем файл стилей и добавляем его в очередь
function add_styles()
{
  $theme_uri = get_template_directory_uri();
  wp_register_style('ministyles', $theme_uri . '/css/ministyles.css');
  /*wp_register_style('normalize', $theme_uri . '/css/normalize.css');
  wp_register_style('bootstrap', $theme_uri . '/css/bootstrap.css');
  wp_register_style('animations', $theme_uri . '/css/animations.css');*/
  wp_register_style('font-awesome.min', $theme_uri . '/libs/font-awesome/css/font-awesome.min.css');
  /*wp_register_style('owl.carousel.min', $theme_uri . '/libs/owlCarousel/assets/owl.carousel.min.css');
  wp_register_style('color7', $theme_uri . '/colors/color7.css');
  wp_register_style('owl.theme.default.min', $theme_uri . '/libs/owlCarousel/assets/owl.theme.default.min.css');
  wp_register_style('sweetalert', $theme_uri . '/css/sweetalert.css');*/
  wp_register_style('fancybox', $theme_uri . '/libs/fancybox/jquery.fancybox.css');
  wp_register_style('multiselect', $theme_uri . '/libs/multiselect/css/bootstrap-multiselect.css');
  /*wp_register_style('style', $theme_uri . '/css/style.css');*/
  wp_register_style('custom', $theme_uri . '/css/custom.css');

  wp_enqueue_style('ministyles');
  wp_enqueue_style('font-awesome.min');
  wp_enqueue_style('multiselect');
  wp_enqueue_style('fancybox');
  wp_enqueue_style('custom');
}

/*
 * "Хлебные крошки" для WordPress
 * автор: Dimox
 * версия: 2017.01.21
 * лицензия: MIT
*/
function dimox_breadcrumbs()
{

  /* === ОПЦИИ === */
  $text['home'] = 'Главная'; // текст ссылки "Главная"
  $text['category'] = '%s'; // текст для страницы рубрики
  $text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
  $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега
  $text['author'] = 'Статьи автора %s'; // текст для страницы автора
  $text['404'] = 'Ошибка 404'; // текст для страницы 404
  $text['page'] = 'Страница %s'; // текст 'Страница N'
  $text['cpage'] = 'Страница комментариев %s'; // текст 'Страница комментариев N'

  $wrap_before = '<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
  $wrap_after = '</div><!-- .breadcrumbs -->'; // закрывающий тег обертки
  $sep = '/'; // разделитель между "крошками"
  $sep_before = '<span class="sep">'; // тег перед разделителем
  $sep_after = '</span>'; // тег после разделителя
  $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
  $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
  $show_current = 1; // 1 - показывать название текущей страницы, 0 - не показывать
  $before = '<span class="current">'; // тег перед текущей "крошкой"
  $after = '</span>'; // тег после текущей "крошки"
  /* === КОНЕЦ ОПЦИЙ === */

  global $post;
  $home_url = home_url('/');
  $link_before = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
  $link_after = '</span>';
  $link_attr = ' itemprop="item"';
  $link_in_before = '<span itemprop="name">';
  $link_in_after = '</span>';
  $link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
  $frontpage_id = get_option('page_on_front');
  $parent_id = ($post) ? $post->post_parent : '';
  $sep = ' ' . $sep_before . $sep . $sep_after . ' ';
  $home_link = $link_before . '<a href="' . $home_url . '"' . $link_attr . ' class="home">' . $link_in_before . $text['home'] . $link_in_after . '</a>' . $link_after;

  if (is_home() || is_front_page()) {

    if ($show_on_home) echo $wrap_before . $home_link . $wrap_after;

  } else {

    echo $wrap_before;
    if ($show_home_link) echo $home_link;

    if (is_category()) {
      $cat = get_category(get_query_var('cat'), false);
      if ($cat->parent != 0) {
        $cats = get_category_parents($cat->parent, TRUE, $sep);
        $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $cats);
        if ($show_home_link) echo $sep;
        echo $cats;
      }
      if (get_query_var('paged')) {
        $cat = $cat->cat_ID;
        echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
      }

    } elseif (is_search()) {
      if (have_posts()) {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . sprintf($text['search'], get_search_query()) . $after;
      } else {
        if ($show_home_link) echo $sep;
        echo $before . sprintf($text['search'], get_search_query()) . $after;
      }

    } elseif (is_day()) {
      if ($show_home_link) echo $sep;
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
      echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
      if ($show_current) echo $sep . $before . get_the_time('d') . $after;

    } elseif (is_month()) {
      if ($show_home_link) echo $sep;
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
      if ($show_current) echo $sep . $before . get_the_time('F') . $after;

    } elseif (is_year()) {
      if ($show_home_link && $show_current) echo $sep;
      if ($show_current) echo $before . get_the_time('Y') . $after;

    } elseif (is_single() && !is_attachment()) {
      if ($show_home_link) echo $sep;
      if (get_post_type() != 'post') {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        printf($link, $home_url . $slug['slug'] . '/', $post_type->labels->singular_name);
        if ($show_current) echo $sep . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category();
        $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $sep);
        if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $cats);
        echo $cats;
        if (get_query_var('cpage')) {
          echo $sep . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
        } else {
          if ($show_current) echo $before . get_the_title() . $after;
        }
      }

      // custom post type
    } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
      $post_type = get_post_type_object(get_post_type());
      if (get_query_var('paged')) {
        echo $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . $post_type->label . $after;
      }

    } elseif (is_attachment()) {
      if ($show_home_link) echo $sep;
      $parent = get_post($parent_id);
      $cat = get_the_category($parent->ID);
      $cat = $cat[0];
      if ($cat) {
        $cats = get_category_parents($cat, TRUE, $sep);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $cats);
        echo $cats;
      }
      printf($link, get_permalink($parent), $parent->post_title);
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif (is_page() && !$parent_id) {
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif (is_page() && $parent_id) {
      if ($show_home_link) echo $sep;
      if ($parent_id != $frontpage_id) {
        $breadcrumbs = array();
        while ($parent_id) {
          $page = get_page($parent_id);
          if ($parent_id != $frontpage_id) {
            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
          }
          $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
          echo $breadcrumbs[$i];
          if ($i != count($breadcrumbs) - 1) echo $sep;
        }
      }
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif (is_tag()) {
      if (get_query_var('paged')) {
        $tag_id = get_queried_object_id();
        $tag = get_tag($tag_id);
        echo $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
      }

    } elseif (is_author()) {
      global $author;
      $author = get_userdata($author);
      if (get_query_var('paged')) {
        if ($show_home_link) echo $sep;
        echo sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . sprintf($text['author'], $author->display_name) . $after;
      }

    } elseif (is_404()) {
      if ($show_home_link && $show_current) echo $sep;
      if ($show_current) echo $before . $text['404'] . $after;

    } elseif (has_post_format() && !is_singular()) {
      if ($show_home_link) echo $sep;
      echo get_post_format_string(get_post_format());
    }

    echo $wrap_after;

  }
} // end of dimox_breadcrumbs()?>
<?function new_excerpt_more($more) {
  return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/*множественная загрузка изображений*/


if(is_admin()) {
  wp_enqueue_script('imagefield', get_template_directory_uri().'/js/upload.js', array("jquery", "media-upload", "jquery-ui-core", "jquery-ui-sortable"));
}
function metaimage_meta_box() {
  add_meta_box(
      'metaimage_meta_box', // Идентификатор(id)
      'Галерея изображений', // Заголовок области с мета-полями(title)
      'show_my_metaimage_meta_box', // Вызов(callback)
      array('post',"page", "katalog_novostroek", "objects"), // где будет отображаться, post означает в форме стандартного добавления записи
      'normal',
      'high');
}

add_action('add_meta_boxes', 'metaimage_meta_box'); // Запускаем функцию

// Массив с необходимыми полями
$multiupload_fields = array(
    array(
        'label' => 'Галерея',
        'desc'  => 'Загрузите нужные изображения',
        'id'    => 'multiupload',
        'type'  => 'multiupload'
    )
);

function show_my_metaimage_meta_box() {
  global $multiupload_fields; // Обозначим наш массив с полями глобальным
  global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
// Выводим скрытый input, для верификации. Безопасность прежде всего!
  echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

  // Начинаем выводить таблицу с полями через цикл
  echo '<table class="form-table">';
  foreach ($multiupload_fields as $field) {
    // Получаем значение если оно есть для этого поля
    $meta = get_post_meta($post->ID, $field['id'], true);
    // Начинаем выводить таблицу
    echo '<tr>
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                <td>';
    switch($field['type']) {
      case 'multiupload':
        echo '<a class="repeatable-add button" href="#">Добавить поле</a>
                                <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
        $i = 0;
        if ($meta) {
          foreach($meta as $row) {
            $image = wp_get_attachment_image_src($row, 'medium'); $image = $image[0];
            if(empty($row)) $row = "http://placehold.it/100x100";
            echo
                '<li style="display: inline-block;margin-right: 20px;position:relative;">
                                        <img style="width:100px;" class="custom_preview_image sort hndle" src="'.$row.'" />
                                        <div style="position: absolute;top:0;">
                                        <input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$row.'" />
                                        <a style="text-decoration: none;" title="Добавить изображение" class="custom_upload_file_button" href="#"><span class="dashicons dashicons-plus"></span></a>
                                        <a style="text-decoration: none;" title="Удалить изображение" class="repeatable-remove" href="#"><span class="dashicons dashicons-no-alt"></span></a>
                                        </div>
                                    </li>';
            $i++;
          }
        } else {
          echo
              '<li style="display: inline-block;margin-right: 20px;position:relative;">
                                <img style="width:100px;" src="http://placehold.it/100x100" class="custom_preview_image sort hndle" alt="" />
                                <div style="position: absolute;top:0;">
                                <span class="dashicons dashicons-menu"></span>
                                <input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="" />
                                <a style="text-decoration: none;" title="Добавить изображение" class="custom_upload_file_button" href="#"><span class="dashicons dashicons-plus"></span></a>
                                <a style="text-decoration: none;" title="Удалить изображение" class="repeatable-remove" href="#"><span class="dashicons dashicons-no-alt"></span></a>
                                </div>
                            </li>';
        }
        echo '</ul>
                            <span class="description">'.$field['desc'].'</span>';
        break;

    }
    echo '</td></tr>';
  }
  echo '</table>';
}
function save_my_metaimage_meta_box($post_id) {
  global $multiupload_fields;  // Массив с нашими полями

  // проверяем наш проверочный код
  if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
    return $post_id;
  // Проверяем авто-сохранение
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    return $post_id;
  // Проверяем права доступа
  if ('image_meta_box_book' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id))
      return $post_id;
  } elseif (!current_user_can('edit_post', $post_id)) {
    return $post_id;
  }

// Если все отлично, прогоняем массив через foreach
  foreach ($multiupload_fields as $field) {
    $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
$image_meta_box = $_POST[$field['id']];
if($field['type'] == 'multiupload')
if ($image_meta_box !=""){ // проверка не пуст ли $image_meta_box
  $image_meta_box = array_values($image_meta_box);}
if ($image_meta_box && $image_meta_box != $old) { // Если данные новые
  update_post_meta($post_id, $field['id'], $image_meta_box); // Обновляем данные
} elseif ("" == $image_meta_box && $old) {
  delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
}
} // end foreach
}
add_action('save_post', 'save_my_metaimage_meta_box'); // Запускаем функцию сохранения
?>
<?
// id картинки по url
function get_attachment_id_by_url( $url ) {
  global $wpdb;

  // таблица постов, там же перечисленны и медиафайлы
  $table  = $wpdb->prefix . 'posts';
  $attachment_id = $wpdb->get_var(
      $wpdb->prepare( "SELECT ID FROM $table WHERE guid RLIKE %s", $url )
  );
  // Returns id
  return $attachment_id;
}
?>
<?
//api google acf
function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyBl8PVxxtqaVm7EZjFwvL2bwL99mU28t8Q';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
?>
<?

?>