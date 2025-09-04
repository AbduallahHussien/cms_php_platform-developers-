<?php

namespace Botble\Whatsapp\Http\Services;


class UltramsgService
{
	protected $token = '';
	protected $instance_id = '';
	protected $whatsappId = '';

	/**
	 * Ultramsg constructor.
	 * @param $token
	 * @param $instance_id
	 */
	public function __construct($token, $instance_id,$whatsappId)
	{
		$this->token = $token;
		$this->instance_id = "instance" . preg_replace('/[^0-9]/', '', $instance_id);
		$this->whatsappId = $whatsappId;
	}

	// messages
	public function getMessages($page = 1, $limit = 100, $status = "all", $sort = "asc", $id = "", $referenceId = "", $from = "", $to = "", $ack = "")
	{
		$params = array("page" => $page, "limit" => $limit, "status" => $status, "sort" => $sort, "id" => $id, "referenceId" => $referenceId, "from" => $from, "to" => $to, "ack" => $ack);
		return $this->sendRequest("GET", "messages", $params);
	}

	public function getMessageStatistics()
	{
		return $this->sendRequest("GET", "messages/statistics");
	}

	public function sendChatMessage($to, $body, $priority = 10, $referenceId = "")
	{
		$params = array("to" => $to, "body" => $body, "priority" => $priority, "referenceId" => $referenceId);
		return $this->sendRequest("POST", "messages/chat", $params);
	}

	public function sendImageMessage($to, $image, $caption = '', $priority = 0, $referenceId = '', $nocache = '')
	{
		return $this->sendRequest("POST", "messages/image", [
			'to' => $to,
			'image' => $image,
			'caption' => $caption,
			'priority' => $priority,
			'referenceId' => $referenceId,
			'nocache' => $nocache,
			'msgId' => '',
			'mentions' => ''
		]);
	}
	public function sendStickerMessage($to, $sticker, $priority = 10, $referenceId = "", $nocache = false)
	{
		$params = array("to" => $to, "sticker" => $sticker, "priority" => $priority, "referenceId" => $referenceId, "nocache" => $nocache);
		return $this->sendRequest("POST", "messages/sticker", $params);
	}

	public function sendDocumentMessage($to, $filename, $document, $caption = "", $priority = 10, $referenceId = "", $nocache = false)
	{
		$params = array("to" => $to, "filename" => $filename, "document" => $document, "caption" => $caption, "priority" => $priority, "referenceId" => $referenceId, "nocache" => $nocache);
		return $this->sendRequest("POST", "messages/document", $params);
	}

	public function sendAudioMessage($to, $audio, $priority = 10, $referenceId = "", $nocache = false)
	{
		$params = array("to" => $to, "audio" => $audio, "priority" => $priority, "referenceId" => $referenceId, "nocache" => $nocache);
		return $this->sendRequest("POST", "messages/audio", $params);
	}

	public function sendVoiceMessage($to, $audio, $priority = 10, $referenceId = "", $nocache = '')
	{
		$params = array("to" => $to, "audio" => $audio, "priority" => $priority, "referenceId" => $referenceId, "nocache" => $nocache);
		return $this->sendRequest("POST", "messages/voice", $params);
	}

	public function sendVideoMessage($to, $video, $caption = "", $priority = 10, $referenceId = "", $nocache = false)
	{
		$params = array("to" => $to, "caption" => $caption, "video" => $video, "priority" => $priority, "referenceId" => $referenceId, "nocache" => $nocache);
		return $this->sendRequest("POST", "messages/video", $params);
	}

	public function sendLinkMessage($to, $link, $priority = 10, $referenceId = "")
	{
		$params = array("to" => $to, "link" => $link, "priority" => $priority, "referenceId" => $referenceId);
		return $this->sendRequest("POST", "messages/link", $params);
	}

	public function sendContactMessage($to, $contact, $priority = 10, $referenceId = "")
	{
		$params = array("to" => $to, "contact" => $contact, "priority" => $priority, "referenceId" => $referenceId);
		return $this->sendRequest("POST", "messages/contact", $params);
	}
	public function sendLocationMessage($to, $address, $lat, $lng, $priority = 10, $referenceId = "")
	{
		$params = array("to" => $to, "address" => $address, "lat" => $lat, "lng" => $lng, "priority" => $priority, "referenceId" => $referenceId);
		return $this->sendRequest("POST", "messages/location", $params);
	}
	public function sendVcardMessage($to, $vcard, $priority = 10, $referenceId = "")
	{
		$params = array("to" => $to, "vcard" => $vcard, "priority" => $priority, "referenceId" => $referenceId);
		return $this->sendRequest("POST", "messages/vcard", $params);
	}
	public function sendClearMessage($status)
	{
		$params = array("status" => $status);
		return $this->sendRequest("POST", "messages/clear", $params);
	}
	public function resendByStatus($status)
	{
		$params = array("status" => $status);
		return $this->sendRequest("POST", "messages/resendByStatus", $params);
	}

	public function resendById($id)
	{
		$params = array("id" => $id);
		return $this->sendRequest("POST", "messages/resendById", $params);
	}

	// instance

	public function getInstanceStatus()
	{
		return $this->sendRequest("GET", "instance/status");
	}

	public function getInstanceQr()
	{
		return $this->sendRequest("GET", "instance/qr");
	}

	public function getInstanceQrCode()
	{
		return $this->sendRequest("GET", "instance/qrCode");
	}

	public function getInstanceScreenshot($encoding = "")
	{
		return $this->sendRequest("GET", "instance/screenshot", array("encoding" => $encoding));
	}

	public function getInstanceMe($instanceId,$token)
	{
		$this->instance_id = $instanceId;
		$this->token = $token;
		return $this->sendRequest("GET", "instance/me");
	}

	public function getInstanceSettings()
	{
		return $this->sendRequest("GET", "instance/settings");
	}

	public function sendInstanceTakeover()
	{
		return $this->sendRequest("POST", "instance/takeover");
	}

	public function sendInstanceLogout()
	{
		return $this->sendRequest("POST", "instance/logout");
	}

	public function sendInstanceRestart()
	{
		return $this->sendRequest("POST", "instance/restart");
	}

	public function sendInstanceSettings($sendDelay = "1", $webhook_url = "", $webhook_message_received = false, $webhook_message_create = false, $webhook_message_ack = false, $webhook_message_download_media = false)
	{
		$params = array("sendDelay" => $sendDelay, "webhook_url" => $webhook_url, "webhook_message_received" => json_encode($webhook_message_received), "webhook_message_create" => json_encode($webhook_message_create), "webhook_message_ack" => json_encode($webhook_message_ack), "webhook_message_download_media" => json_encode($webhook_message_download_media));
		return $this->sendRequest("POST", "instance/settings", $params);
	}

	public function sendInstanceClear()
	{
		return $this->sendRequest("POST", "instance/clear");
	}

	// Chats

	public function getChats()
	{
		return $this->sendRequest("GET", "chats");
	}

	public function getChatsMessages($chatId, $limit = 100)
	{
		$params = array("chatId" => $chatId, "limit" => $limit);
		return $this->sendRequest("GET", "chats/messages", $params);
	}

	// Contacts

	public function getContacts()
	{
		return $this->sendRequest("GET", "contacts");
	}

	public function getContact($chatId)
	{
		$params = array("chatId" => $chatId);
		return $this->sendRequest("GET", "contacts/contact", $params);
	}

	public function getBlockedContacts()
	{
		return $this->sendRequest("GET", "contacts/blocked");
	}

	public function checkContact($chatId)
	{
		$params = array("chatId" => $chatId);
		return $this->sendRequest("GET", "contacts/check", $params);
	}

	public function blockContact($chatId)
	{
		$params = array("chatId" => $chatId);
		return $this->sendRequest("POST", "contacts/block", $params);
	}

	public function unblockContact($chatId)
	{
		$params = array("chatId" => $chatId);
		return $this->sendRequest("POST", "contacts/unblock", $params);
	}

	public function sendRequest($method, $path, $params = array())
	{

		// if (array_key_exists('image', $params)) {
		// 	$params['image'] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Cognac_glass.jpg/960px-Cognac_glass.jpg';
		// }


		// info('params');
		// info($params);
		if (!is_callable('curl_init')) {
			return array("Error" => "cURL extension is disabled on your server");
		}
		$url = "https://api.ultramsg.com/" . $this->instance_id . "/" . $path;
		$params['token'] = $this->token;
		$data = http_build_query($params);
		if (strtolower($method) == "get") $url = $url . '?' . $data;
		$curl = curl_init($url);
		if (strtolower($method) == "post") {
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, 1);
		$response = curl_exec($curl);
		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		if ($httpCode == 404) {
			return array("Error" => "instance not found or pending please check you instance id");
		}
		$contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
		$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		$header = substr($response, 0, $header_size);
		$body = substr($response, $header_size);
		curl_close($curl);

		if (strpos($contentType, 'application/json') !== false) {
			return json_decode($body, true);
		}
		return $body;
	}


	// public function sendRequest($method, $path, $params = [])
	// {
	// 	if (!is_callable('curl_init')) {
	// 		return ["Error" => "cURL extension is disabled on your server"];
	// 	}

	// 	$url = "https://api.ultramsg.com/" . $this->instance_id . "/" . $path;
	// 	$params['token'] = $this->token; 
	// 	$params['image'] ='https://ea64bd7e97b7.ngrok-free.app/storage/images/6899bdddce3e1.jpeg';
	// 	// $params['image'] = 'https://media.istockphoto.com/id/1300845620/vector/user-icon-flat-isolated-on-white-background-user-symbol-vector-illustration.jpg?s=612x612&w=0&k=20&c=yBeyba0hUkh14_jgv1OKqIH0CCSWU_4ckRkAoy2p73o=';

	// 	info('params image');
	// 	info($params['image']);
	// 	$curl = curl_init($url);

	// 	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	// 	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	// 	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($curl, CURLOPT_HTTPHEADER, [
	// 		'Content-Type: application/json'
	// 	]);

	// 	if (strtolower($method) == "post") {
	// 		curl_setopt($curl, CURLOPT_POST, true);
	// 		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
	// 	}

	// 	$response = curl_exec($curl);
	// 	$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	// 	curl_close($curl);

	// 	if ($httpCode == 404) {
	// 		return ["Error" => "instance not found or pending please check your instance id"];
	// 	}

	// 	return json_decode($response, true);
	// }



}
