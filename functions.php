<?php

require_once 'variables.php';

$url = "https://api.telegram.org/bot$api";

// non ci sono tutte le function, ci sono solo quelle base. Per evitare "pappa pronta".

function sm($chat_id, $text, $reply_to_message_id = null, $reply_markup = null)
{
global $url;
global $parse_mode;
global $disable_notification;
global $disable_web_page_preview;
if(isset($reply_markup))
{
$menu = json_encode($reply_markup);
}
file_get_contents("$url/sendMessage?chat_id=$chat_id&text=". urlencode($text) ."&reply_to_message_id=$reply_to_message_id&reply_markup=$menu&parse_mode=$parse_mode&disable_notification=$disable_notification&disable_web_page_preview=$disable_web_page_preview");
}

function fm($chat_id, $from_chat_id, $message_id)
{
global $url;
global $disable_notification;
file_get_contents("$url/forwardMessage?chat_id=$chat_id&from_chat_id=$from_chat_id&message_id=$message_id&disable_notification=$disable_notification");
}

function sendPhoto($chat_id, $photo, $caption = null, $reply_to_message_id = null, $reply_markup = null)
{
global $url;
global $parse_mode;
global $disable_notification;
if(isset($reply_markup))
{
$menu = json_encode($reply_markup);
}
file_get_contents("$url/sendPhoto?chat_id=$chat_id&photo=$photo&caption=". urlencode($caption) ."&reply_to_message_id=$reply_to_message_id&reply_markup=$menu&parse_mode=$parse_mode&disable_notification=$disable_notification");
}

function sendAudio($chat_id, $audio, $caption = null, $duration = null, $performer = null, $title = null, $thumb = null, $reply_to_message_id = null, $reply_markup = null)
{
global $url;
global $parse_mode;
global $disable_notification;
if(isset($reply_markup))
{
$menu = json_encode($reply_markup);
}
file_get_contents("$url/sendAudio?chat_id=$chat_id&audio=$audio&caption=". urlencode($caption) ."&duration=$duration&performer=$performer&title=$title&thumb=$thumb&reply_to_message_id=$reply_to_message_id&reply_markup=$menu&parse_mode=$parse_mode&disable_notification=$disable_notification");
}

function sendDocument($chat_id, $document, $thumb = null, $caption = null, $reply_to_message_id = null, $reply_markup = null)
{
global $url;
global $parse_mode;
global $disable_notification;    
if(isset($reply_markup))
{
$menu = json_encode($reply_markup);
}
file_get_contents("$url/sendDocument?chat_id=$chat_id&document=$document&thumb=$thumb&caption=". urlencode($caption) ."&reply_to_message_id=$reply_to_message_id&parse_mode=$parse_mode&disable_notification=$disable_notification&reply_markup=$menu");
}

function sendVideo($chat_id, $video, $caption = null, $duration = null, $width = null, $height = null, $thumb = null, $supports_streaming = null, $reply_to_message_id = null, $reply_markup = null)
{
global $url;
global $parse_mode;
global $disable_notification; 
if(isset($reply_markup))
{
  $menu = json_encode($reply_markup);
}
file_get_contents("$url/sendVideo?chat_id=$chat_id&video=$video&caption=" . urlencode($caption) . "&duration=$duration&width=$width&height=$height&thumb=$thumb&supports_streaming=$supports_streaming&reply_to_message_id=$reply_to_message_id&reply_markup=$menu&parse_mode=$parse_mode&disable_notification=$disable_notification");
}

function getFile($file_id)
{
    global $url;
global $api;
$a = file_get_contents("$url/getFile?file_id=$file_id");
$ar = json_decode($a, true);
$file_path = $ar['result']['file_path'];
return file_get_contents("https://api.telegram.org/file/bot$api/$file_path");
}

function fotoUtente($user_id, $offset = null, $limit = null)
{
    global $url;
    $a = file_get_contents("$url/getUserProfilePhotos?user_id=$user_id&offset=$offset&limit=$limit");
    $b = json_decode($a, true);
    return $b['result']['photos']['0']['0']['file_id'];
}

function ban($chat_id, $user_id, $until_date = null)
{
    global $url;
    file_get_contents("$url/kickChatMember?chat_id=$chat_id&user_id=$user_id&until_date=$until_date");
}

function unban($chat_id, $user_id)
{
 global $url;
    file_get_contents("$url/unbanChatMember?chat_id=$chat_id&user_id=$user_id");    
}

function esci($chat_id)
{
    global $url;
    file_get_contents("$url/leaveChat?chat_id=$chat_id");
}

function contaMembri($chat_id)
{
    global $url;
    $rr = file_get_contents("$url/getChatMembersCount?chat_id=$chat_id");
    $ar = json_decode($rr, true);
    return $ar["result"];
}

function getLink($chat_id)
{
 global $url;
 $rr = file_get_contents("$url/exportChatInviteLink?chat_id=$chat_id");
 $ar = json_decode($rr, true);
 return $ar['result'];
}

function addAdmin($chat_id, $user_id)
{
    global $url;
    global $can_change_info;
    global $can_delete_messages;
    global $can_restrict_members;
    global $can_pin_messages;
    global $can_promote_members;
    file_get_contents("$url/promoteChatMember?chat_id=$chat_id&user_id=$user_id&can_change_info=$can_change_info&can_delete_messages=$can_delete_messages&can_restrict_members=$can_restrict_members&can_pin_messages=$can_pin_messages&can_promote_members=$can_promote_members");
}

function editMessageText($text, $chat_id, $message_id, $inline_message_id = null, $reply_markup = null)
{
global $url;
global $parse_mode;
global $disable_web_page_preview;
if(isset($reply_markup))
{
$menu = json_encode($reply_markup);   
}
file_get_contents("$url/editMessageText?text=" . urlencode($text) . "&chat_id=$chat_id&message_id=$message_id&inline_message_id=$inline_message_id&reply_markup=$menu&parse_mode=$parse_mode&disable_web_page_preview=$disable_web_page_preview");
}

function deleteMessage($chat_id, $message_id)
{
    global $url;
    file_get_contents("$url/deleteMessage?chat_id=$chat_id&message_id=$message_id");
}

function mute($chat_id, $user_id, $until_date = null)
{
global $url;
file_get_contents("$url/restrictChatMember?chat_id=$chat_id&user_id=$user_id&until_date=$until_date&can_send_messages=false");  
}

function unmute($chat_id, $user_id, $until_date = null)
{
global $url;
file_get_contents("$url/restrictChatMember?chat_id=$chat_id&user_id=$user_id&until_date=$until_date&can_send_messages=true&can_send_media_messages=true&can_send_polls=true&can_send_other_messages=true&can_add_web_page_previews=true");  
}

function sendPoll($chat_id, $question, $options, $reply_to_message_id = null, $reply_markup = null)
{
  global $url;
  global $disable_notification;
  if(isset($reply_markup))
  {
    $menu = json_encode($reply_markup);
  }
  $json = json_encode($options);
  $a = file_get_contents("$url/sendPoll?chat_id=$chat_id&question=" . urlencode($question) . "&options=$json&disable_notification=$disable_notification&reply_to_message_id=$reply_to_message_id&reply_markup=$menu");
$ar = json_decode($a, true);
return $ar;
}

function stopPoll($chat_id, $message_id, $reply_markup = null)
{
    global $url;
    if(isset($reply_markup))
    {
        $menu = json_encode($reply_markup);
    }
$a = file_get_contents("$url/stopPoll?chat_id=$chat_id&message_id=$message_id&reply_markup=$menu");
$ar = json_decode($a, true);
return $ar;
}

function answerCallbackQuery($callback_query_id, $text = null, $show_alert = null, $urll = null, $cache_time = null)
{
    global $url;
    $a = file_get_contents("$url/answerCallbackQuery?callback_query_id=$callback_query_id&text=" . urlencode($text) . "&show_alert=$show_alert&url=$urll&cache_time=$cache_time");
$ar = json_decode($a, true);
return $ar;
}

function pinChatMessage($chat_id, $message_id)
{
    global $url;
    global $disable_notification;
    $a = file_get_contents("$url/pinChatMessage?chat_id=$chat_id&message_id=$message_id&disable_notification=$disable_notification");
    $ar = json_decode($a, true);
return $ar;
}

function unpinChatMessage($chat_id)
{
    global $url;
    $a = file_get_contents("$url/unpinChatMessage?chat_id=$chat_id");
        $ar = json_decode($a, true);
return $ar;
}

function getChatMember($chat_id, $user_id)
{
    global $url;
    $a = file_get_contents("$url/getChatMember?chat_id=$chat_id&user_id=$user_id");
        $ar = json_decode($a, true);
return $ar;
}

function getChat($chat_id)
{
    global $url;
    $a = file_get_contents("$url/getChat?chat_id=$chat_id");
        $ar = json_decode($a, true);
return $ar;
}

function getChatAdministrators($chat_id)
{
    global $url;
    $a = file_get_contents("$url/getChatAdministrators?chat_id=$chat_id");
        $ar = json_decode($a, true);
return $ar;  
}
