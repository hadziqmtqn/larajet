<?php

namespace App\Http\Controllers;

use App\Http\Requests\LetterTemplateRequest;
use App\Models\Letter;
use App\Models\LetterTemplate;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class LetterTemplateController extends Controller
{
    public function index()
    {
        return LetterTemplate::all();
    }

    public function store(LetterTemplateRequest $request)
    {
        try {
            $letter = Letter::where('category', $request->input('category'))
                ->first();

            if (!$letter) {
                return redirect()->back()->with('error', 'category tidak ditemukan');
            }

            $letterTemplate = new LetterTemplate();
            $letterTemplate->name = $request->input('name');
            $letterTemplate->email = $request->input('email');
            $letterTemplate->date = $request->input('date');
            $letterTemplate->save();

            $templateProcessor = new TemplateProcessor($letter->getFirstMediaUrl('file'));

            // Ganti placeholder dengan data dari form
            $templateProcessor->setValue('name', $letterTemplate->name);
            $templateProcessor->setValue('email', $letterTemplate->email);
            $templateProcessor->setValue('date', $letterTemplate->date);

            // Simpan file hasil ke storage sementara
            $outputFileName = 'generated-template-' . time() . '.docx';
            $outputPath = Storage::path('temp/' . $outputFileName);
            Storage::makeDirectory('temp'); // Buat folder temp jika belum ada
            $templateProcessor->saveAs($outputPath);

            // Tambahkan file ke media library
            $letterTemplate->addMedia($outputPath)
                ->toMediaCollection('letters');

            // Hapus file sementara
            Storage::delete('temp/' . $outputFileName);
        }catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'Data gagal disimpan!');
        }

        return redirect()->back()->with('success', 'Surat berhasil disimpan dan diunggah!');
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
        try {
            $letterTemplate->clearMediaCollection('letters');
            $letterTemplate->delete();
        }catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'Data gagal dihapus!');
        }

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
