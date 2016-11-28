<?php 
  
$access_token = 'SgzRYItJH9a9DBXajfmSOPP2LalYt4wgIx1fVmy5QVquT5GHhyDk4pZsG2sORBFd+gIQJxELmgnW17qUVVo2ss1CRAWU/kGHPCBUypto+RF9pVGJ8wrAl4XVXcrB0PQKCQnb4aqN6YRK0gmHlg6Q8QdB04t89/1O/w1cDnyilFU=';

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
				case 'สวัสดี':
						$text = "เออ ไหว้พระเถอะลูก ! \r\n";
					break;

				case 'กล้า':
						$text = "แปลว่า ไม่กลัว แต่ถ้าเป็นชื่อคน มักขี้เกียจและขี้โม้ ! \r\n";
					break;

				case 'ชาญวุฒิ':
						$text = "ไม่มงคลอย่าเอาไม่ตั้งชื่อสิ่งใดๆในจักรวาล เด็ดขาด ! \r\n";
					break;

				case 'thaipbs':
						$text = "http://thaipbs.or.th \r\n";
					break;
				
				default:
						$text = "อะไรเนี่ย ! ฉันยังฉลาดไม่พอ แต่ฉลาดกว่าคุณ\r\n";
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