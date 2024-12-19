<?php

require_once "./Classes/Login.php";

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    private $loginHandler;

    protected function setUp(): void
    {
        $this->loginHandler = new Login();
    }

    /**
     * @dataProvider validLoginData
     */
    public function testValidLogin($username)
    {
        // Simulate a valid login attempt
        $result = $this->loginHandler->authenticate($username);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('username', $result);
        $this->assertEquals($username, $result['username']);
    }

    public static function validLoginData()
    {
        return [
            ['manager'],
            ['manager1'],
            [''],
            ['123']
        ];
    }

    public function testInvalidLogin()
    {
        $username = "manager123";

        // Simulate an invalid login attempt
        $result = $this->loginHandler->authenticate($username);

        $this->assertNull($result);
    }
}
