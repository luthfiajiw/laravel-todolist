<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function homePage(Request $request)
    {
        return response()->view('home', [
            "todolist" => $this->todolistService->getTodolist()
        ]);
    }

    public function addTodo(Request $request) {
        $todo = $request->input('todo');

        if (empty($todo)) {
            return response()->view('home', [
                "todolist" => $this->todolistService->getTodolist(),
                "error" => "Todo is required"
            ]);
        }

        $this->todolistService->saveTodo(uniqid(), $todo);

        return redirect()->action([HomeController::class, 'homePage']);
    }

    public function deleteTodo(Request $request, string $id)
    {
        $this->todolistService->deleteTodo($id);
        return redirect()->action([HomeController::class, 'homePage']);
    }
}
