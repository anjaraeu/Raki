<?php

namespace App\Http\Controllers;

use App\Report;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Group $group
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group)
    {
        return view('report', ['group' => $group]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Group $group)
    {
        $request->validate([
            'type' => [Rule::in(['spam', 'identity', 'shock', 'copyright', 'confidential'])]
        ]);
        $input = serialize($request->input());
        switch ($request->input('type')) {
            case 'spam':
            case 'shock':
            case 'confidential':
                $report = Report::create([
                    'group_id' => $group->id,
                    'reason' => $input,
                    'processed' => false
                ]);
                return $report;
                break;

            case 'identity':
                $request->validate([
                    'who' => 'required|filled'
                ]);
                $report = Report::create([
                    'group_id' => $group->id,
                    'reason' => $input,
                    'processed' => false
                ]);
                return $report;
                break;

            case 'copyright':
                $request->validate([
                    'who' => 'required|filled',
                    'what' => 'required|filled',
                    'sign' => 'required|filled'
                ]);
                $report = Report::create([
                    'group_id' => $group->id,
                    'reason' => $input,
                    'processed' => false
                ]);
                return $report;
                break;

            default:
                return abort(400);
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Report  $report
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Report $report)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Report  $report
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Report $report)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return response()->json(true);
    }
}
