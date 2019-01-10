<?php
	require "vendor/autoload.php";

	$access_token = '2lCdm/gOh0aY91WBYgSIElqBhaBdO5JQ4TGsEaMAXg1dIK2+JNajDLdHslTpoVYpNsEcAibd6dS9qCVYgsKSNAIlb0SpjOx/il1l/5ieloAM/ornHV78rqCeLnaG2tgyXyOjk43pbpeJu9IhA3ucawdB04t89/1O/w1cDnyilFU=';
	$channelSecret = 'e73404a79308ea3273455ad514fa432b';


	$content = file_get_contents('php://input');
	$arrayJson = json_decode($content, true);
	$arrayHeader = array();
	$arrayHeader[] = "Content-Type: application/json";
	$arrayHeader[] = "Authorization: Bearer {$accessToken}";

	$idPush = $arrayJson['events'][0]['source']['userId'];

	$message = $arrayJson['events'][0]['message']['text'];

	$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
	$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
	$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
	$response = $bot->pushMessage($idPush, $textMessageBuilder);

	echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
?>