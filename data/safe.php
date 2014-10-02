<?php

    class safe{

        //Del viss kod från https://crackstation.net/hashing-security.htm

      public function create_hash($passwordOne)
        {
            $salt = strtr(base64_encode(mcrypt_create_iv(PBKDF2_SALT_BYTE_SIZE, MCRYPT_DEV_URANDOM)),PBKDF2_PLUS,PBKDF2_POINT);
            $salt .= sprintf(PBKDF2_HASH,PBKDF2_ITERATIONS);
            $safe = crypt($passwordOne,$salt);
            return  $safe;
            
        }

    }   