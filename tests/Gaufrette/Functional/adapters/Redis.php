<?php

$single_server = array(
    'host'     => '127.0.0.1',
    'port'     => 6379,
    'database' => 15
);

$redis = new \Predis\Client($single_server);

$keys = $redis->keys('*');
$result = $redis->delete($keys);

return new Gaufrette\Adapter\Redis($client);

