<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tiket;
use App\Models\TipeTiket;
use App\Models\Event;
use Illuminate\Http\Request;

class TicketManagementController extends Controller
{
    /**
     * Display integrated ticket and ticket type management
     */
    public function index()
    {
        $tipeTikets = TipeTiket::paginate(10);
        $tickets = Tiket::with('event', 'tipeTiket')->paginate(10);
        $events = Event::all();

        return view('admin.ticket-management.index', compact('tipeTikets', 'tickets', 'events'));
    }
}
