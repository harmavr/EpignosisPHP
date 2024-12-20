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
            ['2'],
        ];
    }

    /**
     * @dataProvider invalidLoginData
     */
    public function testInvalidLogin($username, $expectedError)
    {
        $this->expectExceptionMessage($expectedError);

        // Simulate an invalid login attempt
        $result = $this->loginHandler->authenticate($username);

        $this->assertNull($result);
    }

    public static function invalidLoginData()
    {
        return [
            ['manager123', 'invalid Username'],
            ['emp123', "User name doesn't exist"],
        ];
    }
}
