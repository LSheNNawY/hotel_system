<?php

namespace App\Http\Controllers;

use App\DataTables\ReservationsDatatable;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(ReservationsDatatable $reservationsDatatable)
    {
        return $reservationsDatatable->render('admin.reservations.index', ['title' => 'Reservations']);
    }

    public function approve(Request $request, $case, $id)
    {
        $reservation = Reservation::find($id);
        if ($case == 'approve') {
            $reservation->update([
                'approved_by' => auth()->user()->id
            ]);
            return \response('approved');
        } else {
            $reservation->update([
                'approved_by' => null
            ]);
            return \response('disapproved');
        }
    }
}
