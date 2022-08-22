<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index(){
        $rooms = Room::whereDoesntHave('reservation', function (Builder $query) {
            $query->where('approved', '=', 0);
        })->get();

        $customer_id = auth('customer')->user()->id;
        $reservations = Reservation::where('customer_id', $customer_id)->with('room')->get();
        return view('customer.index', compact('rooms', 'reservations'));
    }

    public function getForm($room){
        $customer_id = auth('customer')->user()->id;
        $room_id = $room;
        return view('customer.reservation', compact('room', 'customer_id', 'room_id'));
    }

    public function reserve($room, Request $request){
        $request->validate([
            'check_out' => 'required',
            'check_in' => 'required',
        ]);
        Reservation::create($request->all());
        return redirect()->route('customer.index');
    }
}
