@extends('layouts.customer')

@section('content')
 <form action="{{route('reserve', $room)}}" method="post">
    @csrf
    <input type="hidden" name="room_id" value={{$room_id}}>
    <input type="hidden" name="customer_id" value={{$customer_id}}>
    <input type="date" name="check_in" placeholder="Check In">
    <input type="date" name="check_out" placeholder="Check Out">
    <input type="integer" name="adults" placeholder="Adults">
    <input type="integer" name="children" placeholder="Children">

    <button>Submit</button>
 </form>
@endsection