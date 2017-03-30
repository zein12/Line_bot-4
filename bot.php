<?php 
  
$access_token = '3/cEBpOR0mjAMUtnHKrSrx3N6FnMVNPYfXBIwMO6HNGaljxuxTxZz2fGrmZYFwqfV3dvAWMa7FEGrmOONfbZ7or1wxYgpjbtFMS0Mkk+RftjvYSrUpThxAHGiivf2M662z2zM5P8BSKby0dJiBG3GQdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			switch ($text) {
				case 'halo':
						$text = "Yess sir ! \r\n";
					break;

				case 'tantangan':
						$text = "Tapi itu tidak takut orang. Sering malas dan sombong ! \r\n";
					break;

				case 'ชาญวุฒิ':
						$text = "ไม่มงคลอย่าเอาไม่ตั้งชื่อสิ่งใดๆในจักรวาล เด็ดขาด ! \r\n";
					break;

				case 'บี':
						$text = "ปรมาจารย์สายควัน ! \r\n";
					break;

				case 'ต่อ':
						$text = "สิงห์รถบรรทุก กรุงเทพฯ - ระยอง ! \r\n";
					break;

				case 'ต้นปาล์ม':
						$text = "Prefect Man ! \r\n";
					break;

				case 'ปุ๊ก':
						$text = "น่ารักอะ อิอิ ! \r\n";
					break;

				case 'มะปราง':
						$text = "ติ่งเกาหลี ลีมินโฮ ! \r\n";
					break;

				case 'ลูกปลา':
						$text = "กินได้ตลอดเวลา ! \r\n";
					break;

				case 'NF':
						$text = "naon sih ! \r\n";
					break;

				case 'thaipbs':
						$text = "redirect('http://thaipbs.or.th'); \r\n";
					break;
				
				default:
						$text = "Apa ! Saya tidak cukup cerdas Tapi lebih pintar dari Anda\r\n";
					break;
			}

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
