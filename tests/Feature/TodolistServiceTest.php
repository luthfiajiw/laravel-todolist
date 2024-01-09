<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todoListService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->todoListService = $this->app->make(TodolistService::class);
    }

    public function testSaveTodo()
    {
        $this->todoListService->saveTodo("1", "luthfi");
        
        $todolist = Session::get('todolist');
        foreach ($todolist as $todo) {
            self::assertEquals("1", $todo["id"]);
            self::assertEquals("luthfi", $todo["todo"]);
        }
    }

    public function testGetTodolistEmpty()
    {
        self:assertEquals([], $this->todoListService->getTodolist());
    }

    public function testGetTodolist()
    {
        $expected = [
            [
                "id" => "1",
                "todo" => "luthfi"
            ]
        ];

        $this->todoListService->saveTodo("1", "luthfi");

        self::assertEquals($expected, $this->todoListService->getTodolist());
    }

    public function testDeleteTodo()
    {
        $this->todoListService->saveTodo("1", "luthfi");

        self::assertEquals(1, sizeof($this->todoListService->getTodolist()));

        $this->todoListService->deleteTodo("1");

        self::assertEquals([], $this->todoListService->getTodolist());
    }
}
