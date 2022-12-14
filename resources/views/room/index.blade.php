<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>

               <table>
                 <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                 </thead>
                 <tbody>
                    @foreach($rooms as $room)
                    <tr>
                        <td>{{$room->name}}</td>
                        <td>
                            <a href='{{route("rooms.edit", $room->id)}}'>Edit</a>
                            <form action="{{route('rooms.destroy', $room->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type='submit'>Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                 </tbody>
               </table>
            </div>
        </div>
    </div>
    <label for="">Pending Booking/Reservation List</label>
    <table>
        <thead>
            <tr>
                <th>Room</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
            <tr>
                <td>{{$reservation->room->name}}</td>
                <td><a href="{{route('approve', $reservation->id)}}">Approve</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>


