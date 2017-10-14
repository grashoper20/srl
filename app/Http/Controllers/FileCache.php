<?php

namespace SRL\Http\Controllers;

use SRL\tv_show;
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
        $network = strip_tags($id);
        $network = 'Fox';
        return response('
<svg version="1.1" baseProfile="full" xmlns="http://www.w3.org/2000/svg">
  <g>
    <rect width="100%" height="100%" fill="#555" rx="15" ry="15" />
    <text x="0" y="40" font-size="40"  fill="orange" style="font-family: sans-serif">' . $network . '</text>
  </g>
</svg>')
            ->header('Content-Type', 'image/svg+xml')
            ->header('Vary', 'Accept-Encoding');
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
