<?php

namespace App\Infrastructure\Utils;

use App\Domain\Entity\Client;
use App\Domain\Enum\BasePathEnum;
use OpenSSLAsymmetricKey;

class Crypt
{
    public const PASSPHRASE = '@a|u|t|h|-|s|e|r|v|i|c|e';
    private const PUBLIC_KEY = 'public-key.pem';
    private const PRIVATE_KEY = 'private-key.pem';
    private const PRIVATE_KEY_SLASH = '/private-key.pem';
    private const PASSPHRASE_SLASH = '/passphrase.txt';

    private const CONFIG = [
        "digest_alg" => "sha512",
        "private_key_bits" => 4096,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
    ];

    private \OpenSSLAsymmetricKey $crypt;

    public function __construct()
    {
        $this->crypt = openssl_pkey_new(self::CONFIG);
        $this->privateKey = file_get_contents(BasePathEnum::CERTIFICADOS->value . 'authservice/private-key.pem');
    }

    public function generateRSA(string $projeto): void
    {
        $pathProjeto = BasePathEnum::CERTIFICADOS->value . $projeto . '/';

        if (
            file_exists($pathProjeto . self::PUBLIC_KEY)
            && file_exists($pathProjeto . self::PRIVATE_KEY)
        ) {
            return;
        }

        if (!is_dir($pathProjeto)) {
            mkdir($pathProjeto);
        }

        $privateKey = $pathProjeto . 'authservice/private-key.pem';
        openssl_pkey_export($this->crypt, $privateKey, $this->getPassphrase($projeto));
        $public_key = openssl_pkey_get_details($this->crypt)['key'];

        file_put_contents($pathProjeto . self::PUBLIC_KEY, $public_key);
        file_put_contents($pathProjeto . self::PRIVATE_KEY, $privateKey);
    }

    private function getPassphrase(string $projeto): string
    {
        $splitNomeProjeto = str_split($projeto);
        shuffle($splitNomeProjeto);

        $passphrase = hash('ripemd128', implode('', $splitNomeProjeto));

        file_put_contents(BasePathEnum::CERTIFICADOS->value . $projeto . '/passphrase.txt', $passphrase);

        return $passphrase;
    }

    public static function getKeyToJwt(Client $client): OpenSSLAsymmetricKey
    {
        $pathKeys = BasePathEnum::CERTIFICADOS->value . $client->getClientName();
        $privateKey = $pathKeys . self::PRIVATE_KEY_SLASH;

        return openssl_pkey_get_private(
            file_get_contents($privateKey),
            file_get_contents($pathKeys . self::PASSPHRASE_SLASH)
        );
    }
}