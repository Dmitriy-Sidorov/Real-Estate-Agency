<?php	

  $secret = '6LcgPiYUAAAAAKtoJnMvUCzcFtklw_Vdrh0ApNOi'; // ваш секретный ключ

  // открываем сессию
  session_start();
  // переменная в которую будем сохранять результат работы
  $data['result']='error';
		
  // функция для проверки длины строки
  function checkStringLength($string, $minLength, $maxLength) {
    $length = mb_strlen($string,'UTF-8');
    if (($length < $minLength) || ($length > $maxLength)) {
      return false;
    }
    else {
      return true;
    }
  }
  // если запрос не AJAX, то возвращаем ошибку и завершаем работу скрипта
  if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    return json_encode($data);
    exit();
  }

  $data['result']='success';
	$phone = "";
	
  // получаем phone
  if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
    
  } else {
    $data['phone'] = 'Поле <b>phone</b> не заполнено.';
    $data['result']='error';
  }
	
  // блок проверки invisible reCAPTCHA
  require_once (dirname(__FILE__).'/recaptcha/autoload.php');
  // если в массиве $_POST существует ключ g-recaptcha-response, то...
  if (isset($_POST['g-recaptcha-response'])) {
	
    // создать экземпляр службы recaptcha, используя секретный ключ
    $recaptcha = new \ReCaptcha\ReCaptcha($secret);
    // получить результат проверки кода recaptcha
    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
    // результат проверки
    if ($resp->isSuccess()){
      $data['result']=='success';
    } else {
      //для отладки: 
          /* $errors = $resp->getErrorCodes();
           $data['error-captcha'] = $errors;
      
			echo json_encode($errors);
			exit();*/
      $data['captcha']='Код капчи не прошёл проверку на сервере!';
      $data['result']='error';
      return json_encode($data);
      exit();      
    }
  } else {
    $data['captcha']='Код капчи не прошёл проверку на сервере!';
    $data['result']='error';
    return json_encode($data);
    exit();     
  }
	
  // если прозошли ошибки, то завершаем работу и возвращаем ответ клиенту
  if ($data['result']!='success') {
    return json_encode($data);
    exit();    
  }
  
  // завершающие действия
  
  // запись информации в файл
  /*$output = "----------" . "\n";
  $output .= date("d-m-Y H:i:s") . "\n";
  $output .= "Телефон: " . $phone . "\n";
  if (file_put_contents(dirname(__FILE__).'/message.txt', $output, FILE_APPEND | LOCK_EX)) {
    $data['result']='success';
  } else {
    $data['files'] = 'Произошла ошибка при отправке формы.';
    $data['result']='error';
    return json_encode($data);
    exit();        
  }*/

  // отправка формы на email
  require_once dirname(__FILE__) . '/phpmailer/PHPMailerAutoload.php';
  //формируем тело письма
  $output = '<p><b>Дата</b>: ' . date('d-m-Y H:i') . '</p>';
  $output .= '<p><b>Телефон:</b> ' . $phone . '</p>';

  // создаём экземпляр класса PHPMailer
  $mail = new PHPMailer;
  $mail->CharSet = 'UTF-8';
  $mail->From      = 'mail@akropol69.ru';
  $mail->FromName  = 'mail@akropol69.ru';
  $mail->isHTML(true);
  $mail->Subject   = 'Сообщение с формы "Заказать консультацию"';
  $mail->Body      = $output;
  // $mail->AddAddress( 'nr@tvernet.ru' );
  $mail->AddAddress( 'akropol.an@mail.ru' );

  // отправляем письмо
  if ($mail->Send()) {
    $data['result']='success';
		$data['text']="<div class='alert alert-success'><h3>Email Sent Successfully.</h3><br><p>Thank you <strong>$name</strong>, your message has been submitted to us.</p>
	</div>";
  } else {
    $data['result']='error';
  }

  echo json_encode($data);

?>
