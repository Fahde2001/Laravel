<?php

namespace App\Http\Controllers;

use App\Http\DTO\MatterDTO;
use App\Models\Matter;
use App\Models\Note;
use App\Models\Students;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function GetMattersBySupplyChain($idSupplyChain,$idStudent)
    {
        $user=auth()->user();
        $student=Students::where('user_id',$user->id)->where('supply_chains',$idSupplyChain)->where('idStudent',$idStudent)->get();
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }
        $matters=Matter::where('supply_chains',$idSupplyChain)->get();

        $mattersDTO=$matters->map(function ($matter){
            return new MatterDTO($matter->name,$matter->cof);
        });
        return response()->json([$mattersDTO]);
    }
    public function AddMattersNotes(Request $request, $idSupplyChain, $idStudent)
    {
        $request->validate([
            '*' => 'required|array',
            '*.note' => 'required|integer|between:0,20',
            '*.mattreName' => 'required|string',
            '*.coefficient' => 'required'
        ]);

        $user = auth()->user();
        $student = Students::where('user_id', $user->id)
            ->where('supply_chains', $idSupplyChain)
            ->where('idStudent', $idStudent)
            ->first();

        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        $notes = [];
        foreach ($request->all() as $note) {
            $matter = Note::create([
                'note' => $note['note'],
                'mattreName' => $note['mattreName'],
                'coefficient' => $note['coefficient'],
                'supply_chains' => $idSupplyChain,
                'student' => $idStudent,
            ]);
            $notes[] = $matter;
        }

        return response()->json(['message' => 'Notes added successfully', 'notes' => $notes], 201);
    }

}
