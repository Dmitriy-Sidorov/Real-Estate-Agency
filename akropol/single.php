<?
get_header();
?>
<?$post = $wp_query->post;

if (get_post_type() == "objects")
  include(TEMPLATEPATH.'/single-object.php');
elseif (get_post_type() == "agents")
	include(TEMPLATEPATH.'/single-agents.php');
elseif (get_post_type() == "katalog_novostroek")
	include(TEMPLATEPATH.'/single-katalog_novostroek.php');	
else
  if (get_post_type() == "post" && in_category('empty'))
    include(TEMPLATEPATH.'/single-default.php');
  else
    include(TEMPLATEPATH.'/single-news.php');

?>
<? get_footer();?>