<?php

require_once "./Classes/Users.php";
require_once "./Classes/Dbh.php";

use PHPUnit\Framework\TestCase;

class CreateUserTest extends TestCase
{
    private $createUserHandler;

    protected function setUp(): void
    {
        $this->createUserHandler = new Users();
    }

    /**
     * @dataProvider validUserData
     */
    public function testValidUserCreation($username, $password, $email, $code, $role)
    {
        $this->createUserHandler->createUser($username, $password, $email, $code, $role);

        $createdUser = $this->createUserHandler->getUserByName($username);

        $this->assertNotNull($createdUser);
        $this->assertEquals($username, $createdUser['username']);
        $this->assertTrue(password_verify($password, $createdUser['pwd']));
        $this->assertEquals($email, $createdUser['email']);
        $this->assertEquals($code, $createdUser['employee_code']);
        $this->assertEquals($role, $createdUser['role']);
    }

    public static function validUserData()
    {
        return [
            ['testuser1', 'Password123!', 'test1@example.com', '1234567', 'employee'],
            ['testuser2', 'Password456!', 'test2@example.com', '7654321', 'employee'],
        ];
    }

    /**
     * @dataProvider invalidUserData
     */
    public function testInvalidUserCreation($username, $password, $email, $code, $role, $expectedError)
    {
        $this->expectExceptionMessage($expectedError);

        $this->createUserHandler->createUser($username, $password, $email, $code, $role);
    }

    public static function invalidUserData()
    {
        return [
            ['', 'Password123!', 'test1@example.com', '1234567', 'employee', 'Username cannot be empty'],
            ['testuser1', '', 'test1@example.com', '1234567', 'employee', 'Password cannot be empty'],
            ['testuser1', 'Password123!', 'invalidemail', '1234567', 'employee', 'Invalid email format'],
            ['testuser1', 'Password123!', 'test1@example.com', '123', 'employee', 'Employee code must be 7 digits'],
        ];
    }

    /**
     * Test duplicate username scenario
     */
    public function testDuplicateUsername()
    {
        $username = 'duplicateUser';
        $password = 'Password123!';
        $email = 'duplicate@example.com';
        $code = '1234567';
        $role = 'employee';

        $this->createUserHandler->createUser($username, $password, $email, $code, $role);

        $this->expectExceptionMessage('Username already exists');
        $this->createUserHandler->createUser($username, $password, $email, $code, $role);
    }
}
