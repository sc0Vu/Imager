<?php

namespace LGC\Imager;

use LGC\Imager\ImageLibrary;

class Imager
{
    /**
     * library
     *
     * @var \LGC\Imager\ImageLibrary
     */
    protected $library;

    /**
     * library map
     *
     * @var array
     */
    protected $libraryMap=[
        'gd' => 'LGC\Imager\GDLibrary',
        'im' => 'LGC\Imager\ImageMagickLibrary',
    ];

    /**
     * construct
     *
     * @param array $options
     * @return void
     */
    public function __construct($options=[])
    {
        if (isset($options['library']) && isset($this->libraryMap[$options['library']]) && isset($options['fileInfo'])) {
            $class = $this->libraryMap[$options['library']];
            $this->library = new $class($options['fileInfo']);
        }
    }

    /**
     * get library
     *
     * @return \LGC\Imager\ImageLibrary
     */
    public function getLibrary()
    {
        return $this->library;
    }

    /**
     * set library
     *
     * @param \LGC\Imager\ImageLibrary $library
     * @return $this
     */
    public function setLibrary(ImageLibrary $library)
    {
        $this->library = $library;
        return $this;
    }

    /**
     * compress
     * note: gd cannot compress gif file
     *
     * @param integer $quality
     * @return bool
     */
    public function compress($quality)
    {
        if ($this->library) {
            return $this->library->compress($quality);
        }
        return false;
    }

    /**
     * crop
     *
     * @param array $cropInfo
     * @return bool
     */
    public function crop($cropInfo)
    {
        if ($this->library) {
            return $this->library->crop($cropInfo);
        }
        return false;
    }

    /**
     * run
     *
     * @return bool
     */
    public function run()
    {
        if ($this->library) {
            return $this->library->run();
        }
        return false;
    }
}