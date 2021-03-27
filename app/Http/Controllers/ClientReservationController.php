<?php

namespace App\Http\Controllers;

use App\DataTables\AvailableRoomsDatatable;
use App\DataTables\ClientReservationDatatable;
use App\DataTables\RoomsDatatable;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ClientReservationDatatable $clientReservationDatatable
     * @return \Illuminate\Http\Response
     */
    public function index(ClientReservationDatatable $clientReservationDatatable)
    {
        return $clientReservationDatatable->render('client.reservations.index', ['title' => 'My Reservations']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $room = Room::find($request->room_id);
        if ($room->available == 0){
            return \response('Not Available', 400);
        }
        $max = $room->capacity;

        $rules = [
            'price' => 'required|numeric',
            'accompany_number' => "required|min:1|max:$max",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return \response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ], 400);
        }

            Reservation::create([
            'room_id' => $request->room_id,
            'client_id' => auth()->user()->id,
            'accompany_number' => $request->accompany_number,
            'price_paid' => $request->price,
        ]);

            $room->update(['available' => 0]);
            return \response('success');

    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showAvailableRooms(AvailableRoomsDatatable $roomsDatatable)
    {
        return $roomsDatatable->render('client.rooms.index', ['title' => 'Available Rooms']);
    }


    public function makeReservation($id)
    {
        $room = Room::find($id);
        return view('client.rooms.create', ['room' => $room]);
    }
}
