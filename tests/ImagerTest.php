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
                'to' => __DIR__ . DIRECTORY_SEPARATOR . 'gg.png',
                'type' => 'png'
            ]
        ]);
        $this->assertEquals(get_class($imager->getLibrary()), 'LGC\Imager\GDLibrary');
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
                'to' => __DIR__ . DIRECTORY_SEPARATOR . 'gg.png',
                'type' => 'png'
            ]
        ]);
        $this->assertEquals(get_class($imager->getLibrary()), 'LGC\Imager\ImageMagickLibrary');
    }
}
