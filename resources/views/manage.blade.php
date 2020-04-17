@extends('app')

@section('content')
<div class="ui container first">
    <div class="ui segment">
        <h3>{{ $group->name }}</h3>
        @if(session('deleted'))
        <div class="ui info message">
            {{ __('group.manage.deleted') }}
        </div>
        @endif
        <p>{{ trans_choice('group.manage.desc', $group->files->count(), ['files' => $group->files->count()]) }}</p>
        <a href="{{ url('g/'.$group->slug.'/delete') }}" class="ui red button">{{ __('group.manage.delete.group') }}</a>
        <div class="ui relaxed divided list">
            @foreach ($group->files as $file)
                <div class="item">
                    <div class="right floated content">
                        <a href="{{ url('f/'.$file->slug.'/delete') }}" class="ui red button">{{ __('group.manage.delete.file') }}</a>
                    </div>
                    <i class="file icon"></i>
                    <div class="content">
                        <a class="header" href="{{ route('downloadFile', ['file' => $file]) }}">{{ $file->name }}</a>
                        <div class="description">{{ hfs($file->size) }} | {{ $file->checksum }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
