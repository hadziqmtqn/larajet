<?php

namespace App\Http\Controllers;

use App\Http\Requests\TexteditorRequest;
use App\Models\Texteditor;
use Illuminate\Support\Facades\Log;

class TexteditorController extends Controller
{
    public function index()
    {
        $texteditors = Texteditor::get();

        return view('texteditor.index', compact('texteditors'));
    }

    public function edit(Texteditor $texteditor)
    {
        return view('texteditor.edit', compact('texteditor'));
    }

    public function store(TexteditorRequest $request)
    {
        try {
            $texteditor = new Texteditor();
            $texteditor->description = $request->input('description');
            $texteditor->save();
        }catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

        return redirect()->back();
    }

    public function update(TexteditorRequest $request, Texteditor $texteditor)
    {
        try {
            $texteditor->description = $request->input('description');
            $texteditor->save();
        }catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

        return redirect()->back();
    }
}
