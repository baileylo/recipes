<?php

namespace App\Service;

use League\Glide\Signatures\SignatureException;
use League\Glide\Signatures\SignatureInterface;

class GlideSignature implements SignatureInterface
{
    private const ALGO = 'sha256';

    private $signKey;

    public function __construct($signKey)
    {
        $this->signKey = $signKey;
    }

    /**
     * Validate a request signature.
     * @param  string             $path         The resource path.
     * @param  string             $query_string The raw query string not url encoded.
     * @throws SignatureException
     */
    public function validate($path, $query_string): void
    {
        // Extract Signature From Query String
        preg_match('/(^s|&s)=([a-zA-Z0-9]+)$/', $query_string, $matches);
        if (!$matches) {
            throw new SignatureException('Signature is missing.');
        }

        $message = substr($query_string, 0, -1 * (strlen($matches[2]) + 3));
        $message = ltrim($path, '/') . ($message ? "?{$message}" : '');

        // Remove the signature from the end of the query string and sign the data
        $our_signature = hash_hmac(self::ALGO, $message, $this->signKey);

        if (!hash_equals($our_signature, $matches[2])) {
            throw new SignatureException('Signature is not valid.');
        }
    }

    /**
     * Add an HTTP signature to manipulation params.
     *
     * @param  string $path The resource path.
     * @param  array  $params The manipulation params.
     *
     * @return array  The updated manipulation params.
     */
    public function addSignature($path, array $params)
    {
        $inline_params = $params ? '?'.http_build_query($params) : '';
        $message       = ltrim($path, '/').$inline_params;
        $signature     = hash_hmac(self::ALGO, $message, $this->signKey);

        return array_merge($params, ['s' => $signature]);
    }

    /**
     * Validate a request signature.
     *
     * @param  string $path The resource path.
     * @param  array  $params The manipulation params.
     *
     * @throws SignatureException
     */
    public function validateRequest($path, array $params)
    {
        throw new \BadMethodCallException(__CLASS__ . '::' . __FUNCTION__ . ' is not supposed to be called');
    }
}