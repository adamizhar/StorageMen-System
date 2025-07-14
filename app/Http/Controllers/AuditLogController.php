<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // ✅ Eager load user relationship
        $logs = AuditLog::with('user')->latest()->paginate(20);

        return view('audit.index', compact('logs'));
    }
}
