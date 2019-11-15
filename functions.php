<?php

require_once 'variables.php';

$url = "https://api.telegram.org/bot$api";

// non ci sono tutte le function, ci sono solo quelle base. Per evitare "pappa pronta".

# function curlRequest
function sendRequest($metodo, $array)
{
    global $request_timeout;

            $a = curl_init();
            if ($array) {
                global $url;
            }

curl_setopt_array($a, [
                CURLOPT_POST           => true,
                CURLOPT_CONNECTTIMEOUT => $request_timeout,
                CURLOPT_HEADER         => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL            => $url . '/' . $metodo,
                CURLOPT_POSTFIELDS     => $array,
                CURLOPT_HTTPHEADER     => ["Connection: Keep-Alive", "Keep-Alive: 120"]
    ]);

$b = curl_exec($a);
        curl_close($a);
    return $b;
}

function sm($chat_id, $text, $reply_to_message_id = null, $reply_markup = null)
{
global $parse_mode;
global $disable_notification;
global $disable_web_page_preview;
$array = [
'chat_id' => $chat_id,
'text' => $text
    ];
if(isset($reply_markup))
{
$menu = json_encode($reply_markup);
$array['reply_markup'] = $menu;
}
if(isset($reply_to_message_id))
{
$array['reply_to_message_id'] = $reply_to_message_id;
}
$array['parse_mode'] = $parse_mode;
$array['disable_notification'] = $disable_notification;
$array['disable_web_page_preview'] = $disable_web_page_preview;
$ar = sendRequest('sendMessage', $array);
$rr = json_decode($ar, true);
return $rr;
}

function fm($chat_id, $from_chat_id, $message_id)
{
global $disable_notification;
$array = [
'chat_id' => $chat_id,
'from_chat_id' => $from_chat_id,
'message_id' => $message_id
];
$array['disable_notification'] = $disable_notification;
$ar = sendRequest('forwardMessage', $array);
$rr = json_decode($ar, true);
return $rr;
}

function sendPhoto($chat_id, $photo, $caption = null, $reply_to_message_id = null, $reply_markup = null)
{
global $parse_mode;
global $disable_notification;
$array = [
'chat_id' => $chat_id,
'photo' => $photo
];
if(isset($reply_markup))
{
$menu = json_encode($reply_markup);
$array['reply_markup'] = $menu;
}
if(isset($caption))
{
$array['caption'] = $caption;
}
if(isset($reply_to_message_id))
{
$array['reply_to_message_id'] = $reply_to_message_id;
}
$array['parse_mode'] = $parse_mode;
$array['disable_notification'] = $disable_notification;
$ar = sendRequest('sendPhoto', $array);
$rr = json_decode($ar, true);
return $rr;
}

function sendAudio($chat_id, $audio, $caption = null, $duration = null, $performer = null, $title = null, $thumb = null, $reply_to_message_id = null, $reply_markup = null)
{
global $parse_mode;
global $disable_notification;
$array = [
'chat_id' => $chat_id,
'audio' => $audio
];
if(isset($reply_markup))
{
$menu = json_encode($reply_markup);
$array['reply_markup'] = $menu;
}
if(isset($duration))
{
  $array['duration'] = $duration;
}
if(isset($performer))
{
  $array['performer'] = $performer;
}
if(isset($title))
{
  $array['title'] = $title;
}
if(isset($thumb))
{
  $array['thumb'] = $thumb;
}
if(isset($reply_to_message_id))
{
  $array['reply_to_message_id'] = $reply_to_message_id;
}
$array['parse_mode'] = $parse_mode;
$array['disable_notification'] = $disable_notification;
$rr = sendRequest('sendAudio', $array);
$ar = json_decode($rr, true);
return $ar;
}

function sendDocument($chat_id, $document, $thumb = null, $caption = null, $reply_to_message_id = null, $reply_markup = null)
{
global $parse_mode;
global $disable_notification;
$array = [
'chat_id' => $chat_id,
'document' => $document
];
if(isset($reply_markup))
{
$menu = json_encode($reply_markup);
$array['reply_markup'] = $menu;
}
if(isset($thumb))
{
$array['thumb'] = $thumb;
}
if(isset($caption))
{
$array['caption'] = $caption;
}
if(isset($reply_to_message_id))
{
$array['reply_to_message_id'] = $reply_to_message_id;
}
$array['parse_mode'] = $parse_mode;
$array['disable_notification'] = $disable_notification;
$rr = sendRequest('sendDocument', $array);
$ar = json_decode($rr, true);
return $ar;
}

function sendVideo($chat_id, $video, $caption = null, $duration = null, $width = null, $height = null, $thumb = null, $supports_streaming = null, $reply_to_message_id = null, $reply_markup = null)
{
global $parse_mode;
global $disable_notification;
$array = [
'chat_id' => $chat_id,
'video' => $video
];
if(isset($reply_markup))
{
  $menu = json_encode($reply_markup);
  $array['reply_markup'] = $menu;
}
if(isset($caption))
{
  $array['caption'] = $caption;
}
if(isset($duration))
{
  $array['duration'] = $duration;
}
if(isset($width))
{
  $array['width'] = $width;
}
if(isset($height))
{
  $array['height'] = $height;
}
if(isset($thumb))
{
  $array['thumb'] = $thumb;
}
if(isset($supports_streaming))
{
  $array['supports_streaming'] = $supports_streaming;
}
if(isset($reply_to_message_id))
{
  $array['reply_to_message_id'] = $reply_to_message_id;
}
$array['parse_mode'] = $parse_mode;
$array['disable_notification'] = $disable_notification;
$rr = sendRequest('sendVideo', $array);
$ar = json_decode($rr, true);
return $ar;
}

function getFile($file_id)
{
global $api;
$array = [
  'file_id' => $file_id
];
$a = sendRequest('getFile', $array);
$ar = json_decode($a, true);
$file_path = $ar['result']['file_path'];
return file_get_contents("https://api.telegram.org/file/bot$api/$file_path");
}

function fotoUtente($user_id, $offset = null, $limit = null)
{
  $array = [
    'user_id' => $user_id
  ];
  if(isset($offset))
  {
    $array['offset'] = $offset;
  }
  if(isset($limit))
  {
    $array['limit'] = $limit;
  }
    $ar = sendRequest('getUserProfilePhotos', $array);
    $rr = json_decode($ar, true);
    return $rr['result']['photos']['0']['0']['file_id'];
}

function ban($chat_id, $user_id, $until_date = null)
{
    $array = [
      'chat_id' => $chat_id,
    'user_id' => $user_id
  ];
  if(isset($until_date))
  {
    $array['until_date'] = $until_date;
  }
    $rr = sendRequest('kickChatMember', $array);
    $ar = json_decode($rr, true);
    return $ar;
}

function unban($chat_id, $user_id)
{
  $array = [
    'chat_id' => $chat_id,
  'user_id' => $user_id
];
    $rr = sendRequest('unbanChatMember', $array);
    $ar = json_decode($rr, true);
    return $ar;
}

function esci($chat_id)
{
  $array = [
    'chat_id' => $chat_id
  ];
    sendRequest('leaveChat', $array);
}

function contaMembri($chat_id)
{
    $array = [
      'chat_id' => $chat_id
    ];
    $rr = sendRequest('getChatMembersCount', $array);
    $ar = json_decode($rr, true);
    return $ar['result'];
}

function getLink($chat_id)
{
  $array = [
    'chat_id' => $chat_id
  ];
 $rr = sendRequest('exportChatInviteLink', $array);
 $ar = json_decode($rr, true);
 return $ar['result'];
}

function addAdmin($chat_id, $user_id)
{
    global $can_change_info;
    global $can_delete_messages;
    global $can_restrict_members;
    global $can_pin_messages;
    global $can_promote_members;
    $array = [
      'chat_id' => $chat_id,
      'user_id' => $user_id
    ];
    $array['can_change_info'] = $can_change_info;
    $array['can_delete_messages'] = $can_delete_messages;
    $array['can_restrict_members'] = $can_restrict_members;
    $array['can_pin_messages'] = $can_pin_messages;
    $array['can_promote_members'] = $can_promote_members;
    $rr = sendRequest('promoteChatMember', $array);
    $ar = json_decode($rr, true);
    return $ar;
}

function editMessageText($text, $chat_id, $message_id, $inline_message_id = null, $reply_markup = null)
{
global $parse_mode;
global $disable_web_page_preview;
$array = [
  'text' => $text,
  'chat_id' => $chat_id,
  'message_id' => $message_id
];
if(isset($reply_markup))
{
$menu = json_encode($reply_markup);
$array['reply_markup'] = $menu;
}
if(isset($inline_message_id))
{
$array['inline_message_id'] = $inline_message_id;
}
$array['parse_mode'] = $parse_mode;
$array['disable_web_page_preview'] = $disable_web_page_preview;
$rr = sendRequest('editMessageText', $array);
$ar = json_decode($rr, true);
return $ar;
}

function deleteMessage($chat_id, $message_id)
{
  $array = [
    'chat_id' => $chat_id,
    'message_id' => $message_id
  ];
    $rr = sendRequest('deleteMessage', $array);
    $ar = json_decode($rr, true);
    return $ar;
}

function mute($chat_id, $user_id, $until_date = null)
{
$array = [
  'chat_id' => $chat_id,
  'user_id' => $user_id
];
if(isset($until_date))
{
$array['until_date'] = $until_date;
}
$array['can_send_messages'] = false;
$rr = sendRequest('restrictChatMember', $array);
$ar = json_decode($rr, true);
return $ar;
}

function unmute($chat_id, $user_id, $until_date = null)
{
  $array = [
    'chat_id' => $chat_id,
    'user_id' => $user_id
  ];
  if(isset($until_date))
  {
  $array['until_date'] = $until_date;
  }
  $array['can_send_messages'] = true;
  $array['can_send_media_messages'] = true;
  $array['can_send_polls'] = true;
  $array['can_send_other_messages'] = true;
  $array['can_add_web_page_previews'] = true;
  $rr = sendRequest('restrictChatMember', $array);
  $ar = json_decode($rr, true);
  return $ar;
}

function sendPoll($chat_id, $question, $options, $reply_to_message_id = null, $reply_markup = null)
{
  global $disable_notification;
  $json = json_encode($options);
  $array = [
    'chat_id' => $chat_id,
    'question' => $question,
    'options' => $json
  ];
  if(isset($reply_markup))
  {
    $menu = json_encode($reply_markup);
    $array['reply_markup'] = $menu;
  }
  if(isset($reply_to_message_id))
  {
    $array['reply_to_message_id'] = $reply_to_message_id;
  }
  $array['disable_notification'] = $disable_notification;
  $rr = sendRequest('sendPoll', $array);
  $ar = json_decode($rr, true);
return $ar;
}

function stopPoll($chat_id, $message_id, $reply_markup = null)
{
  $array = [
    'chat_id' => $chat_id,
    'message_id' => $message_id
  ];
    if(isset($reply_markup))
    {
        $menu = json_encode($reply_markup);
        $array['reply_markup'] = $menu;
    }
$rr = sendRequest('stopPoll', $array);
$ar = json_decode($rr, true);
return $ar;
}

function answerCallbackQuery($callback_query_id, $text = null, $show_alert = null, $urll = null, $cache_time = null)
{
  $array = [
    'callback_query_id' => $callback_query_id
  ];
  if(isset($text))
  {
    $array['text'] = $text;
  }
  if(isset($show_alert))
  {
    $array['show_alert'] = $show_alert;
  }
  if(isset($urll))
  {
    $array['url'] = $urll;
  }
  if(isset($cache_time))
  {
    $array['cache_time'] = $cache_time;
  }
    $rr = sendRequest('answerCallbackQuery', $array);
$ar = json_decode($rr, true);
return $ar;
}

function pinChatMessage($chat_id, $message_id)
{
    global $disable_notification;
    $array = [
      'chat_id' => $chat_id,
      'message_id' => $message_id
    ];
    $array['disable_notification'] = $disable_notification;
    $rr = sendRequest('pinChatMessage', $array);
    $ar = json_decode($rr, true);
return $ar;
}

function unpinChatMessage($chat_id)
{
  $array = [
    'chat_id' => $chat_id,
  ];
  $rr = sendRequest('unpinChatMessage', $array);
  $ar = json_decode($rr, true);
return $ar;
}

function getChatMember($chat_id, $user_id)
{
  $array = [
    'chat_id' => $chat_id,
    'user_id' => $user_id
  ];  
    $rr = sendRequest('getChatMember', $array);
        $ar = json_decode($rr, true);
return $ar;
}

function getChat($chat_id)
{
  $array = [
    'chat_id' => $chat_id,
  ];
    $rr = sendRequest('getChat', $array);
        $ar = json_decode($rr, true);
return $ar;
}

function getChatAdministrators($chat_id)
{
  $array = [
    'chat_id' => $chat_id,
  ];
    $rr = sendRequest('getChatAdministrators', $array);
        $ar = json_decode($rr, true);
return $ar;
}
