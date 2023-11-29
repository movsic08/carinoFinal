@extends('admin.admin-layout')
@section('admin')
<h1>Ratings</h1>

@foreach ($ratings as $rating)
    <div>
        <p>Staff: {{ $rating->staff->name }}</p>
        <p>Rating: {{ $rating->rating }}</p>
        <p>Comment: {{ $rating->comment ?? 'No comment' }}</p>
        <hr>
    </div>
@endforeach

@endsection