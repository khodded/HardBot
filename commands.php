<?php  

require_once 'functions.php';

# passwoard per settare la webhook
$passwoardwb = $config['passwoard'];

# start
if (stripos($cmd, 'start') === 0 or stripos($cmd, 'help') === 0) {
sm($chat_id, "Salve @$username" . PHP_EOL . 'Usufruisci questa base al meglio per programmare dei bot professionali da utilizzare su Telegram');
}

# manda sondaggio
if($text == "/poll")
{
    $menu['inline_keyboard'] = [[[ 'text' => 'chiudi sondaggio', 'callback_data' => 'stoppoll']]];
    $poll = ['no','si'];
    sendPoll($chat_id, "Ti piace la fika?", $poll, false, $menu);
}

# stoppa sondaggio
if($cbdata == 'stoppoll')
{
    if(in_array($userID, $admins))
    {
    stopPoll($chat_id, $cbmid);
} else {
 answerCallbackQuery($cbid, "Non sei admin del bot.", true);   
}
}

# comando staff
if($cmd == "staff")
{
$a = getChatAdministrators($chat_id);
foreach($a['result'] as $b) 
{
$staff .= "@". $b['user']['username'] . PHP_EOL;
}
sm($chat_id, "<b>STAFF del GRUPPO</>\n\n<b>ADMINS</>\n$staff");
}
