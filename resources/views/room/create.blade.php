@extends('layouts.init')

@section('content')
<form action="{{route('rooms.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="description" placeholder="Description">
    <input type="file" name="photo" placeholder="Photo">
    <input type="number" name="size" placeholder="Size">
    <input type="number" name="maximum_occupancy" placeholder="Max Occupancy">
    <input type="number" name="price" placeholder="Price">
    <select class="js-example-basic-multiple" name="amenities[]" multiple="multiple">
        @foreach($amenities as $amenity)
        <option value={{$amenity->id}}>{{$amenity->name}}</option>
        @endforeach
    </select>
    <button type='submit'>Submit</button>
</form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection