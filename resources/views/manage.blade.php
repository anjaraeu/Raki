@extends('templates.app')

@section('content')
    <div class="ui container first">
        <div class="ui segment">
            <h1 class="ui header">
                {{ __('group.manage.title') }}
                <div class="sub header">
                    {{ __('group.welcome._', ['name' => $group->name, 'app' => config('app.name')]) }}
                </div>
            </h1>

            @if(session('deleted'))
                <div class="ui info message">
                    {{ __('group.manage.deleted') }}
                </div>
            @endif

            <x-file-table type="admin" :group="$group"></x-file-table>
        </div>
    </div>
@endsection
