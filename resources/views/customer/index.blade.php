@extends('layouts.customer')

@section('content')
  <table>
    <thead>
        <tr>
            <th>Room</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rooms as $room)
        <tr>
            <td>{{$room->name}}</td>
            <td><a href='{{route("reservation.form", $room->id)}}'>Book</a></td>
        </tr>
        @endforeach
    </tbody>
  </table>
@endsection