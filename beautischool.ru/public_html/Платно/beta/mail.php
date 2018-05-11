<?php
if ($_POST) { // если передан массив POST
	$name = htmlspecialchars($_POST["name"]); // пишем данные в переменные и экранируем спецсимволы
	$phone = htmlspecialchars($_POST["phone"]);
	$mail = htmlspecialchars($_POST["ver"]);
  	$valu = htmlspecialchars($_POST["message"]);
	//$message = htmlspecialchars($_POST["message"]);
	$json = array(); // подготовим массив ответа
	if (!$phone) { // если хоть одно поле оказалось пустым
		$json['error'] = 'Вы заполнили не все поля! Обмануть решили? =)'; // пишем ошибку в массив
		echo json_encode($json); // выводим массив ответа 
		die(); // умираем
	}

	function mime_header_encode($str, $data_charset, $send_charset) { // функция преобразования заголовков в верную кодировку 
		if($data_charset != $send_charset)
		$str=iconv($data_charset,$send_charset.'//IGNORE',$str);
		return ('=?'.$send_charset.'?B?'.base64_encode($str).'?=');
	}
	/* супер класс для отправки письма в нужной кодировке */
	class TPhone {
	public $from_phone;
	public $from_name;
	public $to_phone;
	public $to_name;
	public $subject;
	public $data_charset='UTF-8';
	public $send_charset='windows-1251';
	public $body='';
	public $type='text/plain';

	function send(){
		$dc=$this->data_charset;
		$sc=$this->send_charset;
		$enc_to=mime_header_encode($this->to_name,$dc,$sc).' <'.$this->to_phone.'>';
		$enc_subject=mime_header_encode($this->subject,$dc,$sc);
		$enc_from=mime_header_encode($this->from_name,$dc,$sc).' <'.$this->from_phone.'>';
		$enc_body=$dc==$sc?$this->body:iconv($dc,$sc.'//IGNORE',$this->body);
		$headers='';
		$headers.="Mime-Version: 1.0\r\n";
		$headers.="Content-type: ".$this->type."; charset=".$sc."\r\n";
		$headers.="From: ".$enc_from."\r\n";
		return mail($enc_to,$enc_subject,$enc_body,$headers);
	}

	}

	$phonego= new TPhone; // инициализируем супер класс отправки
	$phonego->from_phone= 'mail@beautischool.ru'; // от кого
	$phonego->from_name= 'Заявка с сайта beautischool.ru';
	$phonego->to_phone= 'q18051977@gmail.com'; // кому
	$phonego->to_name= $name;
	$phonego->subject= "Обучение парикмахерскому искусству"; // тема
  $phonego->body= "Клиент оставил заявку:
Имя: $name
Телефон: $phone
Версия сайта: $mail";  // сообщение
	$phonego->send(); // отправляем

	$json['error'] = 0; // ошибок не было

	echo json_encode($json); // выводим массив ответа
} else { // если массив POST не был передан
	echo 'GET LOST!'; // высылаем
}
?>