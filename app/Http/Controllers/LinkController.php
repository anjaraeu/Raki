<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Jobs\DeleteFile;
use App\Jobs\DeleteZip;
use App\ShortLink;
use App\Group;
use App;

class LinkController extends Controller
{
    public static function createLinkAjax(Group $group, $link) {
        ShortLink::create([
            'link' => $link,
            'group_id' => $group->id
        ]);
        return route('link.handle', ['link' => $link]);
    }

    public static function createLink(Group $group, $link) {
        ShortLink::create([
            'link' => $link,
            'group_id' => $group->id
        ]);
        return redirect()->route('link.handle', ['link' => $link]);
    }

    public function handleLink($link) {
        $group = ShortLink::where('link', $link)->get()->first()->group;
        if (empty($group)) {
            return abort(404);
        } else {
            return redirect()->route('group.show', ['group' => $group]);
        }
    }
}
