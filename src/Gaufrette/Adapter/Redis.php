<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter;
use Predis\Client;

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
     * @param Client $redis
     */
    public function __construct(Client $redis)
    {
        $this->$redis = $redis;
    }


    /**
     * @param string $key
     * @return bool|mixed|string
     */
    public function read($key)
    {

        $result = $this->redis->pipeline(function($pipe) use ($key) {
                $pipe->get($key);
            });

        print_r($result);

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

        $result = $this->redis->pipeline(function($pipe) use ($key, $value) {
                $pipe->set($key, $value);
            });

        if($result === false) {
            throw new \RuntimeException(sprintf("MemCached server Fault. Result code: %s", $this->redis->getResultCode()));
        }

        return $result;
    }


    /**
     * Indicates whether the file exists
     * @param string $key
     * @return boolean
     */
    public function exists($key)
    {

        $result = $this->redis->pipeline(function($pipe) use ($key) {
                $pipe->exists($key);
            });

        return $result;
    }


    /**
     * Returns an array of all keys (files and directories)
     * @return array
     */
    public function keys()
    {
        $result = $this->redis->pipeline(function($pipe) {
                $pipe->keys('*');
            });
        return $result;
    }


    /**
     * Returns the last modified time
     * @param string $key
     * @return integer|boolean An UNIX like timestamp or false
     */
    public function mtime($key)
    {
        $result = $this->redis->pipeline(function($pipe) use ($key) {
                $pipe->object('idletime', $key);
            });
    }


    /**
     * Deletes the file
     * @param string $key
     * @return boolean
     */
    public function delete($key)
    {
        $result = $this->redis->pipeline(function($pipe) use ($key) {
                $pipe->delete($key);
            });

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
        $result = $this->redis->pipeline(function($pipe) use ($sourceKey, $targetKey) {
                $pipe->rename($sourceKey, $targetKey);
            });

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
