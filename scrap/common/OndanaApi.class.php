<?php

class OndanaApi {

    public static function getItem($type, $version, $siteId, $params = array()) {
    	$params['type'] = $type;
    	$params['version'] = $version;
    	$params['siteId'] = $siteId;
// print_r($params);
// exit;
		$curl=curl_init("https://api.ondana.jp/api/books");
		curl_setopt($curl,CURLOPT_POST, TRUE);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, FALSE);  // オレオレ証明書対策
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, FALSE);  // 
		curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE);
		// curl_setopt($curl,CURLOPT_COOKIEJAR,      'cookie');
		// curl_setopt($curl,CURLOPT_COOKIEFILE,     'tmp');
		curl_setopt($curl,CURLOPT_FOLLOWLOCATION, TRUE); // Locationヘッダを追跡
		$output = curl_exec($curl);
		
		$item = json_decode($output, true);
		if ($item['result']) {
			$item = $item['bookList'][0];
		}
		else {
			$item = array();
		}

		return $item;
	}
}