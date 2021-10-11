<?php

namespace YCliff\Test\EntityORM;

use YCliff\EntityORM\AbstractEntity;

class FakeUser extends AbstractEntity
{

    protected const TABLE_NAME = 'users_test';

    protected string $first_name;
    protected string $last_name;
    protected string $email;
    protected string $ip_address;
}
