@extends('templates.app')

@section('content')
    <div class="ui container first">
        <div class="ui segment">
            <h1 class="ui header">
                {{ __('group.welcome._', ['name' => $group->name, 'app' => config('app.name')]) }}
            </h1>
            @if($group->encrypted)
                <div class="ui icon warning message">
                    <i class="lock icon"></i>
                    <div class="content">
                        <div class="header">
                            {{ __('group.encrypted._') }}
                        </div>
                        <p>{{ __('group.encrypted.desc') }}</p>
                    </div>
                </div>
            @endif
            <x-file-table type="normal" :group="$group"></x-file-table>
        </div>
    </div>
@endsection
