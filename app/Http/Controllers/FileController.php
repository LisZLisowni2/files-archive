<?php

namespace App\Http\Controllers;

use App\Http\Requests\DownloadRequest;
use App\Http\Requests\UploadFormRequest;
use Exception;
use Exceptions\Pest\Exceptions\FileOrFolderNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        // Sprawdzamy, czy plik został przesłany
        if ($request->hasFile('file')) {
            // Pobieramy obiekt pliku   
            $file = $request->file('file');

            // Zapisujemy plik w katalogu publicznym
            $path = $file->store('gallery', 'public');

            return back()->with('path', $path);
        }
    }

    public function downloadPublic(DownloadRequest $request) 
    {
        Gate::authorize('access-login');
        $path = $request->validated('path');
        $pathRelative = pathinfo($path, PATHINFO_DIRNAME). "/";
        $name = pathinfo($path, PATHINFO_BASENAME);

        Log::info("Public download", [
            'path' => $path,
            'user_id' => $request->user()->id,
            'user_ip' => $request->ip(),
        ]);

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->download($path, $name);
        }
        
        return back()->with("error-message", "File not found in public storage");
    }

    public function download(DownloadRequest $request) 
    {
        Gate::authorize('access-admin');
        try {
            $path = $request->validated('path');
            $pathRelative = pathinfo($path, PATHINFO_DIRNAME). "/";
    
            $name = pathinfo($path, PATHINFO_BASENAME);
    
            if (Storage::disk('local')->exists($path)) {
                return Storage::disk('local')->download($path, $name);
            }
    
            return back()->with("error-message", "File not found");
        } catch (Exception $e) {
            Log::error("Error downloading file", [
                'path' => $path ?? "undefined",
                'user_id'=> $request->user()->id,
                'error_message' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'stack_trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error-message','Internal server error')->setStatusCode(500);
        }
    }

    public function downloadBigFile($path = "exports/big_data.csv") 
    {
        Gate::authorize('no-access');

        if (Storage::disk('local')->exists($path)) {
            return response()->streamDownload(function () use ($path) {
                $stream = Storage::disk('local')->readStream($path);
                
                while (!feof($stream)) {
                    echo fread($stream, 2040);
                    flush();
                }

                fclose($stream);
            }, 'secure.csv', [
                'X-Accel-Bufforing' => 'no'
            ]);
        }

        return back()->with("error-message", "File not found");
    }

    public function uploadImg(UploadFormRequest $request) {
        Gate::authorize("access-admin");

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $path = $file->store('uploaded', ($request->scope === 'private' ? 'local' : 'public'));

            return back()->with('path', $path);
        }
    }
}
