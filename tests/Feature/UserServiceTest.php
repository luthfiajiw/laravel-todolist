<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function testLoginSucceed()
    {
        self::assertTrue($this->userService->login("admin", "123456"));
    }

    public function testLoginFailed()
    {
        self::assertFalse($this->userService->login("admin", "1234"));
    }
}
