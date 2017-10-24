<?php

use LGC\Imager\Imager;
use LGC\Imager\GDLibrary;

class ImagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test should return null.
     *
     * @return void
     */
    public function testShouldReturnNull()
    {
        $imager = new Imager();
        $this->assertNull($imager->getLibrary());
    }

    /**
     * Test should set library.
     *
     * @return void
     */
    public function testShouldSetGDImageLibrary()
    {
        $imager = new Imager();
        $library = new GDLibrary();
        $imager->setLibrary($library);
        $this->assertEquals(get_class($imager->getLibrary()), 'LGC\Imager\GDLibrary');
    }

    /**
     * Test should return gd image library.
     *
     * @return void
     */
    public function testShouldReturnGDImageLibrary()
    {
        $imager = new Imager([
            'library' => 'gd',
            'fileInfo' => [
                'src' => __DIR__ . DIRECTORY_SEPARATOR . 'test.png',
                'to' => __DIR__ . DIRECTORY_SEPARATOR . 'gd.png',
                'type' => 'png'
            ]
        ]);
        $this->assertEquals(get_class($imager->getLibrary()), 'LGC\Imager\GDLibrary');
    }

    /**
     * Test should compress and crop png image using GDImageLibrary.
     *
     * @return void
     */
    public function testShouldCompressAndCropPNGImageGDImageLibrary()
    {
        $imager = new Imager([
            'library' => 'gd',
            'fileInfo' => [
                'src' => __DIR__ . DIRECTORY_SEPARATOR . 'test.png',
                'to' => __DIR__ . DIRECTORY_SEPARATOR . 'gd.png',
                'type' => 'png'
            ]
        ]);
        $imager->compress(8);
        $imager->crop([
            'width' => 100,
            'height' => 100,
            'x' => 10,
            'y' => 20
        ]);
        $this->assertTrue($imager->run());
        $this->assertTrue(is_file(__DIR__ . DIRECTORY_SEPARATOR . 'gd.png'));
        unlink(__DIR__ . DIRECTORY_SEPARATOR . 'gd.png');
    }

    /**
     * Test should compress and crop jpg image using GDImageLibrary.
     *
     * @return void
     */
    public function testShouldCompressAndCropJPGImageGDImageLibrary()
    {
        $imager = new Imager([
            'library' => 'gd',
            'fileInfo' => [
                'src' => __DIR__ . DIRECTORY_SEPARATOR . 'test.jpg',
                'to' => __DIR__ . DIRECTORY_SEPARATOR . 'gd.jpg',
                'type' => 'jpg'
            ]
        ]);
        $imager->compress(80);
        $imager->crop([
            'width' => 100,
            'height' => 100,
            'x' => 10,
            'y' => 20
        ]);
        $this->assertTrue($imager->run());
        $this->assertTrue(is_file(__DIR__ . DIRECTORY_SEPARATOR . 'gd.jpg'));
        unlink(__DIR__ . DIRECTORY_SEPARATOR . 'gd.jpg');
    }

    /**
     * Test should compress and crop gif image using GDImageLibrary.
     *
     * @return void
     */
    public function testShouldCompressAndCropGIFImageGDImageLibrary()
    {
        $imager = new Imager([
            'library' => 'gd',
            'fileInfo' => [
                'src' => __DIR__ . DIRECTORY_SEPARATOR . 'test.gif',
                'to' => __DIR__ . DIRECTORY_SEPARATOR . 'gd.gif',
                'type' => 'gif'
            ]
        ]);
        $imager->compress(80);
        $imager->crop([
            'width' => 100,
            'height' => 100,
            'x' => 10,
            'y' => 20
        ]);
        $this->assertTrue($imager->run());
        $this->assertTrue(is_file(__DIR__ . DIRECTORY_SEPARATOR . 'gd.gif'));
        unlink(__DIR__ . DIRECTORY_SEPARATOR . 'gd.gif');
    }

    /**
     * Test should compress and crop webp image using GDImageLibrary.
     *
     * @return void
     */
    public function testShouldCompressAndCropWEBPImageGDImageLibrary()
    {
        $imager = new Imager([
            'library' => 'gd',
            'fileInfo' => [
                'src' => __DIR__ . DIRECTORY_SEPARATOR . 'test.webp',
                'to' => __DIR__ . DIRECTORY_SEPARATOR . 'gd.webp',
                'type' => 'webp'
            ]
        ]);
        $imager->compress(80);
        $imager->crop([
            'width' => 100,
            'height' => 100,
            'x' => 10,
            'y' => 20
        ]);
        $this->assertTrue($imager->run());
        $this->assertTrue(is_file(__DIR__ . DIRECTORY_SEPARATOR . 'gd.webp'));
        unlink(__DIR__ . DIRECTORY_SEPARATOR . 'gd.webp');
    }

    /**
     * Test should return imagemagick image library.
     *
     * @return void
     */
    public function testShouldReturnImageMagickImageLibrary()
    {
        $imager = new Imager([
            'library' => 'im',
            'fileInfo' => [
                'src' => __DIR__ . DIRECTORY_SEPARATOR . 'test.png',
                'to' => __DIR__ . DIRECTORY_SEPARATOR . 'im.png',
                'type' => 'png'
            ]
        ]);
        $this->assertEquals(get_class($imager->getLibrary()), 'LGC\Imager\ImageMagickLibrary');
    }
}
