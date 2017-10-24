<?php

namespace LGC\Imager;

class ImageLibrary
{
    /**
     * name
     * library name
     *
     * @var string
     */
    protected $name;

    /**
     * options
     * command options
     *
     * @var array
     */
    protected $options=[];

    /**
     * file src
     *
     * @var string
     */
    protected $fileSrc;

    /**
     * file to
     *
     * @var string
     */
    protected $fileTo;

    /**
     * file type
     *
     * @var string
     */
    protected $fileType;

    /**
     * construct
     *
     * @param array $options
     * @return void
     */
    public function __construct($options=[])
    {
        if (isset($options['src'])) {
            $this->fileSrc = $options['src'];
        }
        if (isset($options['to'])) {
            $this->fileTo = $options['to'];
        }
        if (isset($options['type'])) {
            $this->fileType = $options['type'];
        }
        $this->init();
    }

    /**
     * get command options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * init
     *
     * @return void
     */
    public function init() {}
}