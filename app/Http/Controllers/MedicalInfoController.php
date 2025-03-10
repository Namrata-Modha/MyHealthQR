<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalInfo;
use Illuminate\Support\Facades\Auth;

class MedicalInfoController extends Controller
{
    public function show()
    {
        $medicalInfo = MedicalInfo::where('user_id', Auth::id())->first();
        return view('medical_info', compact('medicalInfo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'allergies' => 'nullable|json',
            'conditions' => 'nullable|json',
            'medications' => 'nullable|json',
        ]);

        $medicalInfo = MedicalInfo::updateOrCreate(
            ['user_id' => Auth::id()],
            $request->all()
        );

        return redirect()->route('medical.info')->with('success', 'Medical info updated successfully!');
    }
}
