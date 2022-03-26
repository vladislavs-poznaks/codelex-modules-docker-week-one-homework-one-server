<?php

namespace App\Http\Controllers;

class CountController
{
    public function increment()
    {
        $count = $_SESSION['count'] ?? 0;

        $_SESSION['count'] = ++$count;

        echo $_SESSION['count'];
    }

    public function decrement()
    {
        $count = $_SESSION['count'] ?? 0;

        $_SESSION['count'] = --$count;

        echo $_SESSION['count'];
    }
}