@extends('templates.app')

@section('content')
<div class="ui container first">
    <div class="ui segment">
        <h2>{{  __('group.report.create', ['group' => $group->name]) }}</h2>

        @if($group->encrypted)
        <div class="ui icon warning message">
            <i class="lock icon"></i>
            <div class="content">
                <div class="header">{{ __('group.report.encrypted._') }}</div>
                <div class="description">{{ __('group.report.encrypted.disclaimer') }}</div>
            </div>
        </div>
        @endif

        <report-form encrypted="{{ $group->encrypted }}" slug="{{ $group->slug }}" fileslug="{{ $group->files->first()->slug }}"></report-form>
    </div>
</div>
@endsection
