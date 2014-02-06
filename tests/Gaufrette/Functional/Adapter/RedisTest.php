<?php

namespace Gaufrette\Functional\Adapter;

use Gaufrette\Adapter\Redis;

class RedisTest extends FunctionalTestCase
{

    /**
     * @test
     * @group functional
     */
    public function shouldGetMtime()
    {
        $this->filesystem->write('foo', 'Some content');

        $this->assertGreaterThan(0, $this->filesystem->mtime('foo'));

        $this->filesystem->delete('foo');
    }


}
