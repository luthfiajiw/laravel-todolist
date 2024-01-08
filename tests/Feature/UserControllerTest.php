<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testBlockLoginPageForUserAlreadyLoggedIn()
    {
        $this->withSession([
            "user" => "admin"
        ])->get('/login')
            ->assertRedirect('/');
        
        $this->withSession([
            "user" => "admin"
        ])->post('/login', [
            "user" => "admin",
            "password" => "123456"
        ])->assertRedirect('/');
    }

    public function testLoginSucceed()
    {
        $this->post('/login', [
            "user" => "admin",
            "password" => "123456"
        ])->assertRedirect('/')
            ->assertSessionHas("user", "admin");
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])
            ->assertSeeText('Username and password is required');
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            "user" => "admin",
            "password" => "1234"
        ])->assertSeeText("Username or password is invalid");
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "admin"
        ])->post('/logout')
            ->assertRedirect('/login')
            ->assertSessionMissing('user');
    }
}
