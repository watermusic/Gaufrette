<?php

$single_server = array(
    'host'     => '127.0.0.1',
    'port'     => 6379,
    'database' => 15
);

$redis = new \Predis\Client($single_server);

$keys = $redis->keys('*');

foreach($keys as $key) {
    $result = $redis->del($key);
}

return new Gaufrette\Adapter\Redis($redis);

