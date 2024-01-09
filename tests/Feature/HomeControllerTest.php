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
            "user" => "admin",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "luthfi"
                ]
            ]
        ])->get('/')
            ->assertSeeText("Todolist")
            ->assertSeeText("1")
            ->assertSeeText("luthfi")
            ->assertSessionHas("user" ,"admin");
    }

}
