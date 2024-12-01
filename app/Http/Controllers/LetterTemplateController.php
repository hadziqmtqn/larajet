<?php

namespace App\Http\Controllers;

use App\Http\Requests\LetterTemplateRequest;
use App\Models\Letter;
use App\Models\LetterTemplate;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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
            $letter = Letter::where('category', $request->input('category'))->first();

            if (!$letter) {
                return redirect()->back()->with('error', 'category tidak ditemukan');
            }

            DB::beginTransaction();
            $letterTemplate = new LetterTemplate();
            $letterTemplate->letter_id = $letter->id;
            $letterTemplate->name = $request->input('name');
            $letterTemplate->email = $request->input('email');
            $letterTemplate->date = $request->input('date');
            $letterTemplate->save();

            // Ambil URL file template dari S3
            $templateUrl = $letter->getFirstMediaUrl('file');

            // Ekstrak nama file dari URL
            $fileName = basename(parse_url($templateUrl, PHP_URL_PATH));

            // Tentukan path file lokal berdasarkan nama file dari URL
            $tempDirectory = storage_path('app/temp');

            // Buat direktori jika belum ada
            if (!is_dir($tempDirectory)) {
                mkdir($tempDirectory, 0775, true);  // Membuat folder jika belum ada
            }

            // Tentukan path lengkap untuk file sementara
            $tempFilePath = $tempDirectory . '/' . $fileName;

            // Unduh file template ke path lokal
            $fileContent = Http::get($templateUrl)->body();
            file_put_contents($tempFilePath, $fileContent);  // Pastikan folder temp ada

            // Gunakan file lokal dengan TemplateProcessor
            $templateProcessor = new TemplateProcessor($tempFilePath);

            // Ganti placeholder dengan data dari form
            $templateProcessor->setValue('name', $request->input('name'));
            $templateProcessor->setValue('email', $request->input('email'));
            $templateProcessor->setValue('date', $request->input('date'));

            // Simpan file hasil ke storage sementara
            $outputFileName = 'generated-template-' . time() . '.docx';
            $outputPath = storage_path('app/temp/' . $outputFileName);
            $templateProcessor->saveAs($outputPath);

            // Tambahkan file ke media library
            $letterTemplate->addMedia($outputPath)
                ->toMediaCollection('letters');

            // Hapus file sementara
            Storage::delete(['temp/' . $fileName, 'temp/' . $outputFileName]);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
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
