<?php

namespace App\Lib\Alepays\Utils;

use App\Lib\Alepays\Crypt\RSA;

class AlepayUtils {

    public function encryptData($data, $publicKey) {
        $rsa = new RSA();
        $rsa->loadKey($publicKey); // public key
        $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
        $output = $rsa->encrypt($data);
        return base64_encode($output);
    }

    public function decryptData($data, $publicKey) {
        $rsa = new RSA();
        $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
        $ciphertext = base64_decode($data);
        $rsa->loadKey($publicKey); // public key
        $output = $rsa->decrypt($ciphertext);
        // $output = $rsa->decrypt($data);
        return $output;
    }

    public function decryptCallbackData($data, $publicKey) {
        $decoded = base64_decode($data);
        return $this->decryptData($decoded, $publicKey);
    }

}
