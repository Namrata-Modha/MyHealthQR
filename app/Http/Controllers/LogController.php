<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * 
     * Display a paginated list of logs with related notifications and QR codes.
     *
     * This method retrieves logs from the database, including their related
     * notifications and QR codes, orders them by the 'view_timestamp' field
     * in descending order, and paginates the results to show 10 logs per page.
     * The paginated logs are then passed to the 'logs' view for rendering.
     *
     * @return \Illuminate\View\View The view displaying the paginated logs.
    */
    public function index()
    {
        $userId = Auth::id();

        $logs = Log::with(['qrCode', 'notifications'])
            ->whereHas('qrCode', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orWhereHas('notifications', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderBy('view_timestamp', 'desc')
            ->paginate(10);

        return view('logs', compact('logs'));
    }



}
