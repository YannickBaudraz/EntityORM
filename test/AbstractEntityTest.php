<?php

namespace YCliff\Test\EntityORM;

use PDO;
use PDOException;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

/**
 * This class is designed to test the library EntityORM.
 */
class AbstractEntityTest extends TestCase
{

    public function __construct()
    {
        parent::__construct();

        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
    }

    protected function setUp(): void
    {
        $script = file_get_contents(__DIR__ . "/schemas/test.sql");
        $connection = new PDO($_ENV["DB_DSN"], $_ENV["DB_USER_NAME"], $_ENV["DB_USER_PWD"]);
        $connection->exec($script);
    }

    public function testGetAll_users_allUsers()
    {
        /* Given */
        $expectedUsersQuantity = 50;

        /* When */
        $users = FakeUser::getAll();

        /* Then */
        $this->assertCount($expectedUsersQuantity, $users);
    }

    public function testGet_Number12_User()
    {
        /* Given */
        $userId = 12;
        $expectedClassInstance = FakeUser::class;
        $expectedIpAddress = "122.88.122.26";

        /* When */
        $user = FakeUser::get($userId);

        /* Then */
        $this->assertInstanceOf($expectedClassInstance, $user);
        $this->assertEquals($expectedIpAddress, $user->ip_address);
    }

    public function testCreate_RecreateSameUser_ThrowPDOException23000()
    {
        /* Given */
        $user = new FakeUser(
            [
                "first_name" => "Yannick",
                "last_name"  => "Baudraz",
                "email"      => "yannickbaudrazdev@gmail.com",
                "ip_address" => "192.168.140.115",
            ]
        );

        /* When */
        $user->create();

        /* Then */
        $this->expectException(PDOException::class);
        $this->expectExceptionCode(23000);
        $user->create();
    }

    /**
     * @depends testGet_Number12_User
     */
    public function testUpdate_DarthVader_UpdatedUser()
    {
        /* Given */
        $userId = 8;
        $existingUser = new FakeUser(
            [
                "id" => $userId,
                "first_name" => "Darth",
                "last_name" => "Vader",
                "email" => "vader@imperial.emp",
                "ip_address" => "0.0.0.0",
            ]
        );

        /* When */
        $result = $existingUser->update();

        /* Then */
        $this->assertTrue($result);
        $updatedUser = FakeUser::get($userId);
        $this->assertEquals($existingUser->first_name, $updatedUser->first_name);
    }

    public function testDelete_FirstUser_Deleted()
    {
        /* Given */
        $user = new FakeUser(["id" => 1]);

        /* When */
        $firstAttempt = $user->delete();

        /* Then */
        $this->assertTrue($firstAttempt);
        $secondAttempt = $user->delete();
        $this->assertFalse($secondAttempt);
    }
}
