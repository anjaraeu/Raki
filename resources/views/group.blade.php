@extends('app')

@section('content')
    <div class="ui container first">
        <div class="ui segment">
            <h2>{{ __('group.welcome._', ['name' => $group->name]) }}</h2>
            <p>{{ trans_choice('group.welcome.synopsis', $group->files->count(), ['date' => $date, 'files' => $group->files->count(), 'app' => config('app.name')]) }}</p>
            @if(session('passwd_group', null))
                <div class="ui success message">
                    {{ __('group.passwd', ['passwd' => session('passwd_group'), 'url' => url('/g/'.$group->slug.'/manage?password='.session('passwd_group'))]) }}
                </div>
                {{-- @php
                session(['passwd_group' => null]);
                @endphp --}}
            @endif
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
            <div class="ui grid">
                <div class="three wide column">
                    <a href="{{ route('downloadGroup', ['slug' => $group->slug]) }}" class="ui blue button">{{ __('group.download._') }}</a>
                </div>
                <div class="right floated right aligned thirteen wide column">
                    <em>{{ __('group.download.tooltip') }} @if($group->encrypted) {{ __('group.encrypted.ziptooltip') }} @endif</em>
                </div>
            </div>
            <div class="ui relaxed divided list">
                @foreach ($group->files as $file)
                    <div class="item">
                        <i class="file icon"></i>
                        <div class="content">
                            <a class="header"
                            @if (preg_match('/^image\//', $file->mime) && !$group->encrypted)
                            data-popup-activate="on"
                            @endif
                            @if ($group->encrypted)
                            v-on:click="openModal('{{ $file->id }}')"
                            @else
                            href="{{ route('downloadFile', ['slug' => $file->slug]) }}"
                            @endif>
                                {{ $file->name }}
                            </a>
                            <div class="ui special popup">
                                @if (preg_match('/^image\//', $file->mime) && !$group->encrypted)
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

    @if($group->encrypted)
        @foreach ($group->files as $file)
            <decrypt-file file="{{ $file->name }}" id="{{ $file->id }}" url="{{ route('downloadFile', ['slug' => $file->slug]) }}" :lang="lang"></decrypt-file>
        @endforeach
    @endif
@endsection
