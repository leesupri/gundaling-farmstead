@extends('errors.layout')

@section('title', "We'll Be Right Back | Gundaling Farmstead")

@section('content')
    <img src="/images/mascot/cow_mascot_error.png" alt="Worried cow mascot" class="mascot">
    <p class="code">503</p>
    <h1>Back at the farm for a moment.</h1>
    <p class="message">
        We're doing some quick maintenance. Please check back in a little while.
    </p>
    <div class="actions">
        <a href="https://wa.me/6282162599980" target="_blank" rel="noopener" class="btn btn-gold">Message us on WhatsApp</a>
    </div>
@endsection
