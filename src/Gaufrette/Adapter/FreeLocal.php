<?php

namespace Gaufrette\Adapter;

use Gaufrette\Util;
use Gaufrette\Adapter;
use Gaufrette\Stream;
use Gaufrette\Exception;

/**
 * Adapter for the local filesystem
 *
 */
class FreeLocal extends Local implements MetadataSupporter
{

    protected $host = null;

    /**
     * @param string $directory
     * @param null $host
     * @param bool $create
     * @param int $mode
     */
    public function __construct($directory, $host = null, $create = false, $mode = 0777) {

        parent::__construct($directory, $create, $mode);
        $this->host = $host;

    }

    /**
     * {@inheritDoc}
     */
    public function computePath($key)
    {
        return parent::computePath($key);
    }


    /**
     * Gets the publicly accessible URL of FreeLocal
     *
     * @param string $key     Object key
     * @return string
     */
    public function getUrl($key)
    {
        return sprintf(
            "%s/%s",
            $this->host,
            $key
        );
    }

    /**
     * Saves metadata
     *
     * @param string $key
     * @param array $content
     * @return int
     */
    public function setMetadata($key, $content)
    {
        $path = $this->computePath($key);

        $this->ensureDirectoryExists(dirname($path), true);

        return file_put_contents($path, serialize($content));

    }

    /**
     * Reads metadata
     *
     * @param  string $key
     * @return array
     */
    public function getMetadata($key)
    {
        return unserialize(file_get_contents($this->computePath($key)));
    }


}
