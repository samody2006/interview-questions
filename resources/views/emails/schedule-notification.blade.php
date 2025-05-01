@component('mail::message')
    # Irrigation Schedule {{ ucfirst($action) }}

    A schedule has been {{ $action }} for the zone "{{ $zoneName }}".

    ## Schedule Details:
    - Start Time: {{ $schedule->start_time }}
    - Duration: {{ $schedule->duration }}
    - Days: {{ implode(', ', $schedule->days_of_week) }}

    @component('mail::button', ['url' => config('app.url')])
        View in Dashboard
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
