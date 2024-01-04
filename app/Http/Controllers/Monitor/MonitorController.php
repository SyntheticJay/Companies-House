<?php

namespace App\Http\Controllers\Monitor;

use App\Http\Controllers\Controller;
use App\Models\Monitor\Monitor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MonitorController extends Controller
{
    public function index()
    {
        $monitors = Monitor::where('user_id', auth()->id())->get();

        return Inertia::render('Monitor', [
            'monitors' => $monitors
        ]);
    }
}
