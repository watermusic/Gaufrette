<?php

namespace Gaufrette\Functional\Adapter;

use Gaufrette\Adapter\Memcached;

class MemcachedTest extends FunctionalTestCase
{

    /**
     * @test
     * @group functional
     */
    public function shouldFetchKeys()
    {
        $this->assertEquals(array(), $this->filesystem->keys());

        $this->filesystem->write('foo', 'Some content');
        $this->filesystem->write('bar', 'Some content');
        $this->filesystem->write('baz', 'Some content');

        $actualKeys = $this->filesystem->keys();

        $this->assertEquals(3, count($actualKeys));
        foreach (array('foo', 'bar', 'baz') as $key) {
            $this->assertContains($key, $actualKeys);
        }

        $this->filesystem->delete('foo');
        $this->filesystem->delete('bar');
        $this->filesystem->delete('baz');
    }

}
