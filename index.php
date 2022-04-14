<?php

$token="SEU_TOKEN_AKI";
$url="https://api.telegram.org/bot{$token}";
$group_name = 'NOME_DO_BOT';
$offset = 0;

while(true){

  $get_msg = file_get_contents($url."/getUpdates?offset={$offset}");
  $get_msg_decode = json_decode($get_msg);

  if( isset($get_msg_decode->result) ){

    foreach($get_msg_decode->result as $row){

      $offset = $row->update_id+1;

      $resp = $row->message->text;

      $user_id = $row->message->chat->id;
      $first_name = $row->message->chat->first_name;

      if($resp == '1'){

        $mensagem=urlencode("{$first_name}, seu pedido foi Hamburguer à R$ 6,00 (s/n)?");
      
      } else if($resp == '2'){

        $mensagem=urlencode("{$first_name}, seu pedido foi Chess Burguer à R$ 8,00 (s/n)?");

      } else if($resp == '3'){
        
        $mensagem=urlencode("{$first_name}, seu pedido foi X-tudo Burguer à R$ 12,00 (s/n)?");
      
      } else if(strtolower($resp) == 's'){

        $mensagem=urlencode("{$first_name}, seu pedido foi confirmado.");

      } else if(strtolower($resp) == 'n'){

        $mensagem=urlencode("{$first_name}, seu pedido foi cancelado.");

      } else {

        $mensagem=urlencode("Olá {$first_name}, seja bem vindo!\n\rO que deseja?\n\r1) Hamburguer\n\r2) Chess Burguer\n\r3) X-tudo Burguer");

      }

      $send_msg = file_get_contents($url."/sendMessage?chat_id={$user_id}&text={$mensagem}");

    }

  }

  sleep(10);    

} 