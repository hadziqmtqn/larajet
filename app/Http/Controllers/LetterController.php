<?php

namespace App\Http\Controllers;

use App\Http\Requests\LetterRequest;
use App\Models\Letter;
use App\Models\LetterTemplate;
use Exception;
use Illuminate\Support\Facades\Log;

class LetterController extends Controller
{
    public function index()
    {
        $letters = Letter::get();
        $letterTemplates = LetterTemplate::get();

        return view('letter.index', compact('letters', 'letterTemplates'));
    }

    public function store(LetterRequest $request)
    {
        try {
            $letter = new Letter();
            $letter->category = $request->input('category');
            $letter->save();

            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $letter->addMediaFromRequest('file')->toMediaCollection('file');
            }
        }catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'Data gagal disimpan!');
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    public function show(Letter $letter)
    {
        return $letter;
    }

    public function update(LetterRequest $request, Letter $letter)
    {
        $letter->update($request->validated());

        return $letter;
    }

    public function destroy(Letter $letter)
    {
        try {
            $letter->clearMediaCollection('file');
            $letter->delete();
        }catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'Data gagal dihapus!');
        }

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
