<?php

$memcached = new \Memcached('localhost');
$memcached->addServer("127.0.0.1", 11211);

$keys = $memcached->getAllKeys();

$result = $memcached->deleteMulti($keys);

return new Gaufrette\Adapter\Memcached($memcached);
