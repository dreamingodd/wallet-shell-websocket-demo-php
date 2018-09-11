
<?php

  require __DIR__ . '/vendor/autoload.php';

  $tokenType = 'ETH';
  \Ratchet\Client\connect('ws://IP:PORT/websocket/'.$tokenType)->then(function($conn) {
    $token = "eyJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6ImFkbWluIiwidXNlcklkIjoxLCJzZXJ2aWNlIjoid2FsbGV0LXNoZWxsIiwidHlwZSI6InRva2VuIiwiaXNBZG1pbiI6MSwiZXhwIjoxNTM2NjM3MDMwfQ.CBM2-HbpQ8R-wUBRpbhb0hzuV9PKSSGxKQmz24rY2WM";
    $authText = "{'type':'token','content':'".$token."'}";
    $conn->send($authText);
    $conn->on('message', function($msg) use ($conn) {
      $msgObj = json_decode($msg);
      $receiptContent = "{'id':".$msgObj->id.",'depth':".$msgObj->depth.", 'oprType':'".$msgObj->oprType."'}";
      $receipt = "{'type':'message','content':".$receiptContent."}";
      echo $receipt."\n";
      echo "Received: {$msg}\n";
      $conn->send($receipt);
    });
    $conn->on('close', function($code = null, $reason = null) {
      echo "Connection closed ({$code} - {$reason})\n";
    });
  }, function ($e) {
    echo "Could not connect: {$e->getMessage()}\n";
  });

?>
