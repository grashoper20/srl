<?php

namespace SickRage\Http\Controllers;

use SickRage\tv_show;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FileCache
{

    private const FILE_TYPE = [
        'banner' => TRUE,
        'poster' => TRUE,
        'fanart' => TRUE,
    ];

    public function getNetwork($id) {
        return response('
<svg version="1.1" baseProfile="full" width="100" height="100" xmlns="http://www.w3.org/2000/svg">
  <rect width="100%" height="100%" fill="red" />
  <text x="150" y="125" font-size="60" text-anchor="middle" fill="white">FOX</text>
</svg>');
    }

    public function getPoster($indexer_id, $type = 'banner', $thumbnail = FALSE) {
        if (!isset(static::FILE_TYPE[$type])) {
            throw new BadRequestHttpException();
        }

        $path = '/var/www/sickrage/cache/images/';
        $file = "${indexer_id}.${type}.jpg";
        if ($thumbnail) {
            $path .= 'thumbnails/';
        }
        $full_path = $path . $file;

        if (file_exists($full_path)) {
            return new BinaryFileResponse($full_path);
        }
        throw new NotFoundHttpException();
    }
}
