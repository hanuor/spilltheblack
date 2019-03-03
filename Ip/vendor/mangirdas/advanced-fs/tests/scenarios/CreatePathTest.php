<?php

class CreatePathTest extends AdvancedFsTestCase
{
    public function testOneLevel()
    {
        $path = $this->mockDir() . '/firstdir';
        AdvancedFs::createPath($path);
        $this->assertEquals(true, is_dir($path));
    }

    public function testMultipleLevels()
    {
        $path = $this->mockDir() . '/dir1/dir2/dir3';
        AdvancedFs::createPath($path);
        $this->assertEquals(true, is_dir($path));
    }

    public function testAdditionalSlash()
    {
        $path = $this->mockDir() . '/somedir/domeotherdir/';
        AdvancedFs::createPath($path);
        $this->assertEquals(true, is_dir($path));
    }
}