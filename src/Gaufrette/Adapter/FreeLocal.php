<?php

namespace Gaufrette\Adapter;

use Gaufrette\Util;
use Gaufrette\Adapter;
use Gaufrette\Stream;
use Gaufrette\Adapter\StreamFactory;
use Gaufrette\Exception;

/**
 * Adapter for the local filesystem
 *
 */
class FreeLocal extends Local
{

    /**
     * {@inheritDoc}
     */
    public function computePath($key)
    {
        return parent::computePath($key);
    }

}
