<?php

namespace App\Repositories;

use App\Interfaces\RoomRepositoryInterface;
use App\Models\Room;
use App\Models\Amenity;
use Illuminate\Http\Request;
class RoomRepository implements RoomRepositoryInterface 
{
    public function getAllRooms() 
    {
        return Room::all();
    }

    public function getRoomById($RoomId) 
    {
        return Room::findOrFail($RoomId);
    }

    public function deleteRoom($RoomId) 
    {
        Room::destroy($RoomId);
    }

    public function storeRoom(Request $request) 
    {  
        
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'size' => 'required',
            'maximum_occupancy' => 'required',
            'price' => 'required',
            'photo' => 'required',
        ]);

        if($request->file('photo')){
            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);
        }

        $room = new Room();
        $room->name = $request->name;
        $room->description = $request->description;
        $room->size = $request->size;
        $room->maximum_occupancy = $request->maximum_occupancy;
        $room->price = $request->price;
        $room->photo =  $filename;
        $room->save();

        foreach($request->amenities as $amenity){
          \DB::table('room_amenity')->insert([
            'room_id' => $room->id,
            'amenity_id' => $amenity
        ]);
        }

        return redirect()->route('rooms.index');
    }

    public function editRoom($RoomId){
        $room = Room::find($RoomId);
        $selected_amenities = $room->amenities;
        $amenities = Amenity::all();
        return view('room.edit', compact('room', 'amenities', 'selected_amenities'));
    }

    public function updateRoom(Request $request, $RoomId) 
    {
        $room =  Room::find($RoomId);
       
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'size' => 'required',
            'maximum_occupancy' => 'required',
            'price' => 'required',
            'photo' => '',
        ]);

        if($request->file('photo')!=null){
            $file = $request->file('photo');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);
        }else{
            $filename = $room->photo;
        }

        
        $room->name = $request->name;
        $room->description = $request->description;
        $room->size = $request->size;
        $room->maximum_occupancy = $request->maximum_occupancy;
        $room->price = $request->price;
        $room->photo =  $filename;
        $room->save();

        \DB::table('room_amenity')->where('room_id', '=', $room->id)->delete();

        foreach($request->amenities as $amenity){
          \DB::table('room_amenity')->insert([
            'room_id' => $room->id,
            'amenity_id' => $amenity
        ]);
        }

        return redirect()->route('dashboard');
    }

    public function destroyRoom($RoomId){
        Room::destroy($RoomId);
        return redirect()->route('rooms.index');
    }

}
