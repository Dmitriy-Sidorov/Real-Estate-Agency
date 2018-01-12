<?php
$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$address = $_POST['address'];
$address = "http://akropol69.ru/zhk-lesnaya-melodiya-2";
$subject = 'Хочу спросить';


$content= "Вопрос задал $name \n" ;
$content .= "Адрес страницы: $address \n";
$content .= "Имя: $name \n";
$content .= "Телефон: $phone \n";
$content .= "Сообщение: $message \n";
$headers = "From: no-reply@akropol69.ru" . PHP_EOL;
$headers .= "Reply-To: no-reply@akropol69.ru" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;
$email = "ivanmetlin92@mail.ru";
if(mail($email, $subject, $content, $headers)) {
	// Email has sent successfully, echo a success page.
	echo "<div class='alert alert-success'>";
	echo "<h3>Заявка успешно отослана.</h3><br>";
	echo "<p>Спасибо <strong>$name</strong>, мы свяжемся с Вами в ближайшее время.</p>";
	echo "</div>";
} else {
	echo 'ERROR!';
}
