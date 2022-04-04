@component('mail::message')
    # Introduction

    Hi {{$advertiser->name}},<br>

    @foreach($advertiser->ads as $ad)
        The Ad With Title ({{$ad->title}}) will start tomorrow.
    @endforeach

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
