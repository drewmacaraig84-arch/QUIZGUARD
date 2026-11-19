<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::query();

        // filter by roles
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        // filter by actions
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // search by school id number
        if ($request->filled('school_id_num')) {
            $query->where('school_id_num', $request->school_id_num);
        }

        // ordered by newest and limit of 20 rows
        $logs = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('admin.activity_logs', ['logs' => $logs]);
    }
}
