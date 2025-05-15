<?php
namespace App\Traits;
use App\Http\Controllers\storage;
use Illuminate\Support\Str;

trait StorageImageTrait
{
    public function storageTraitUpload( $request, $fileName, $foderName)
    {
        if ($request->hasFile($fileName)) {
            
            $file = $request->$fileName;
           
            $fileNameOrigin =  $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
           
            $FilePath = $request->file($fileName)->storeAs('public/' . $foderName . '/' . auth()->id(), $fileNameHash);
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => \Storage::url($FilePath)
            ];
            return $dataUploadTrait;
        } else {
            return null;
        }
    }

    public function storageTraitUploadMultiple( $file, $foderName)
    {
        
           
            $fileNameOrigin =  $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
           
            $FilePath = $file->storeAs('public/' . $foderName . '/' . auth()->id(), $fileNameHash);
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => \Storage::url($FilePath)
            ];
            return $dataUploadTrait;
        
    }
}