<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface RoomRepositoryInterface 
{
    public function getAllRooms();
    public function getRoomById($roomId);
    public function deleteRoom($roomId);
    public function storeRoom(Request $request);
    public function editRoom($roomId);
    public function updateRoom(Request $request, $roomId);
    public function destroyRoom($roomId);
}