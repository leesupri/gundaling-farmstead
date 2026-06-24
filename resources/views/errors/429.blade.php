@extends('errors.layout')

@section('title', 'Too Many Requests | Gundaling Farmstead')

@section('content')
    <img src="/images/mascot/cow_mascot_question.png" alt="Confused cow mascot" class="mascot">
    <p class="code">429</p>
    <h1>Slow down there.</h1>
    <p class="message">
        You've sent too many requests in a short time. Take a breather and try again in a minute.
    </p>
    <div class="actions">
        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
    </div>
@endsection
