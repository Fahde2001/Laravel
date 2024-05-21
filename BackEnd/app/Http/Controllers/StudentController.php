<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\SupplyChain;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function createStudent(Request $request,$supplychain)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'age' => 'required|integer',
            ]);
            $supply_chain=SupplyChain::findOrFail($supplychain);
            $user=auth()->user();

            $student = Students::create([
                'name' => $request->name,
                'age' => $request->age,
                'supplyChainName'=>$supply_chain->name,
                'supply_chains' => $supply_chain->idSupply,
                'user_id' => $user->id
            ]);

            return response()->json($student, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getAllStudents($supplyChain)
    {
        try {
            $user=auth()->user();
            $students = Students::where('user_id',$user->id)->where('supply_chains',$supplyChain)->get();
            return response()->json($students);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateStudent(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'age' => 'required|integer',
            ]);

            $student = Students::findOrFail($id);
            $user=auth()->user();
            $student->update([
                'name' => $request->name,
                'age' => $request->age,
                'supply_chains' => $student->supply_chains,
                'user_id' => $user->id
            ]);

            return response()->json($student);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteStudent($id)
    {
        try {
            $student = Students::findOrFail($id);
            $student->delete();
            return response()->json(['message' => 'Student deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
