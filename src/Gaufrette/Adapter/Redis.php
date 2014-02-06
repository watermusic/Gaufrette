<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter;
use Predis\Client;
use Predis\Response\Status;

/**
 * Gaufrette Redis Adapter
 */
class Redis implements Adapter
{

    /**
     * @var Client
     */
    protected	$redis = null;

    /**
     * @var int
     */
    protected   $ttl = 86400;

    /**
     * @param Client $redis
     */
    public function __construct(Client $redis)
    {
        $this->redis = $redis;
    }


    /**
     * @param string $key
     * @return bool|mixed|string
     */
    public function read($key)
    {

        $result = $this->redis->get($key);

        return $result;
    }


    /**
     * @param string $key
     * @param string $value
     * @throws \RuntimeException
     * @return bool|int
     */
    public function write($key, $value)
    {
        /* @var Status $result */
        $result = $this->redis->set($key, $value);

        if($result->getPayload() !== 'OK') {
            throw new \RuntimeException(sprintf("Redis server Fault. Could not set the value of key %s", $key));
        }

        $this->redis->expire($key, $this->ttl);

        return $this->redis->strlen($key);
    }


    /**
     * Indicates whether the file exists
     * @param string $key
     * @return boolean
     */
    public function exists($key)
    {
        $result = $this->redis->exists($key);

        return $result;
    }


    /**
     * Returns an array of all keys (files and directories)
     * @return array
     */
    public function keys()
    {
        $result = $this->redis->keys('*');

        return $result;
    }


    /**
     * Returns the last modified time
     * @param string $key
     * @return integer|boolean An UNIX like timestamp or false
     */
    public function mtime($key)
    {
        $ttl = $this->redis->ttl($key);
        $result = ($ttl > 0) ? time() - ($this->ttl - $ttl) : false;

        return $result;
    }


    /**
     * Deletes the file
     * @param string $key
     * @return boolean
     */
    public function delete($key)
    {
        $result = $this->redis->del($key);

        return $result > 0;

    }


    /**
     * Renames a file
     * @param string $sourceKey
     * @param string $targetKey
     * @return boolean
     */
    public function rename($sourceKey, $targetKey)
    {
        $result = $this->redis->rename($sourceKey, $targetKey);

        return $result;
    }


    /**
     * Check if key is directory
     * @param string $key
     * @return boolean
     */
    public function isDirectory($key)
    {
        return false;
    }

}
