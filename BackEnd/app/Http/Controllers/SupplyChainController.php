<?php

namespace App\Http\Controllers;

use App\Models\SupplyChain;
use Illuminate\Http\Request;

class SupplyChainController extends Controller
{
    public function user()
    {
        return 'Hello Fahde Im working well';
    }
    //add
    public function AddSupplyChain(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $user = auth()->user();

        $supplyChain = SupplyChain::create([
            'name' => $request->name,
            'users' => $user->id,
        ]);

        return response()->json([
            "message" => true,
            "data" => $supplyChain,
        ]);
    }

    public function GetAllSuppliChain()
    {
        $user=auth()->user();
        $supplyChain=SupplyChain::where('users',$user->id)->get();
        return response()->json(
            $supplyChain
        );
    }
    public function UpdateSupplyChain(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        // Check if the supply chain with the given ID exists
        $supplyChain = SupplyChain::findOrFail($id);

        // Update the supply chain's name
        $supplyChain->name = $request->name;
        $supplyChain->save();

        return response()->json([
            'message' => 'Supply chain updated successfully',
            'data' => $supplyChain
        ]);
    }

    public function DelettSupplyChain($id)
    {
        $suppplyChain=SupplyChain::findOrFail($id);
       // if(empty($suppplyChain)){  abort(404, 'Supply chain not found');}
        $suppplyChain->delete();
        return response()->json([
            'message' => 'Supply chain deleted successfully'
        ]);
    }
}
