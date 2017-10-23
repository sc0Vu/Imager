<?php

namespace LGC\Imager;

use RuntimeException as ImagerException;
use LGC\Imager\ImageLibrary;
use LGC\Imager\ImageLibraryInterface;

class GDLibrary extends ImageLibrary implements ImageLibraryInterface
{
    /**
     * checkout the library had been install
     *
     * @return bool
     */
    public function checkout()
    {
        return extension_loaded('gd');
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
        $this->name = 'gd';
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
            throw new ImagerException('Please checkout the gd library had been installed.');
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
        $quality = 100;
        $cropInfo = false;
        $crop = false;
        $result = false;

        if (isset($command['compress'])) {
            $quality = $command['compress'];
        }
        if (isset($command['crop'])) {
            $cropInfo = $command['crop'];
            $crop = imagecreatetruecolor($cropInfo['width'], $cropInfo['height']);
        }
        switch ($type) {
            case 'jpg':case 'jpeg':
                $img = imagecreatefromjpeg($fileSrc);

                if ($crop !== false) {
                    imagecopy($crop, $img, 0, 0, $cropInfo['x'], $cropInfo['y'], $cropInfo['width'], $cropInfo['height']);
                    $result = imagejpeg($crop, $fileTo, $quality);
                    imagedestroy($crop);
                } else {
                    $result = imagejpeg($img, $fileTo, $quality);
                }
            break;

            case 'gif':
                $img = imagecreatefromgif($fileSrc);

                if ($crop !== false) {
                    imagecopy($crop, $img, 0, 0, $cropInfo['x'], $cropInfo['y'], $cropInfo['width'], $cropInfo['height']);
                    $result = imagegif($crop, $fileTo);
                    imagedestroy($crop);
                } else {
                    $result = imagegif($img, $fileTo);
                }
            break;

            case 'png':
                $img = imagecreatefrompng($fileSrc);

                if ($crop !== false) {
                    imagecopy($crop, $img, 0, 0, $cropInfo['x'], $cropInfo['y'], $cropInfo['width'], $cropInfo['height']);
                    $result = imagepng($crop, $fileTo, $quality);
                    imagedestroy($crop);
                } else {
                    $result = imagepng($img, $fileTo, $quality);
                }
            break;

            case 'webp':
                $img = imagecreatefromwebp($fileSrc);

                if ($crop !== false) {
                    imagecopy($crop, $img, 0, 0, $cropInfo['x'], $cropInfo['y'], $cropInfo['width'], $cropInfo['height']);
                    $result = imagewebp($crop, $fileTo, $quality);
                    imagedestroy($crop);
                } else {
                    $result = imagewebp($img, $fileTo, $quality);
                }
            break;

            default:
                return $result;
            break;
        }
        imagedestroy($img);

        return $result;
    }
}
