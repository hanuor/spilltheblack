<?php

class CleanPathTest extends AdvancedFsTestCase
{
    public function testTheCotentIsCopied()
    {
        $source = $this->mockDir() . '/path-source';
        $destination = $this->mockDir() . '/path-destination';
        $this->createSomeFiles($source);
        AdvancedFs::copyPathContent($source, $destination);

        $this->assertEquals(true, is_dir($source));
        $this->assertEquals(true, is_dir($destination));
        $this->assertEquals('lalala', file_get_contents($destination . '/somefile.txt'));
        $this->assertEquals('blablabla', file_get_contents($destination . '/.somehiddenfile'));
        $this->assertEquals('lululu', file_get_contents($destination . '/subdir/somefile.txt'));
        $this->assertEquals('tututu', file_get_contents($destination . '/subdir/somehiddenfile.txt'));
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