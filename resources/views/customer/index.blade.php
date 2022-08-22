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
<hr>
  <label for="">Customers Booking History</label>
  <table>
    <thead>
        <tr>
            <th>Room</th>
            <th>Check In</th>
            <th>Check Out</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reservations as $reservation)
        <tr>
            <td>{{$reservation->room->name}}</td>
            <td>{{$reservation->check_in}}</td>
            <td>{{$reservation->check_out}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
@endsection