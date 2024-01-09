<?php

namespace App\Services;

interface TodolistService
{
  function saveTodo(string $id, string $todo);
  function deleteTodo(string $id);
  function getTodolist(): array;
}