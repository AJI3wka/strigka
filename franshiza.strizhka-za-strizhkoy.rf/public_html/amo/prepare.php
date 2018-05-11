<?php
function CheckCurlResponse($code)
    {
	$code=(int)$code;
	$errors=array(
		301=>'Moved permanently',
		400=>'Bad request',
		401=>'Unauthorized',
		403=>'Forbidden',
		404=>'Not found',
		500=>'Internal server error',
		502=>'Bad gateway',
		503=>'Service unavailable'
	);
	try
	{
		#Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
		if($code!=200 && $code!=204)
			throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
	}
	catch(Exception $E)
	{
		die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
	}
    }

$data=array(
    'id'=>isset($_POST['id']) ? $_POST['id'] : 'id',
  	'price'=>isset($_POST['price']) ? $_POST['price'] : 'price',
  	'name'=>isset($_POST['name']) ? $_POST['name'] : 'ss',
    'first_name'=>isset($_POST['first_name']) ? $_POST['first_name'] : 'name',
    'phone'=>isset($_POST['phone']) ? $_POST['phone'] : '',
    'email'=>isset($_POST['email']) ? $_POST['email'] : 'email',
  	'source'=>isset($_POST['source']) ? $_POST['source'] : 'source',
  	'term'=>isset($_POST['term']) ? $_POST['term'] : 'term',
  	'campaign'=>isset($_POST['campaign']) ? $_POST['campaign'] : 'campaign',
  	'idgoo'=>isset($_POST['idgoo']) ? $_POST['idgoo'] : 'idgoo',
  	'message'=>isset($_POST['message']) ? $_POST['message'] : '',
  	'pack'=>isset($_POST['pack']) ? $_POST['pack'] : '',
    'items'=>isset($_POST['items']) ? $_POST['items'] : '',
    'utm'=>isset($_POST['utm']) ? $_POST['utm'] : '',
    'created'=>isset($_POST['created']) ? $_POST['created'] : '',
    'paid'=>isset($_POST['paid']) ? $_POST['paid'] : '',	
    );

#строка ниже используется для тестирования
#чтобы выключить ее - поставьте перед ней значок решетки, чтобы включить - удалите решетку
#require 'test/prepare.php';

if(empty($data['name']))
  die('Не заполнено имя контакта');
if(empty($data['email']))
  die('Не заполнен E-mail контакта');

?>
