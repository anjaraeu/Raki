<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\DeleteFile;
use App\Jobs\DeleteZip;
use App\ShortLink;
use App\Group;

class LinkController extends Controller
{
    public static function createLinkAjax (Group $group, $link) {
        ShortLink::create([
            'link' => $link,
            'group_id' => $group->id
        ]);
        return response()->json(['link' => route('shortLink', ['link' => $link])]);
    }

    public static function createLink (Group $group, $link) {
        ShortLink::create([
            'link' => $link,
            'group_id' => $group->id
        ]);
        return redirect()->route('shortLink', ['link' => $link]);
    }

    public function handleLink ($link) {
        $group = ShortLink::where('link', $link)->get()->first()->group;
        if (empty($group)) {
            return abort(404);
        } else {
            if ($group->files->count() == 0) {
                DeleteZip::dispatch($group);
                return abort(419);
            } elseif (now()->greaterThan($group->expiry)) {
                $group->files->each(function($file) {
                    DeleteFile::dispatch($file);
                });
                DeleteZip::dispatch($group);
                return abort(419);
            } else {
                $group->load('files');
                return view('group', ['group' => $group, 'date' => Carbon::parse($group->expiry)->locale(App::getLocale())->isoFormat('LLLL')]);
            }
        }
    }
}
