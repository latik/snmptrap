<?php

class PasswordsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_bcrypt_password()
    {
        $password = 'latik';
        $hash = '$2y$10$FaYxJhIMPjBsS3KIpBIM0eJqDfsAIV.iRZjrLFmnd9BJ2w1PKVVfy';

        $this->assertTrue(Hash::check($password, $hash));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_aprmd5_password()
    {
        $password = 'latik';
        $hash = '$apr1$ldcLQbqG$cJpEYvIA5jE7DpoTV7Pok1';

        $this->assertTrue(Hash::check($password, $hash));
    }
}
