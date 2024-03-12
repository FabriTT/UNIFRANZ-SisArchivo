<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ZipController extends Controller
{
    public function createBackup()
    {

        Artisan::call('backup:run');
        $storagePath = storage_path();
        $backupPath = storage_path('backups');
        $backupFolderName = 'Respaldo de archivos';
        $backupFileName = $backupFolderName  . now()->format('YmdHis'). '.zip';
        
        if (!File::exists($backupPath)) {
            File::makeDirectory($backupPath, 0755, true, true);
        }
        
        // Verificar si la carpeta de respaldo ya existe
        $backupFolderPath = $backupPath . '/' . $backupFolderName;
        if (!File::exists($backupFolderPath)) {
            File::makeDirectory($backupFolderPath, 0755, true, true);
        }
        
        // Crear un archivo ZIP de la carpeta storage
        $zip = new ZipArchive();
        $zip->open($backupFolderPath . '/' . $backupFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($storagePath . '/app/public'),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );
        
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = 'storage/app/public/' . substr($filePath, strlen($storagePath . '/app/public') + 1);
        
                $zip->addFile($filePath, $relativePath);
            }
        }
        
        $zip->close();
        
        // Almacenar el archivo ZIP dentro de la carpeta en el disco 'escritorio'
        Storage::disk('escritorio')->put($backupFolderName . '/' . $backupFileName, file_get_contents($backupFolderPath . '/' . $backupFileName));
        
        // Eliminar el archivo temporal creado en la carpeta de backups
        File::delete($backupFolderPath . '/' . $backupFileName);
        
        return 'ok';
    }
}
