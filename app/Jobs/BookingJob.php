<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Events\BookingCreated;
use App\Http\Requests\BookingRequest;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class BookingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $property;
    private $author;

    public function __construct(
        int $property,
        int $author,
    )
    {
        $this->property = $property;
        $this->author = $author;
    }

    public static function fromRequest(BookingRequest $request): self
    {
        return new static(
            $request->property(),
            $request->author(),
        );
    }

    public function handle()
    {
        $booking = new Booking();
        $booking->property()->associate($this->property);
        $booking->authorRelation()->associate(Auth::user());
        $booking->save();

        event(new BookingCreated($booking));
    }
}
