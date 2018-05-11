<?php
  if(empty($contact['id'])) { 
    $contact=array(
        'name'=>$data['name'],
	'linked_leads_id'=>array($lead_id),
		'custom_fields'=>array(
      array(
        'id'=>$custom_fields['EMAIL'],
        'values'=>array( # id значений передаются в массиве values через запятую
            array(
            'value'=>$data['email'],
			'enum'=>'PRIV'
			)
        )
      ),
      array(
        'id'=>$custom_fields['PHONE'],
        'values'=>array(
        	array(
            'value'=>$data['phone'],
	        'enum'=>'MOB'
	        )
        )
      ),
      array(
        'id'=>148467, # id поля типа numeric
        'values'=>array(
          array(
            'value'=>$data['source']
          )
        )
      ),
      array(
        'id'=>148471, # id поля типа numeric
        'values'=>array(
          array(
            'value'=>$data['term']
          )
        )
      ),
      array(
        'id'=>148469, # id поля типа numeric
        'values'=>array(
          array(
            'value'=>$data['campaign']
          )
        )
      ),
      array(
        'id'=>149881, # id поля типа numeric
        'values'=>array(
          array(
            'value'=>$data['idgoo']
          )
        )
      )
)
    );
  
  if(!empty($data['message']))
	$contact['custom_fields'][]=array(
		'id'=>62918,
		'values'=>array(
			array(
				'value'=>$data['message'],
				'enum'=>'OTHER'
			)
		)
);

$set['request']['contacts']['add'][]=$contact;

#Формируем ссылку для запроса
$link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/contacts/set';
$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($set));
curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
CheckCurlResponse($code);
    
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
/**
 * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
 * нам придётся перевести ответ в формат, понятный PHP
 */
$Response=json_decode($out,true);
$Response=$Response['response']['contacts']['add'];
 
$output='ID добавленных контактов:'.PHP_EOL;
foreach($Response as $v)
	if(is_array($v))
		$output.=$v['id'].PHP_EOL;
return $output;

}
else {

   $contact=array(
    'id' => $contact['id'],
    'linked_leads_id' => array($lead_id),
    'last_modified' => time(),
    'name' => $data['name'],
    'custom_fields'=>array(
     	array(
        	'id'=>6178,
        	'values'=>array( # id значений передаются в массиве values через запятую
            array(
            	'value'=>$data['email'],
				'enum'=>'PRIV'
				)
        	)
      	)
      )
    );
    
    $set['request']['contacts']['update'][] = $contact;
    
# Create a link for request
$link='https://'.$subdomain.'.amocrm.ru/private/api/v2/json/contacts/set';
$curl=curl_init(); # Save the cURL session handle
# Set the necessary options for cURL session
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($set));
curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
 
$out=curl_exec($curl); # Initiate a request to the API and stores the response to variable
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);

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
  
  
$Response=json_decode($out,true);
$Response2=$Response['response']['contacts']['update'];
echo 'Such Сontact already exists in the CRM. <br> New Lead is added to it.';
}

?>