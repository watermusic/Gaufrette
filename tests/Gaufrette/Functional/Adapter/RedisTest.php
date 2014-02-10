<?php

namespace Gaufrette\Functional\Adapter;

use Gaufrette\Adapter\Redis;

class RedisTest extends FunctionalTestCase
{

    /**
     * @test
     * @group functional
     * @expectedException Gaufrette\Exception\FileNotFound
     */
    public function shouldExpires()
    {
        $key ="foo";

        $this->filesystem->write($key, 'Some content', true);
        sleep(5);
        $content = $this->filesystem->read($key);

        $this->filesystem->delete($key);
    }


}
