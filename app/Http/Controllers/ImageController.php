<?php

namespace App\Http\Controllers;

use App\Service\GlideSignature;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use League\Glide\Server;
use League\Glide\Signatures\SignatureException;
use League\Glide\Urls\UrlBuilder;

class ImageController
{
    /** @var Server */
    private $glide_server;

    /** @var GlideSignature */
    private $signature_verifier;

    public function __construct(Server $glide_server, GlideSignature $signature_verifier)
    {
        $this->glide_server       = $glide_server;
        $this->signature_verifier = $signature_verifier;
    }

    public function show(Request $request, $path)
    {
        try {
            $this->signature_verifier->validate($request->path(), $_SERVER['QUERY_STRING']);
        } catch (SignatureException $e) {
            return new Response('', Response::HTTP_FORBIDDEN, [
                'x-reason' => $e->getMessage()
            ]);
        }

        return $this->glide_server->getImageResponse($path, $request->all());
    }
}