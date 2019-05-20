<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShortLink;
use App\Group;

class LinkController extends Controller
{
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
            abort(404);
        } else {
            if (now()->greaterThan($group->expiry)) {
                abort(419);
                // TODO : trigger files delete to free space
            } else {
                $group->load('files');
                return view('group', ['group' => $group]);
            }
        }
    }
}
