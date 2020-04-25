<?php

namespace helpers;
if (!class_exists('helpers\SimpleImage')) {
    class SimpleImage {

        var $image;
        var $image_type;

        function load($filename) {

            $image_info = getimagesize($filename);
            $this->image_type = $image_info[2];
            if ($this->image_type == IMAGETYPE_JPEG) {

                $this->image = imagecreatefromjpeg($filename);
            } elseif ($this->image_type == IMAGETYPE_GIF) {

                $this->image = imagecreatefromgif($filename);
            } elseif ($this->image_type == IMAGETYPE_PNG) {

                $this->image = imagecreatefrompng($filename);
            }
        }

        function save($filename, $image_type = IMAGETYPE_PNG, $compression = 75, $permissions = null) {

            if ($image_type == IMAGETYPE_JPEG) {
                imagepng($this->image, $filename, $compression);
            } elseif ($image_type == IMAGETYPE_GIF) {
                imagegif($this->image, $filename);
            } elseif ($image_type == IMAGETYPE_PNG) {
                $new_image = $this->image;
                imagesavealpha($new_image, true);
                $color = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
                imagefill($new_image, 0, 0, $color);
                imagepng($new_image, $filename);
            }
            if ($permissions != null) {

                chmod($filename, $permissions);
            }
        }

        function output($image_type = IMAGETYPE_PNG) {

            if ($image_type == IMAGETYPE_JPEG) {
                imagepng($this->image);
            } elseif ($image_type == IMAGETYPE_GIF) {

                imagegif($this->image);
            } elseif ($image_type == IMAGETYPE_PNG) {
                imagepng($this->image);
            }
        }

        function resizeToHeight($height) {

            $ratio = $height / $this->getHeight();
            $width = $this->getWidth() * $ratio;
            $this->resize($width, $height);
        }

        function getHeight() {

            return imagesy($this->image);
        }

        function getWidth() {

            return imagesx($this->image);
        }

        function resize($width, $height) {
            $new_image = $this->image;
            imagesavealpha($new_image, true);
            $color = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagefill($new_image, 0, 0, $color);
            imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
            $this->image = $new_image;
        }

        function resizeCheckImage(array $array) {
            $array = deStr($array);
            $width = $array['width'];
            $height = $array['height'];
            $new_image = $this->image;
            imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $width, $height);
            imagesavealpha($new_image, true);
            $color = imagecolorallocatealpha($new_image, 0, 0, 0, 100);
            imagefill($new_image, 0, 0, $color);
            $this->image = $new_image;
        }

        function resizeToWidth($width) {
            $ratio = $width / $this->getWidth();
            $height = $this->getheight() * $ratio;
            $this->resize($width, $height);
        }

        function scale($scale) {
            $width = $this->getWidth() * $scale / 100;
            $height = $this->getheight() * $scale / 100;
            $this->resize($width, $height);
        }

    }
}
