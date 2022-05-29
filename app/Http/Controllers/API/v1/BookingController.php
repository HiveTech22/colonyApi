<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Booking;
use App\Jobs\BookingJob;
use Illuminate\Http\Request;
use App\Events\BookingCreated;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Repositories\BookingRepository;
use App\Http\Resources\v1\BookingResource;
use App\Http\Resources\v1\BookingCollection;

class BookingController extends Controller
{

    public function index()
    {
        return new BookingCollection(Booking::where('author_id', auth()->id())->paginate(5));
    }

    public function store(BookingRequest $request, BookingRepository $repository)
    {
        $check = Booking::where('author_id',auth()->id())->where('property_id',$request->property_id)->first();
        
        if (!$check) {
            $booking = $repository->create($request->only([
                'property_id',
            ]));
    
            return (new BookingResource($booking))
                ->response()
                ->setStatusCode(201);
        }else{
            return response()->json(['error'=>'You have booked this property already!'], 500);
        }

        
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

            Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while deleting a booking!!'
            ]);
        }
        
    }
}
