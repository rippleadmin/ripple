<?php

namespace WaterAdmin\WaterAdmin\Controllers;

use Illuminate\Http\File;
use WaterAdmin\WaterAdmin\Water;

class AssetController
{
    /**
     * Handle the assets for Water Admin.
     *
     * @param  string  $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\Response
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function __invoke($file)
    {
        /** @var \WaterAdmin\WaterAdmin\Asset $asset */
        if (! $asset = Water::getAsset($file)) {
            abort(404);
        }

        $expires = strtotime('+1 year');
        $lastModified = filemtime($asset->path());
        $cacheControl = 'public, max-age=31536000';

        if ($this->matchesCache($lastModified) && config('app.env') === 'production') {
            return response()->noContent(304, [
                'Expires' => $this->httpDate($expires),
                'Cache-Control' => $cacheControl,
            ]);
        }

        return response()->file($asset->path(), [
            'Content-Type' => $this->mimeType($asset->path()).'; charset=utf-8',
            'Expires' => $this->httpDate($expires),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => $this->httpDate($lastModified),
        ]);
    }

    /**
     * Check the fiel cache is exists.
     *
     * @param  int|bool  $lastModified
     * @return bool
     */
    protected function matchesCache($lastModified)
    {
        $ifModifiedSince = $_SERVER['HTTP_IF_MODIFIED_SINCE'] ?? '';

        return @strtotime($ifModifiedSince) === $lastModified;
    }

    /**
     * Get the http date.
     *
     * @param  int|bool  $timestamp
     * @return string
     */
    protected function httpDate($timestamp)
    {
        return sprintf('%s GMT', gmdate('D, d M Y H:i:s', $timestamp));
    }

    /**
     * Get the mime type of the file.
     *
     * @param  string  $path
     * @return string|null
     */
    protected function mimeType($path)
    {
        return (new File($path))->getMimeType();
    }
}
