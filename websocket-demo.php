<?php
require('vendor/autoload.php');

use WebSocket\Client;

$client = new Client("ws://45.195.202.209:1988/websocket/ETH");
$client->send("{'type':'token','content':'eyJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6ImFkbWluIiwidXNlcklkIjoxLCJzZXJ2aWNlIjoid2FsbGV0LXNoZWxsIiwidHlwZSI6InRva2VuIiwiZXhwIjoxNTM2ODA4NTM3fQ.FAlUNwI12OnpvMlXhewKBrXqFDjXsOBvxpCE6pew6-E'}");

while (1) {
  $message = $client->receive();
  if ($message) {
    $messageObject = json_decode($message);
    echo $messageObject;
  }
}
 ?>
