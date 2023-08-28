<?php

namespace App\FormValidator\Helpers;

final class Request
{
    private array $data = [];

    public function getAll(): array
    {
        return $this->data;
    }

    public function get(string $key): mixed
    {
        return $this->data[$key] ?? null;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }
}
