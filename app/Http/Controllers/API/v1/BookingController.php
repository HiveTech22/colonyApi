<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Booking;
use App\Jobs\BookingJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\v1\BookingResource;
use App\Http\Resources\v1\BookingCollection;

class BookingController extends Controller
{

    public function index()
    {
        return new BookingCollection(Booking::all());
    }

    public function store(BookingRequest $request)
    {
        $this->dispatchSync(BookingJob::fromRequest($request));

        $this->validate($request, [
            'property_id'     => ['required'],
        ]);

        $booking = Booking::create([
            'property_id'       => $request->input('property_id'),
            'author_id'         => auth()->id() ?? 1
        ]);
        
        return (new BookingResource($booking))
        ->response()
        ->setStatusCode(201);
    }

    public function show(Booking $booking)
    {
        return (new BookingResource($booking))
        ->response()
        ->setStatusCode(200);
    }

    public function update(Request $request, Booking $booking)
    {
        $this->validate($request, [
            'description'     => ['sometimes', 'min:5']
        ]);

        $booking->update([
            'property_id'        => $request->input('property_id'),
        ]);

        return (new BookingResource($booking))
        ->response()
        ->setStatusCode(200);
    }

    public function destroy(Booking $booking)
    {
        try {

            $booking->delete();

            return response()->json([
                'message'=>'Booking Deleted Successfully!!', 204
            ]);
        } catch (\Exception $e) {

            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while deleting a booking!!'
            ]);
        }
        
    }
}
