@extends('errors.layout')

@section('title', 'Server Error | Gundaling Farmstead')

@section('content')
    <img src="/images/mascot/cow_mascot_error.png" alt="Worried cow mascot" class="mascot">
    <p class="code">500</p>
    <h1>Something burned in the kitchen.</h1>
    <p class="message">
        Our server hit a snag preparing this page. Our team has been notified — try again shortly.
    </p>
    <div class="actions">
        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
        <a href="https://wa.me/6282162599980" target="_blank" rel="noopener" class="btn btn-gold">Message us on WhatsApp</a>
    </div>
@endsection
