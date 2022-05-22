@component('mail::message')
**{{ $booking->author()->name() }}** has just booked your property **{{ $booking->property->title() }}**
Login into your dashboard to verify booking so that the booker can proceed to payment.

@component('mail::panel')
<img src="{{ asset('storage/' .$booking->property->first_image_url) }}" alt="{{ $booking->property->title() }}">
@endcomponent

@component('mail::button', ['url' => route('agent.dashboard')])

Go to Dashboard
@endcomponent

Thanks,
Team {{ application('name') }}, {{ date('Y') }}.
@endcomponent
