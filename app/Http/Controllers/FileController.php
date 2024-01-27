<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class FileController extends Controller
{
    const UPLOAD_DIR = 'files/';

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        $isLastChunk = $request->resumableChunkNumber === $request->resumableTotalChunks;
        $path = $request->resumableRelativePath;

        $file = $request->file('file');

        if ($file) {
            try {
                if (!Storage::exists(self::UPLOAD_DIR)) {
                    Storage::makeDirectory(self::UPLOAD_DIR);
                }

                $file->storeAs(self::UPLOAD_DIR, $path);
            } catch (Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'path' => $path
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        return response()->json([
            'message' => $isLastChunk ? 'File uploaded entirely' : 'Chunk uploaded successfully',
            'path' => $isLastChunk ? $path : null
        ], Response::HTTP_OK);
    }
}
