<?php

namespace LGC\Imager;

interface ImageLibraryInterface
{
    /**
     * checkout the library had been install
     *
     * @return bool
     */
    public function checkout();

    /**
     * compress
     * note: gd cannot compress gif file
     *
     * @param integer $quality
     * @throws ImagerException
     * @return bool
     */
    public function compress($quality);

    /**
     * crop
     *
     * @param array $cropInfo
     * @throws ImagerException
     * @return bool
     */
    public function crop($cropInfo);

    /**
     * init
     *
     * @return void
     */
    public function init();

    /**
     * run
     *
     * @return bool
     */
    public function run();
}