<?php

namespace App\Http\Controllers;

use App\Views\View;

class CountController
{
    public function home()
    {
        header('Location: /increment');
    }

    public function increment()
    {
        $count = $_SESSION['count'] ?? 0;

        $_SESSION['count'] = ++$count;

        return new View('Count/index.html', [
            'count' => $count
        ]);
    }

    public function decrement()
    {
        $count = $_SESSION['count'] ?? 0;

        $_SESSION['count'] = --$count;

        return new View('Count/index.html', [
            'count' => $count
        ]);
    }
}