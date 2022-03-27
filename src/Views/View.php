<?php

namespace App\Views;

class View
{
    public function __construct(private string $path, private array $variables)
    {
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }


}