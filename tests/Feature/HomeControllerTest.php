<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{

    public function testHomeWithSession(): void
    {
        $this->withSession([
            "user" => "admin"
        ])->get('/')
            ->assertSeeText("Todolist")
            ->assertSessionHas("user" ,"admin");
    }

    public function testHomeWithoutSession()
    {
        $this->get('/')
            ->assertRedirect('/login');    
    }
}
