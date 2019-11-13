<?php

# setta la webhook

// per settare la webhook bisogna andare sul sito qui sotto
/*
compilatelo con i vostri dati ed eliminate le parentesi
https://api.telegram.org/bot{TOKEN DEL BOT}/setWebHook?url={VOSTRO DOMINIO}/{CARTELLA DEL BOT}/{FILE .PHP}
*/

$api = "123456789:ABcdEfgHILmNopqRStUvZ"; // cambialo con il token del tuo bot

$config = [
'userbot' => "@Hard_Robot", // metti l'username del tuo bot
 'passwoard' => 'hardbot', // cambia la passwoard per settare la webhook
'operatori_comandi' => ['/', '!', '.', '>', '?', '$'], // scegli gli alias che vuoi utilizzare (per utilizzarli usare $cmd invece di $text)
'parse_mode' => "HTML", // Scegli HTML o Markdown
'admins' => [911833337, 924430415], // ID degli Amministratori del Bot
'disable_notification' => false, // metti true se vuoi disattivare le notifiche
'disable_web_page_preview' => false, // metti true se vuoi disattivare l'anteprima
# Function addAdmin (il bot deve avere il potere di aggiungere amministratori)
// gli utenti che vengono resi admin che privilegi riceveranno. Modifica qui sotto
'cambiare_info_del_gruppo' => false, // metti true se l'utente reso admin può avere il permesso di modificare le info del gruppo
'cancellare_messaggi' => true, // metti false se l'utente reso admin non deve avere il permesso di cancellare messaggi di altri utenti
'limitare_altri_utenti' => true, // metti false se l'utente reso admin non deve avere il permesso di limitare altri utenti
'fissare_messaggi' => true, // metti false se l'utente reso admin non deve avere il permesso di fissare messaggi
'aggiungere_amministratori' => false // metti true se l'utente reso admin può avere il permesso di aggiungere amministratori
];

# Informazioni del Bot
$botID = str_replace('bot', '', explode(":", $api)[0]); // ID del Bot
$admins = $config['admins']; // Amministratori del Bot

# parse mode
$parse_mode = $config['parse_mode'];

# notifiche
$disable_notification = $config['disable_notification'];

# anteprima
$disable_web_page_preview = $config['disable_web_page_preview'];

# function addAdmin
$can_change_info = $config['cambiare_info_del_gruppo'];
$can_delete_messages = $config['cancellare_messaggi'];
$can_restrict_members = $config['limitare_altri_utenti'];
$can_pin_messages = $config['fissare_messaggi'];
$can_promote_members = $config['aggiungere_amministratori'];
