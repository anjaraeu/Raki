@extends('app')

@section('content')
    <div class="ui container first">
        <div class="ui segment">
            <h2>{{ __('group.welcome._', ['name' => $group->name]) }}</h2>
            <p>{{ __('group.welcome.synopsis') }}</p>
            <a href="{{ route('downloadGroup', ['slug' => $group->slug]) }}" class="ui blue button">{{ __('group.download._') }}</a>
            <em>{{ __('group.download.tooltip') }}</em>
            <div class="ui relaxed divided list">
                @foreach ($group->files as $file)
                    <div class="item">
                        <i class="file icon"></i>
                        <div class="content">
                            <a class="header">{{ $file->name }}</a>
                            <div class="description">{{ hfs($file->size) }} | {{ $file->checksum }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
