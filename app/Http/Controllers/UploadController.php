<?php

namespace App\Http\Controllers;


use Storage;
use App\File;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class UploadController extends Controller
{
    /**
     * Handles the file upload
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws UploadMissingFileException
     * @throws \Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException
     */
    public function upload(Request $request) {
        // create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        // receive the file
        $save = $receiver->receive();
        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need, current example uses `move` function. If you are
            // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
            return $this->saveFile($save->getFile());
        }
        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();
        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true
        ]);
    }

    protected function saveFile(UploadedFile $file) {
        $group = session('pending_group', 'create');
        if ($group === 'create') {
            $group = Group::create([
                'slug' => hash('sha256', random_bytes(25)),
                'name' => 'Untitled'
            ]);
            session(['pending_group' => $group->id]);
        } else {
            $group = Group::findOrFail($group);
        }
        $path = $file->store('files');
        $file = File::create([
            'slug' => hash('sha256', random_bytes(25)),
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'deletepasswd' => hash('sha512', random_bytes(50)),
            'group_id' => $group->id,
            'size' => Storage::size($path),
            'checksum' => md5(Storage::get($path))
        ]);
        $group->load('files');
        return response()->json(['file' => $file, 'group' => $group]);
    }

    public function publishGroup(Request $request) {
        $group = Group::findOrFail(session('pending_group'));
        $request->validate([
            'name' => 'max:250',
            'expiry' => [
                'required',
                Rule::in(['86400', '604800', '2635200', '31557600'])
            ]
        ]);
        if ($group->files->count() == 0) {
            return abort(400);
        } elseif ($request->filled(['name', 'expiry'])) {
            $group->name = $request->input('name');
            $group->expiry = now()->addSeconds($request->input('expiry'));
            $group->save();
            session(['pending_group' => 'create']);
            return redirect()->route('showGroup', ['slug' => $group->slug]);
        } else {
            $group->name = $group->files->first()->name;
            $group->expiry = now()->addSeconds($request->input('expiry'));
            $group->save();
            session(['pending_group' => 'create']);
            return redirect()->route('showGroup', ['slug' => $group->slug]);
        }
    }
}
