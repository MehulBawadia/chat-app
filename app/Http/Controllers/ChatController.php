<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Get all the rooms available.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRooms()
    {
        return Room::all();
    }

    /**
     * Get all the messages of the given room id.
     *
     * @param  integer  $roomId
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllMessages($roomId, Request $request)
    {
        return Message::with('user')
                ->where('room_id', $roomId)
                ->orderBy('created_at', 'DESC')
                ->get();
    }

    /**
     * Add a new message in the given room id.
     *
     * @param  integer  $roomId
     * @param  \Illuminate\Http\Request $request
     * @return \App\Models\Message
     */
    public function addNewMessage($roomId, Request $request)
    {
        return Message::create([
            'user_id' => auth()->id(),
            'room_id' => $roomId,
            'content' => $request->content,
        ]);
    }
}
