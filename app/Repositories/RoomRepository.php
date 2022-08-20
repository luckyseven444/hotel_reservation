<?php

namespace App\Repositories;

use App\Interfaces\RoomRepositoryInterface;
use App\Models\Room;
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

        foreach($request->amenities as $amenity){print_r(90);
          \DB::table('room_amenity')->insert([
            'room_id' => $room->id,
            'amenity_id' => $amenity
        ]);
        }

        return $room;
    }

    public function updateRoom($RoomId, array $newDetails) 
    {
        return Room::whereId($RoomId)->update($newDetails);
    }

}
