<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Edition;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mockery\Undefined;

class EditionsDashboardController extends Controller
{
    //TODO de juiste gegevens in de html table zetten en het create maken en verwijderen
    public function indexEditions()
    {
        $editions = Edition::orderBy('endDate', 'desc')->simplePaginate(10);

        $date = Carbon::now();
        $futureDate = Carbon::now()->addMonths(3);
        $upcomingEditions =  Edition::whereBetween('endDate',  [$date, $futureDate])->get();
        $dates = [];
        foreach ($upcomingEditions as $edition) {
            $dates[$edition->id] = $edition->beginDateUpload;
        }

        $nearestDate = min($dates);
        $currentEditionId = array_search($nearestDate, $dates);
        unset($dates[$currentEditionId]);

        $currentEdition = Edition::where('id', $currentEditionId)->first();
        $upcomingEdition = Edition::where('id', array_key_first($dates))->first();

        return view('/pages/dashboard/admin/editions/editionsIndex', ['editions' => $editions, 'currentEdition' => $currentEdition, 'upcomingEdition' => $upcomingEdition]);
    }

    public function indexEdition($id)
    {
        $edition = Edition::find($id);
        $bookings = $edition->bookings()->paginate(10);
        return view('/pages/dashboard/admin/editions/editionIndex', ['edition' => $edition, 'bookings' => $bookings]);
    }

    public function indexBookings()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('/pages/dashboard/admin/editions/bookingsIndex', ['bookings' => $bookings]);
    }

    public function indexBooking($id)
    {

        $booking = Booking::find($id);
        $files = $booking->files()->paginate(10);
        $links = [];
        foreach ($files as $file) {
            array_push($links, Storage::url($file->location));
        }
        return view('/pages/dashboard/admin/editions/bookingIndex', ['booking' => $booking, 'files' => $files, 'links' => $links]);
    }

    public function downloadFile($bookingId, $fileName)
    {
        if (app()->environment('local')) {
            $path = (public_path("storage" . '\\' . "$fileName"));
        } else {
            $path = '/home/rozenjq425/domains/keiennieuws.nl/public_html/storage/' . $fileName;
        }
        return response()->download($path);
    }

    public function editEdition($id)
    {
        $edition = Edition::find($id);
        $bookings = $edition->bookings()->paginate(10);
        return view('/pages/dashboard/admin/editions/editionEdit', ['edition' => $edition, 'bookings' => $bookings]);
    }

    public function updateEdition(Request $request, $id)
    {
        $edition = Edition::find($id);
        $edition->fill($request->input());
        $edition->save();
        $message = "U heeft succesvol de editie " . $edition->title . " gewijzigd";
        return back()->with('success', $message);
    }

    public function deleteEdition($id)
    {
        $edition = Edition::find($id);
        $message = "U heeft succesvol de editie " . $edition->title . " verwijdert";
        $bookings = $edition->bookings()->get();
        foreach ($bookings as $booking) {
            $booking->delete();
        }
        $edition->delete();
        return back()->with('success', $message);
    }

    public function deleteBooking($id)
    {
        $booking = Booking::find($id);
        $message = "U heeft succesvol de booking " . $booking->title . " verwijdert";
        foreach ($booking->files()->get() as $file) {
            $filePath = null;
            if (app()->environment('local')) {
                $filePath = (public_path("storage" . '\\' . "$file->location"));
            } else {
                $filePath = '/home/rozenjq425/domains/keiennieuws.nl/public_html/storage/' . $file->location;
            }
            Storage::disk('local')->delete($filePath);
        }
        $booking->delete();
        return back()->with('success', $message);
    }
}
