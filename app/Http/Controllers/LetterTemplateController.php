<?php

namespace App\Http\Controllers;

use App\Http\Requests\LetterTemplateRequest;
use App\Models\LetterTemplate;

class LetterTemplateController extends Controller
{
    public function index()
    {
        return LetterTemplate::all();
    }

    public function store(LetterTemplateRequest $request)
    {
        return LetterTemplate::create($request->validated());
    }

    public function show(LetterTemplate $letterTemplate)
    {
        return $letterTemplate;
    }

    public function update(LetterTemplateRequest $request, LetterTemplate $letterTemplate)
    {
        $letterTemplate->update($request->validated());

        return $letterTemplate;
    }

    public function destroy(LetterTemplate $letterTemplate)
    {
        $letterTemplate->delete();

        return response()->json();
    }
}
