<?php

namespace App;

use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Hashing\BcryptHasher;
use WhiteHat101\Crypt\APR1_MD5;

class APR1MD5Hasher extends BcryptHasher implements HasherContract
{
    /**
     * Check the given plain value against a hash.
     *
     * @param string $value
     * @param string $hashedValue
     * @param array  $options
     *
     * @return bool
     */
    public function check($value, $hashedValue, array $options = [])
    {
        if (APR1_MD5::check($value, $hashedValue)) {
            return true;
        }

        return parent::check($value, $hashedValue, $options);
    }
}
