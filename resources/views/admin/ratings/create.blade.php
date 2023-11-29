@extends('admin.admin-layout')
@section('admin')
<h1>Add Rating</h1>

<form action="{{ route('ratings.store') }}" method="post">
    @csrf
    <label for="staff_id">Select Staff:</label>
    <select name="staff_id" id="staff_id">
        @foreach ($staffMembers as $staff)
            <option value="{{ $staff->id }}">{{ $staff->name }}</option>
        @endforeach
    </select>
    <br>
    <label for="rating">Rating:</label>
    <input type="number" name="rating" id="rating" min="1" max="5" required>
    <br>
    <label for="comment">Comment:</label>
    <textarea name="comment" id="comment"></textarea>
    <br>
    <button type="submit">Submit Rating</button>
</form>
@foreach ($ratings as $rating)
    <div>
        <p>Staff: {{ $rating->staff->name }}</p>
        <p>Rating: {{ $rating->rating }}</p>
        <p>Comment: {{ $rating->comment ?? 'No comment' }}</p>
        <hr>
    </div>
@endforeach

@endsection