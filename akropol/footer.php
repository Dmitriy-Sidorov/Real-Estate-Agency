<footer class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6 widget footer-widget widget_latest_news"><h3 class="widgettitle">Последние Новости</h3>
        <ul>
          <?
          wp_reset_query();
          $args = array(
              'numberposts'      => 4,
              'offset'           => 0,
              'category'         => -0,
              'orderby'          => 'post_date',
              'order'            => 'DESC',
              "post_type" => "post",
              "post_status" => "publish",
          );
          $result = wp_get_recent_posts($args);
          ?>
              <?foreach( $result as $post ):
              setup_postdata( $post );
                  ?>
                <li>
                  <a href="<?=the_permalink($post["ID"]);?>"><?=$post["post_title"];?></a>
                  <span class="meta-data"><?=get_the_date( '',$post["ID"]);?></span>
                </li>
              <?endforeach;?>
          </ul>
          <?
            wp_reset_query();
          ?>
          </div>
      <div class="col-md-6 col-sm-6 widget footer-widget widget_properties"><h3 class="widgettitle">Последние Объекты</h3>
        <ul>
      <?query_posts(array('post_type'=>'objects','post_status'=>'publish','posts_per_page'=>3));

      if(have_posts()):while(have_posts()):the_post();
      $property_address = get_field("address");
      $property_price = get_field("price");
        ?>
      <li>
        <div class="row">
          <div class="col-md-5 col-sm-5 col-xs-5">
            <a href="<?=get_permalink()?>"><?=get_the_post_thumbnail(get_the_ID(),'150-100-size',array('class'=>'img-thumbnail'))?></a>
          </div>
          <div class="col-md-7 col-sm-7 col-xs-7">
            <strong><a href="<?=get_permalink()?>"><?= $property_address ?></a></strong></br>
            <?if (!empty($property_price)){
            echo '<div class="price"><span>' . number_format($property_price, 0, ',', ' ') . '</span><strong>руб.</strong></div>';
            }
            ?>
          </div>
        </div>
      </li>
      <?endwhile; endif; wp_reset_query();?>
          			</div>
  </div>
</footer>
<footer class="site-footer-bottom">
  <div class="container">
    <div class="row">
      <div class="copyrights-col-left col-md-6 col-sm-6 copyrights">
        <p>© 2009–<?=date('Y') ?> АН «Акрополь». Все Права Защищены</p>
      </div>
      <div class="copyrights-col-right col-md-6 col-sm-6">
        <div class="social-icons">
        </div>
      </div>
    </div>
  </div>
</footer>
<a id="back-to-top"><i class="fa fa-angle-double-up"></i></a>
<!-- Request Form-->
<?
$Address = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
?>
<div id="request_modal" class="modal fade" aria-hidden="true" aria-labelledby="mymodalLabel" role="dialog"
     tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
        <h4 id="mymodalLabel" class="modal-title">Заявка на ипотеку</h4>
      </div>
      <div class="modal-body">
        <div class="callback-form">

          <form method="post" id="request_form" name="callbackform" class="callback-form"
                action="<?php echo get_template_directory_uri() ?>/mail/request.php">
            <input type="text" id="name" name="name" class="form-control"
                   placeholder="Ваше имя" required>
            <input type="text" id="phone" name="phone" class="form-control"
                   placeholder="Ваш телефон" required>
            <input type="hidden" id="address" name="address" value="<?php echo $Address; ?>">

            <input type="button"
                   class="btn btn-primary pull-right request_modal" value="Отправить"></button>

          </form>

        </div>
        <div class="clearfix"></div>
        <div id="cf_message"></div>
        <p class="formObyaz">Нажимая «Отправить», вы <a href="/soglasie-na-obrabotku-personalnyih-dannyih" target="_blank">даёте своё согласие на обработку персональных данных</a></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default inverted" data-dismiss="modal" type="button">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<!-- Question Form-->

<div id="question_modal" class="modal fade" aria-hidden="true" aria-labelledby="mymodalLabel" role="dialog"
     tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
        <h4 id="mymodalLabel" class="modal-title">Хочу спросить</h4>
      </div>
      <div class="modal-body">
        <div class="callback-form">

          <form method="post" id="question_form" name="callbackform" class="callback-form"
                action="<?php echo get_template_directory_uri() ?>/mail/question.php">
            <input type="text" id="name" name="name" class="form-control"
                   placeholder="Ваше имя" required>
            <input type="text" id="phone" name="phone" class="form-control"
                   placeholder="Ваш телефон" required>

            <textarea name="message" rows="10" cols="66" placeholder="Ваше сообщение"></textarea>
            <input type="hidden" id="address" name="address" value="<?php echo $Address; ?>">

            <button type="submit"
                    class="btn btn-primary pull-right"><?php _e('Submit', 'framework'); ?></button>
          </form>
        </div>
        <div class="clearfix"></div>
        <div id="cf_message"></div>
        <p class="formObyaz">Нажимая «Отправить», вы <a href="/soglasie-na-obrabotku-personalnyih-dannyih" target="_blank">даёте своё согласие на обработку персональных данных</a></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default inverted" data-dismiss="modal" type="button">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<!-- Callback Form-->
<div id="callbackmodal" class="modal fade" aria-hidden="true" aria-labelledby="mymodalLabel" role="dialog"
     tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
        <h4 id="mymodalLabel" class="modal-title">Обратный звонок</h4>
      </div>
      <div class="modal-body">
        <div class="callbackForm">

          <form method="post" id="callbackform" name="callbackform" class="callbackForm">

            <input type="text" id="phone" name="phone" class="form-control"
                   placeholder="Ваш телефон *" required>
            <input type="hidden" name="image_path" id="image_path"
                   value="<?php echo get_template_directory_uri(); ?>">

            <button type="submit"
                    class="btn btn-primary pull-right"><?php _e('Submit', 'framework'); ?></button>
            <div id="recaptcha2"></div>
          </form>
        </div>
        <div class="clearfix"></div>
        <div id="cfm_message"></div>
        <p class="formObyaz"><b>*</b> - обязательные поля</p>
        <p class="formObyaz">Нажимая «Отправить», вы <a href="/soglasie-na-obrabotku-personalnyih-dannyih" target="_blank">даёте своё согласие на обработку персональных данных</a></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default inverted" data-dismiss="modal" type="button">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<!-- Ipoteka Form-->
<div id="ipotekamodal" class="modal fade" aria-hidden="true" aria-labelledby="mymodalLabel" role="dialog"
     tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
        <h4 id="mymodalLabel" class="modal-title">Заявка на ипотеку</h4>
      </div>
      <div class="modal-body">
        <div class="ipoteka-form">

          <form method="post" id="ipotekaform" name="ipotekaform" class="ipotekaForm">

            <input type="text" id="phone" name="phone" class="form-control"
                   placeholder="Ваш телефон *" required>
            <input type="hidden" name="image_path" id="image_path"
                   value="<?php echo get_template_directory_uri(); ?>">
            <input type="hidden" id="ifPageUrl" name="ifPageUrl" value="akropol69.ru<?=$_SERVER['REQUEST_URI']?>">

            <button type="submit"
                    class="btn btn-primary pull-right"><?php _e('Submit', 'framework'); ?></button>
            <div id="recaptcha7"></div>
          </form>
        </div>
        <div class="clearfix"></div>
        <div id="if_message"></div>
        <p class="formObyaz"><b>*</b> - обязательные поля</p>
        <p class="formObyaz">Нажимая «Отправить», вы <a href="/soglasie-na-obrabotku-personalnyih-dannyih" target="_blank">даёте своё согласие на обработку персональных данных</a></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default inverted" data-dismiss="modal" type="button">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<!-- Wanna Ask Form-->
<div id="wannaaskmodal" class="modal fade" aria-hidden="true" aria-labelledby="mymodalLabel" role="dialog"
     tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
        <h4 id="mymodalLabel" class="modal-title">Хочу спросить</h4>
      </div>
      <div class="modal-body">
        <div class="wanna-ask-form">

          <form method="post" id="wannaaskform" name="wannaaskform" class="wannaaskForm">

            <input type="text" id="phone" name="phone" class="form-control"
                   placeholder="Ваш телефон *" required>
            <input type="hidden" name="image_path" id="image_path"
                   value="<?php echo get_template_directory_uri(); ?>">
            <textarea class="form-control" name="wafQuestion" id="wafQuestion" placeholder="Ваши вопросы"></textarea>
            <input type="hidden" id="wafPageUrl" name="wafPageUrl" value="akropol69.ru<?=$_SERVER['REQUEST_URI']?>">

            <button type="submit"
                    class="btn btn-primary pull-right"><?php _e('Submit', 'framework'); ?></button>
            <div id="recaptcha3"></div>
          </form>
        </div>
        <div class="clearfix"></div>
        <div id="waf_message"></div>
        <p class="formObyaz"><b>*</b> - обязательные поля</p>
        <p class="formObyaz">Нажимая «Отправить», вы <a href="/soglasie-na-obrabotku-personalnyih-dannyih" target="_blank">даёте своё согласие на обработку персональных данных</a></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default inverted" data-dismiss="modal" type="button">Закрыть</button>
      </div>
    </div>
  </div>
</div>


<!-- Na Prosmotr Form-->
<div id="naProsmotrModal" class="modal fade" aria-hidden="true" aria-labelledby="mymodalLabel" role="dialog" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
        <h4 id="mymodalLabel" class="modal-title">Записаться на прием <?php echo get_the_title(); ?></h4>
      </div>
      <div class="modal-body">
        <div class="na-prosmotr-form">

          <form method="post" id="naprosmotrform" name="naprosmotrform" class="na-prosmotr-form">

            <input type="text" id="phone" name="phone" class="form-control"
                   placeholder="Ваш телефон *" required>

            <input type="hidden" name="image_path" id="image_path"
                   value="<?php echo get_template_directory_uri(); ?>">
            <input type="hidden" name="pagelink" id="pagelink" value="<?php echo 'http://akropol69.ru/?property='.$_GET["property"]; ?>">

            <input type="hidden" value="<?php echo get_the_title(); ?>" name="subject" id="subject">
            <button type="submit"
                    class="btn btn-primary pull-right"><?php _e('Submit', 'framework'); ?></button>
            <div id="recaptcha6"></div>
          </form>
        </div>
        <div class="clearfix"></div>
        <div id="npf_message"></div>
        <p class="formObyaz"><b>*</b> - обязательные поля</p>
        <p class="formObyaz">Нажимая «Отправить», вы <a href="/soglasie-na-obrabotku-personalnyih-dannyih" target="_blank">даёте своё согласие на обработку персональных данных</a></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default inverted" data-dismiss="modal" type="button">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- PRESENTATION Form-->
<!--
<a data-target="#presentationModal" data-toggle="modal" class="btn btn-primary" id="presentationModalBtn">Презентация</a>

<div id="presentationModal" class="modal fade" aria-hidden="true" aria-labelledby="mymodalLabel" role="dialog"
     tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
        <h4 id="mymodalLabel" class="modal-title">Получить презентацию всех новостроек Твери с&nbsp;актуальными ценами застройщиков</h4>
      </div>
      <div class="modal-body">
        <div class="presentation-form">

          <form method="post" id="presentationform" name="presentationform" class="presentationform">

            <input type="text" id="phone" name="phone" class="form-control"
                   placeholder="Ваш телефон" required>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Получить презентацию</button>
            </div>
            <div class="formSubText text-center">
              менеджер предоставит вам нужную презентацию
            </div>
            <div id="recaptcha1"></div>
          </form>
        </div>
        <div class="clearfix"></div>
        <div id="npf_message1"></div>
        <p class="formObyaz">Нажимая «Отправить», вы <a href="/soglasie-na-obrabotku-personalnyih-dannyih" target="_blank">даёте своё согласие на обработку персональных данных</a></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default inverted" data-dismiss="modal" type="button">Закрыть</button>
      </div>
    </div>
  </div>
</div>
-->

<!-- Your Price Form-->
<div id="yourPriceModal" class="modal fade" aria-hidden="true" aria-labelledby="mymodalLabel" role="dialog"
     tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
        <h4 id="mymodalLabel" class="modal-title">Цена клиента <?php echo get_the_title(); ?></h4>
      </div>
      <div class="modal-body">
        <div class="your-price-form">

          <form method="post" id="yourpriceform" name="yourpriceform" class="your-price-form">

            <input type="text" id="phone" name="phone" class="form-control"
                   placeholder="Ваш телефон *" required>
            <input type="text" id="price" name="price" class="form-control"
                   placeholder="Предлагаемая цена *" required>

            <input type="hidden" name="image_path" id="image_path"
                   value="<?php echo get_template_directory_uri(); ?>">
            <input type="hidden" name="pagelink" id="pagelink"
                   value="<?php echo 'http://akropol69.ru/?property='.$_GET["property"]; ?>">

            <input type="hidden" value="<?php echo get_the_title(); ?>" name="subject" id="subject">
            <button type="submit"
                    class="btn btn-primary pull-right"><?php _e('Submit', 'framework'); ?></button>
            <div id="recaptcha4"></div>
          </form>
        </div>
        <div class="clearfix"></div>
        <div id="ypf_message"></div>
        <p class="formObyaz">Нажимая «Отправить», вы <a href="/soglasie-na-obrabotku-personalnyih-dannyih" target="_blank">даёте своё согласие на обработку персональных данных</a></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default inverted" data-dismiss="modal" type="button">Close</button>
      </div>
    </div>
  </div>
</div>

<!--Contact Agent Form-->
<div id="agentmodal" class="modal fade" aria-hidden="true" aria-labelledby="mymodalLabel" role="dialog"
     tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
        <h4 id="mymodalLabel" class="modal-title"><?php _e(' Contact Agent', 'framework'); ?></h4>
      </div>
      <div class="modal-body">
        <div class="agent-contact-form">
          <h4><?php _e('Contact Agent For ', 'framework'); ?><span
                class="accent-color"><?php echo get_the_title(); ?></span></h4>
          <form method="post" id="agentcontactform" name="agentcontactform" class="agent-contact-form">
            <input type="text" id="phone" name="phone" class="form-control"
                   placeholder="Ваш телефон *">
            <textarea name="comments" id="comments" class="form-control"
                      placeholder="Ваш вопрос" cols="10"
                      rows="5"></textarea>
            <input type="hidden" name="image_path" id="image_path"
                   value="<?php echo get_template_directory_uri(); ?>">
            <input id="agent_email" name="agent_email" type="hidden"
                   value="<?php echo get_the_author_meta('user_email', $author_id); ?>">
            <input type="hidden" value="<?php echo get_the_title(); ?>" name="subject" id="subject">
            <button type="submit"
                    class="btn btn-primary pull-right"><?php _e('Submit', 'framework'); ?></button>
            <div id="recaptcha5"></div>
          </form>
        </div>
        <div class="clearfix"></div>
        <div id="message"></div>
        <p class="formObyaz">Нажимая «Отправить», вы <a href="/soglasie-na-obrabotku-personalnyih-dannyih" target="_blank">даёте своё согласие на обработку персональных данных</a></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default inverted" data-dismiss="modal" type="button">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Consult Form-->
<div id="consultModal" class="modal fade" aria-hidden="true" aria-labelledby="mymodalLabel" role="dialog"
     tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
        <h4 id="mymodalLabel" class="modal-title">Заказать консультацию</h4>
      </div>
      <div class="modal-body">
        <div class="consultFormBlock">

          <form method="post" id="consultForm" name="consultForm" class="consultForm">

            <input type="text" id="phone" name="phone" class="form-control"
                   placeholder="Ваш телефон *" required>
            <input type="hidden" name="image_path" id="image_path"
                   value="<?php echo get_template_directory_uri(); ?>">

            <button type="submit"
                    class="btn btn-primary pull-right"><?php _e('Submit', 'framework'); ?></button>
            <div id="recaptcha8"></div>
          </form>
        </div>
        <div class="clearfix"></div>
        <div id="cofm_message"></div>
        <p class="formObyaz"><b>*</b> - обязательные поля</p>
        <p class="formObyaz">Нажимая «Отправить», вы <a href="/soglasie-na-obrabotku-personalnyih-dannyih" target="_blank">даёте своё согласие на обработку персональных данных</a></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default inverted" data-dismiss="modal" type="button">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<?wp_footer();?>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadReCaptchaInvisible&render=explicit" async defer></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;language=ru&amp;key=AIzaSyBl8PVxxtqaVm7EZjFwvL2bwL99mU28t8Q" type="text/javascript"></script>
<!--<script crossorigin="anonymous" async type="text/javascript" src="//api.pozvonim.com/widget/callback/v3/b4713611febce2987108052a5fb0b024/connect" id="check-code-pozvonim" charset="UTF-8"></script>-->
<!-- BEGIN JIVOSITE CODE {literal} -->
<!--<script type='text/javascript'>
  (function(){ var widget_id = 'qoq1NPHfw6';var d=document;var w=window;function l(){
    var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
    </script>-->
<!-- {/literal} END JIVOSITE CODE -->
<!--Позвони-->
<!--<script async="async" src="https://w.uptolike.com/widgets/v1/zp.js?pid=1556441" type="text/javascript"></script>-->
</body>
</html>
