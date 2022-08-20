@extends('layouts.init')

@section('content')
<form action="{{route('rooms.update', $room->id)}}" method="post" enctype="multipart/form-data">
    @csrf 
    @method('PUT')
    <input type="text" name="name" placeholder="Name" value="{{$room->name}}">
    <input type="text" name="description" placeholder="Description" value="{{$room->description}}">
    <img src="{{URL::asset('image/'.$room->photo)}}" alt="">
    <input type="file" name="photo" placeholder="Photo">
    <input type="number" name="size" placeholder="Size" value={{$room->size}}>
    <input type="number" name="maximum_occupancy" placeholder="Max Occupancy" value={{$room->maximum_occupancy}}>
    <input type="number" name="price" placeholder="Price" value={{$room->price}}>
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

<!-- @php
    $amenities_arr = $amenities->toArray();
@endphp -->

@endsection

@push('script')
    <script>
        $(function(){
                let amenities =  @json($selected_amenities->pluck('id')->toArray());
                console.log(amenities)
                $(".js-example-basic-multiple").select2().val(amenities).trigger('change.select2');
            });
    </script>
@endpush