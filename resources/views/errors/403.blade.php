@extends('errors.layout')

@section('title', 'Access Denied | Gundaling Farmstead')

@section('content')
    <img src="/images/mascot/cow_mascot_question.png" alt="Confused cow mascot" class="mascot">
    <p class="code">403</p>
    <h1>This field is fenced off.</h1>
    <p class="message">
        You don't have permission to graze here. If you think this is a mistake, reach out to us.
    </p>
    <div class="actions">
        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
        <a href="https://wa.me/6282162599980" target="_blank" rel="noopener" class="btn btn-gold">Message us on WhatsApp</a>
    </div>
@endsection
