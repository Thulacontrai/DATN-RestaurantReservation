<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Combo;
use App\Models\Dishes;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PosController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Utilizing caching for dishes and combos if data does not change frequently
            $dishes = Cache::remember('dishes', 60, function () {
                return Dishes::paginate(6);
            });

            $combos = Cache::remember('combos', 60, function () {
                return Combo::paginate(6);
            });

            $upcomingReservations = $this->getUpcomingReservations();

            return view('pos.index', compact('dishes', 'combos', 'upcomingReservations'));
        } catch (\Exception $e) {
            // Logging the error for further analysis
            Log::error('Error fetching data in PosController: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            // Redirect back with an error message
            return back()->withError('An error occurred while fetching data. Please try again.')->withInput();
        }
    }

    private function getUpcomingReservations()
    {
        $now = Carbon::now();
        $inThirtyMinutes = $now->copy()->addMinutes(30);

        return Reservation::where('reservation_time', '>=', $now)
                          ->where('reservation_time', '<=', $inThirtyMinutes)
                          ->where('status', '=', 'Pending') // Assuming 'Pending' is the status for active reservations
                          ->get();
    }
}
