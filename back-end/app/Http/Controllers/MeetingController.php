<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index()
    {
        $meetings = Meeting::all();
        return response()->json($meetings);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();

        $starDateTime = date($request->start_date);
        $endDateTime = date($request->end_date);
        $meetingTime = strtotime($endDateTime) - strtotime($starDateTime);

        if (Meeting::isMeetingToday($starDateTime, $user->id)) {
            return response()->json([
                'status' => 'Meeting day limit'
            ], 406);
        }

        if ($meetingTime > 3600) {
            return response()->json([
                'status' => 'Meeting time limit'
            ], 406);
        }

        if ($meetingTime < 0) {
            return response()->json([
                'status' => 'End time cannot be less than start time'
            ], 406);
        }
        $meeting = new Meeting();
        $meeting->fill($request->all());
        $meeting->user_id = $user->id;
        $meeting->save();

        return response()->json($meeting);
    }

    public function show($id)
    {
        $meeting = Meeting::find($id);

        if(!$meeting) {
            return response()->json([
                'message' => 'Not found'
            ],404);
        }

        return response()->json($meeting);
    }

    public function update(Request $request, $id)
    {
        $meeting = Meeting::find($id);

        if(!$meeting) {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }

        $starDateTime = date($request->start_date);
        $endDateTime = date($request->end_date);
        $meetingTime = strtotime($endDateTime) - strtotime($starDateTime);

        if (Meeting::isMeetingToday($starDateTime, $meeting->user_id)) {
            return response()->json([
                'status' => 'Meeting day limit'
            ], 406);
        }

        if ($meetingTime > 3600) {
            return response()->json([
                'status' => 'Meeting time limit'
            ], 406);
        }

        if ($meetingTime < 0) {
            return response()->json([
                'status' => 'End time cannot be less than start time'
            ], 406);
        }

        $meeting->fill($request->all());
        $meeting->save();

        return response()->json($meeting, 201);
    }

    public function destroy($id)
    {
        $meeting = Meeting::find($id);

        if(!$meeting) {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }

        return response()->json($meeting->delete(), 204);
    }
}
