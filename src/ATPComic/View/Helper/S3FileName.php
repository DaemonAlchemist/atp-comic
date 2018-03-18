<?php

namespace ATPComic\View\Helper;

class S3FileName extends \Zend\View\Helper\AbstractHelper
{
    public function __invoke($media, $size = null) {
        $name = "";
        if($media->s3Prefix) {
            $name .= $media->s3Prefix . " - ";
        }
        $name .= $media->fileName;
        if($size) {
            $name .= " - " . $size;
        }
        $name .= "." . $media->fileExtension;
        return $name;
    }
}
