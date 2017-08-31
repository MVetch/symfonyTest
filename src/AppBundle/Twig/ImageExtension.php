<?php

namespace AppBundle\Twig;

class ImageExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('resize', array($this, 'resizeImage')),
        );
    }

    public function resizeImage($image, $width = 200, $height = 200)
    {
        echo '<img src="/uploads/covers/'.$image.'" style="width:'.$width.'px; height:'.$height.'px">';
        return;
    }
}