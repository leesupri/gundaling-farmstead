@extends('errors.layout')

@section('title', 'Session Expired | Gundaling Farmstead')

@section('content')
    <img src="/images/mascot/cow_mascot_question.png" alt="Confused cow mascot" class="mascot">
    <p class="code">419</p>
    <h1>That took a while.</h1>
    <p class="message">
        Your session expired before the form was submitted. Go back and give it another try.
    </p>
    <div class="actions">
        <a href="javascript:history.back()" class="btn btn-primary">Go Back</a>
        <a href="{{ route('home') }}" class="btn btn-secondary">Back to Home</a>
    </div>
@endsection
