<?php

namespace LGC\Imager;

use RuntimeException as ImagerException;
use LGC\Imager\ImageLibrary;
use LGC\Imager\ImageLibraryInterface;

class ImageMagickLibrary extends ImageLibrary implements ImageLibraryInterface
{
    /**
     * checkout the library had been install
     *
     * @return bool
     */
    public function checkout()
    {
        if (extension_loaded('mbstring')) {
            return (mb_strlen(exec('convert')) > 0);
        }
        return false;
    }

    /**
     * compress
     * note: gd cannot compress gif file
     *
     * @param integer $quality
     * @throws ImagerException
     * @return bool
     */
    public function compress($quality)
    {
        $quality = (int) $quality;

        if ($quality > 100 || $quality < 0) {
            throw new ImagerException('Compress quality must between 0 and 100.');
        }
        $this->options['compress'] = $quality;

        return true;
    }

    /**
     * crop
     *
     * @param array $cropInfo
     * @throws ImagerException
     * @return bool
     */
    public function crop($cropInfo)
    {
        if (!isset($cropInfo['width']) || !isset($cropInfo['height']) || !isset($cropInfo['x']) || !isset($cropInfo['y'])) {
            throw new ImagerException('Cropinfo must set width, height, x and y.');
        }
        $this->options['crop'] = $cropInfo;

        return true;
    }

    /**
     * init
     *
     * @return void
     */
    public function init()
    {
        parent::init();
        $this->name = 'im';
    }

    /**
     * run
     *
     * @throws ImagerException
     * @return bool
     */
    public function run()
    {
        if (!$this->checkout()) {
            throw new ImagerException('Please checkout the imagemagick library had been installed.');
        }
        if (empty($this->fileSrc)) {
            throw new ImagerException('Please set the file source.');
        }
        if (empty($this->fileTo)) {
            throw new ImagerException('Please set the file to.');
        }
        if (empty($this->fileType)) {
            throw new ImagerException('Please set the file type.');
        }
        return $this->runCommand();
    }

    /**
     * run command
     *
     * @return bool
     */
    protected function runCommand()
    {
        $command = $this->options;
        $fileSrc = $this->fileSrc;
        $fileTo = $this->fileTo;
        $type = $this->fileType;
        $result = false;
        $imCommand = 'convert';

        if (isset($command['compress'])) {
            $quality = $command['compress'];
            $imCommand .= sprintf(" -quality %d", $quality);
        }
        if (isset($command['crop'])) {
            $cropInfo = $command['crop'];
            $imCommand .= sprintf(" -crop %dx%d+%d+%d", $cropInfo['width'], $cropInfo['height'], $cropInfo['x'], $cropInfo['y']);
        }
        $imCommand .= sprintf(" %s %s", $fileSrc, $fileTo);
        $result = (mb_strlen(exec($imCommand)) > 0);

        return $result;
    }
}
