<?php

namespace App\Http\Controllers;

use App\Models\Matter;
use App\Models\SupplyChain;
use Illuminate\Http\Request;

class MatterController extends Controller
{
    public function AddMatter(Request $request, $idSupplyChain)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'cof' => 'required|int',
            ]);
            $user = auth()->user();

            $supplyChain = SupplyChain::findOrFail($idSupplyChain);

            $matter = Matter::create([
                'name' => $request->name,
                'cof' => $request->cof,
                'supply_chains' => $supplyChain->idSupply,
                'user' => $user->id,
            ]);


            return response()->json([$matter]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function GetAllMatters($idSupplyChains)
    {
        try {
            $user = auth()->user();
            $matters = Matter::where('user', $user->id)
                ->where('supply_chains', $idSupplyChains)
                ->get(); // Corrected to use get() instead of ::all
            return response()->json($matters);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function UpdateMatter(Request $request, $idMatter)
    {
        try {
            $matter = Matter::findOrFail($idMatter);
            $matter->update($request->all());
            return response()->json($matter);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function DeleteMatter($idMatter)
    {
        try {
            $matter = Matter::findOrFail($idMatter);
            $matter->delete();
            return response()->json(['message' => 'Matter deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
