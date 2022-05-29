@component('mail::message')
**{{ $booking->author()->name() }}** has just booked your property **{{ $booking->property->title() }}**
Login into your dashboard to verify booking so that the booker can proceed to payment.

<img src="{{ asset('storage/' .$booking->property->image) }}" alt="{{ $booking->property->title() }}">


Thanks, <br/>
Team {{ config('app.name') }}, <br/> 
{{ date('Y') }}.
@endcomponent
