<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;

class SnapSuccesscontroller extends Controller
{
    public function __invoke(Order $order)
    {

        return redirect()->to('snap-success/', $order);
    }
}
