@extends('errors.layout')

@section('title', 'Page Not Found | Gundaling Farmstead')

@section('content')
    <img src="/images/mascot/cow_mascot_question.png" alt="Confused cow mascot" class="mascot">
    <p class="code">404</p>
    <h1>This pasture doesn't exist.</h1>
    <p class="message">
        Looks like this page wandered off the farm. Let's get you back to somewhere that exists.
    </p>
    <div class="actions">
        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
        <a href="{{ route('menu') }}" class="btn btn-secondary">View Menu</a>
    </div>
@endsection
