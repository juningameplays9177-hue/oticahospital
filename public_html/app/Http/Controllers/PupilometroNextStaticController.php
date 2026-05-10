<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Serve ficheiros estáticos do Next export em public/pupilometro-next
 * (HTML, JS, CSS). Alguns alojamentos não encaminham /pupilometro-next/* corretamente;
 * esta rota garante resposta 200 quando os ficheiros existem no disco.
 */
class PupilometroNextStaticController extends Controller
{
    private const URI_PREFIX = 'pupilometro-next';

    public function dispatch(Request $request, ?string $tail = null): BinaryFileResponse
    {
        $path = $request->path();
        if (! str_starts_with($path, self::URI_PREFIX)) {
            abort(404);
        }

        $rel = $tail !== null && $tail !== '' ? trim($tail, '/') : '';
        if ($rel !== '' && (str_contains($rel, '..') || str_contains($rel, "\0"))) {
            abort(404);
        }

        $base = realpath(public_path(self::URI_PREFIX));
        if ($base === false) {
            abort(503, 'Pasta public/pupilometro-next ausente. Gere o build em PUPILOMETRO e copie out/ para public/pupilometro-next/.');
        }

        if ($rel === '') {
            $file = $base . DIRECTORY_SEPARATOR . 'index.html';
            if (! is_file($file)) {
                abort(503, 'public/pupilometro-next/index.html em falta.');
            }
            return $this->fileOrNotModified($request, $file);
        }

        $candidate = $base . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $rel);
        $realFile = realpath($candidate);

        if ($realFile !== false && str_starts_with($realFile, $base) && is_file($realFile)) {
            return $this->fileOrNotModified($request, $realFile);
        }

        if (is_file($candidate)) {
            $rp = realpath(dirname($candidate));
            if ($rp !== false && str_starts_with($rp, $base)) {
                return $this->fileOrNotModified($request, $candidate);
            }
        }

        if ($realFile !== false && str_starts_with($realFile, $base) && is_dir($realFile)) {
            $index = $realFile . DIRECTORY_SEPARATOR . 'index.html';
            if (is_file($index)) {
                return $this->fileOrNotModified($request, $index);
            }
        }

        abort(404);
    }

    private function fileOrNotModified(Request $request, string $absolutePath): BinaryFileResponse
    {
        $response = response()->file($absolutePath, $this->headersFor($absolutePath));
        if ($request->isMethod('HEAD')) {
            $response->setContent(null);
        }
        return $response;
    }

    /**
     * @return array<string, string>
     */
    private function headersFor(string $file): array
    {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $types = [
            'html' => 'text/html; charset=UTF-8',
            'htm' => 'text/html; charset=UTF-8',
            'js' => 'application/javascript; charset=UTF-8',
            'mjs' => 'application/javascript; charset=UTF-8',
            'css' => 'text/css; charset=UTF-8',
            'json' => 'application/json; charset=UTF-8',
            'svg' => 'image/svg+xml',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'webp' => 'image/webp',
            'woff' => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf' => 'font/ttf',
            'map' => 'application/json',
            'txt' => 'text/plain; charset=UTF-8',
            'ico' => 'image/x-icon',
        ];
        $type = $types[$ext] ?? 'application/octet-stream';
        $headers = ['Content-Type' => $type, 'X-Content-Type-Options' => 'nosniff'];
        if (str_contains($file, DIRECTORY_SEPARATOR . '_next' . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR)) {
            $headers['Cache-Control'] = 'public, max-age=31536000, immutable';
        }
        return $headers;
    }
}
