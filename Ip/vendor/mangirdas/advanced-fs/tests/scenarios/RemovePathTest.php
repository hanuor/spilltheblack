<?php

class RemovePathTest extends AdvancedFsTestCase
{
    public function testDirIsReallyRemoved()
    {
        $path = $this->mockDir() . '/newdir1';
        $this->createSomeFiles($path);
        AdvancedFs::removePath($path);
        $this->assertEquals(false, is_dir($path));
    }

    private function createSomeFiles($path)
    {
        mkdir($path);
        file_put_contents($path . '/somefile.txt', 'lalala');
        file_put_contents($path . '/.somehiddenfile', 'blablabla');
        mkdir($path . '/subdir');
        file_put_contents($path . '/subdir/somefile.txt', 'lululu');
        file_put_contents($path . '/subdir/.somehiddenfile', 'tututu');
    }
}