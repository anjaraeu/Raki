<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use TusPhp\File;

class TusController extends Controller
{
    public function serve() {
        return app('tus-server')->serve();
    }

    private function extractTusUUID(string $url) {
        $matches = array();
        $result = preg_match('/\/([a-z0-9-]+)$/', $url, $matches);
        return ($result === 1) ? $matches[1]:null;
    }

    private function extractFileExtension(string $name) {
        $matches = array();
        $result = preg_match('/\.([a-z0-9]+)$/i', $name, $matches);
        return ($result === 1) ? $matches[1]:null;
    }

    public function storeFile(File $file) {
        $details = $file->details();
        /*if ($details['size'] > (env('MIX_MAX_FILE_SIZE') * 100)) {
            $file->delete($details['file_path']);
            return response()->json(['file' => 'deleted', 'error' => 'The file is too big'], 413);
        }*/
        session(['last_file' => $details]);
        $payload = [
            'slug' => hash('sha256', random_bytes(25)),
            'name' => $details['name'],
            'group_id' => null,
            'size' => $details['size'],
            'checksum' => hash_file('sha256', $details['file_path']),
            'mime' => $details['metadata']['type'],
            'tus_uuid' => $this->extractTusUUID($details['location'])
        ];
        $payload['path'] = 'files/'.$payload['slug'].'.'.$this->extractFileExtension($details['name']);
        rename($details['file_path'], storage_path('app/'.$payload['path']));
        $file = \App\File::create($payload);
        if (!session()->has('pending_files')) {
            session(['pending_files' => []]);
        }
        session()->push('pending_files', $file);
        return;
    }
}
