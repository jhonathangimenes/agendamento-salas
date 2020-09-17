<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index()
    {
        $sector = Sector::all();
        return response()->json($sector);
    }

    public  function store(Request $request)
    {
        $sector = new Sector();
        $sector->fill($request->all());
        $sector->save();

        return response()->json($sector);
    }

    public function show($id)
    {
        $sector = Sector::find($id);

        if(!$sector) {
            return response()->json([
                'message' => 'Not found'
            ],404);
        }

        return response()->json($sector);
    }

    public function update(Request $request, $id)
    {
        $sector = Sector::find($id);

        if(!$sector) {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }

        $sector->fill($request->all());
        $sector->save();

        return response()->json($sector, 201);
    }

    public function destroy($id)
    {
        $sector = Sector::find($id);

        if(!$sector) {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }

        return response()->json($sector->delete(), 204);
    }
}
