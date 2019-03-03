<?php

class CleanPathTest extends AdvancedFsTestCase
{
    public function testDirStaysIntact()
    {
        $path = $this->mockDir() . '/path-to-clean';
        $this->createSomeFiles($path);
        AdvancedFs::cleanPath($path);

        $this->assertEquals(true, is_dir($path));

        $files = scandir($path);
        $realFiles = [];
        foreach ($files as $key => $file) {
            if (!in_array($file, ['.', '..'])) {
                $realFiles[] = $file;
            }
        }
        $this->assertEmpty($realFiles);
    }

    public function testExceptionOnNonExistingPath()
    {
        $this->expectException(AdvancedFs\PathNotFoundException::class);
        AdvancedFs::cleanPath($this->mockDir() . '/path-that-does-not-exist');
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