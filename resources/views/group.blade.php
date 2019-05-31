@extends('app')

@section('content')
    <div class="ui container first">
        <div class="ui segment">
            <h2>{{ __('group.welcome._', ['name' => $group->name]) }}</h2>
            <p>{{ trans_choice('group.welcome.synopsis', $group->files->count(), ['date' => $date, 'files' => $group->files->count()]) }}</p>
            @if(session('passwd_group', null))
                <div class="ui success message">
                    {{ __('group.passwd', ['passwd' => session('passwd_group'), 'url' => url('/g/'.$group->slug.'/manage?password='.session('passwd_group'))]) }}
                </div>
                {{-- @php
                session(['passwd_group' => null]);
                @endphp --}}
            @endif
            <a href="{{ route('downloadGroup', ['slug' => $group->slug]) }}" class="ui blue button">{{ __('group.download._') }}</a>
            <em>{{ __('group.download.tooltip') }}</em>
            <div class="ui relaxed divided list">
                @foreach ($group->files as $file)
                    <div class="item">
                        <i class="file icon"></i>
                        <div class="content">
                            <a class="header" data-popup-activate="on" href="{{ route('downloadFile', ['slug' => $file->slug]) }}">{{ $file->name }}</a>
                            <div class="ui special popup">
                                @if (preg_match('/^image\//', $file->mime))
                                    <img src="{{ route('previewFile', ['slug' => $file->slug]) }}" alt="">
                                @endif
                            </div>
                            <div class="description">{{ hfs($file->size) }} | <a target="_blank" href="{{ url('/kb/sha256') }}">sha256</a>: {{ $file->checksum }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
