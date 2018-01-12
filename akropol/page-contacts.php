<?
/**
 * Template Name: Контакты
 * @package WordPress
 */

get_header(); ?>
  <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
  <div class="clearfix map-single-page" id="onemap"></div>
<!-- Start Content -->
<div class="main" role="main">
  <div id="content" class="content full">
    <div class="container">
      <div class="page">
        <div class="row">
          <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
          <div class="col-md-6 col-sm-6">
            <h3>Обратная связь</h3>
            <div class="row">
              <form method="post" id="contactform" name="contactform" class="contact-form"
                    action="<?php echo get_template_directory_uri() ?>/mail/contact.php">
                <div class="col-md-6 margin-15">
                  <div class="form-group">
                    <input type="text" id="name" name="name" class="form-control input-lg"
                           placeholder="Имя*">
                  </div>
                  <div class="form-group">
                    <input type="email" id="email" name="email" class="form-control input-lg"
                           placeholder="Email*">
                  </div>
                  <div class="form-group">
                    <input type="text" id="phone" name="phone" class="form-control input-lg"
                           placeholder="Телефон">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                                            <textarea cols="6" rows="5" id="comments" name="comments"
                                                      class="form-control input-lg"
                                                      placeholder="Сообщение"></textarea>
                    <input type="hidden" name="image_path" id="image_path"
                           value="/wp-content/themes/akropol/">
                    <input id="subject" name="subject" type="hidden"
                           value="Обратная связь">
                    <p class="formObyaz">Нажимая «Отправить», вы <a href="/soglasie-na-obrabotku-personalnyih-dannyih"
                                                                    target="_blank">даёте своё согласие на обработку
                        персональных данных</a></p>
                    <input id="submit" name="submit" type="submit"
                           class="btn btn-primary btn-lg btn-block"
                           value="Отправить">
                  </div>
                </div>
              </form>
            </div>
            <div class="clearfix"></div>
            <div id="message"></div>
          </div>
          <div class="col-md-6 col-sm-6">
            <h3>Наш адрес</h3>
            <div class="padding-as25 lgray-bg">
              <p class="big">Тверь, Трехсвятская 6-1<br>
                тц «Парадиз» офис 509</p>
              <p>Пишите нам по адресу <a href="mailto:akropol.an@mail.ru"><strong>akropol.an@mail.ru</strong></a> или
                позвоните нам по телефону — <strong><a href="tel:+74822483003" style="text-decoration: none;">+7 (4822)
                    48-30-03</a> | <a href="tel:+74822640779" style="text-decoration: none;">+7 (4822)
                    64-07-79</a></strong></p>
              <div class="row rowFancyContact">
                <div class="col-md-6">
                  <a class="fancy" rel="group" href="http://akropol69.ru/wp-content/uploads/2014/06/2016-08-08-0003.jpg" title="">
                    <img src="http://akropol69.ru/wp-content/uploads/2014/06/2016-08-08-0003-210x300.jpg" alt="" width="210" height="300">
                  </a>
                </div>
                <div class="col-md-6">
                  <a class="fancy" rel="group" href="http://akropol69.ru/wp-content/uploads/2014/06/2016-08-08-0002.jpg" title="">
                    <img src="http://akropol69.ru/wp-content/uploads/2014/06/2016-08-08-0002-210x300.jpg" alt="" width="210" height="300">
                  </a>
                </div>
                <div class="col-md-6">
                  <a class="fancy" rel="group" href="http://akropol69.ru/wp-content/uploads/2014/06/2016-08-08-0001.jpg" title="">
                    <img src="http://akropol69.ru/wp-content/uploads/2014/06/2016-08-08-0001-210x300.jpg" alt="" width="210" height="300">
                  </a>
                </div>
                <div class="col-md-6">
                  <a class="fancy" rel="group" href="http://akropol69.ru/wp-content/uploads/2014/06/2016-08-08-0004.jpg" title="">
                    <img src="http://akropol69.ru/wp-content/uploads/2014/06/2016-08-08-0004-210x300.jpg" alt="" width="210" height="300">
                  </a>
                </div>
              </div>
              <div id="contact51" class="property_container" style="display:none;"><span class="property_address">Трехсвятская ул., 6к1, Тверь, Тверская обл., Россия, 170100</span><span
                    class="latitude">56.85262119999999</span><span class="longitude">35.90866870000002</span><span
                    class="property_image_url"><?= get_template_directory_uri() ?>/images/map-marker.png</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<? get_footer(); ?>