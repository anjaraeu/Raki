@extends('templates.app')

@section('content')
    <div class="ui container first">
        <div class="ui segment">
            <h2>{{ __('group.welcome._', ['name' => $group->name, 'app' => config('app.name')]) }}</h2>
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
            <table class="ui celled striped table">
                <thead>
                    <tr>
                        <th>
                            {{ trans_choice('group.layout.table.file', $group->files->count())  }}
                        </th>
                        <th>
                            {{ __('group.layout.table.sha256') }} <a href="{{ url('/kb/sha256') }}" target="_blank">(?)</a>
                        </th>
                        @if ($group->files->count() > 1)
                        <th class="collapsing">
                            <a data-popup-activate="on" href="{{ route('downloadGroup', ['slug' => $group->slug]) }}" class="ui blue labeled medium icon button"><i class="file archive icon"></i> {{ __('group.download._') }}</a>
                            <div class="ui special popup">
                                <em>{{ __('group.download.tooltip') }}</em>
                            </div>
                        </th>
                        @else
                        <th>
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($group->files as $file)
                        <tr>
                            <td class="collapsing selectable">
                                <a @if ($group->encrypted)
                                   @click.prevent="openModal('{{ $file->id }}')"
                                   @else
                                   href="{{ route('downloadFile', ['file' => $file]) }}"
                                    @endif>
                                    <h4><i class="file export icon"></i> {{ $file->name }}</h4>
                                </a>
                            </td>
                            <td class="center aligned">
                                {{ $file->checksum }}
                            </td>
                            <td class="center aligned collapsing">
                                <a @if ($group->encrypted)
                                   @click.prevent="openModal('{{ $file->id }}')"
                                   @else
                                   href="{{ route('downloadFile', ['file' => $file]) }}"
                                   @endif class="ui blue labeled icon button"><i class="download icon"></i> {{ __('group.download.single')  }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">
                            <p>{{ trans_choice('group.welcome.synopsis', $group->files->count(), ['date' => $date, 'files' => $group->files->count(), 'app' => config('app.name')]) }}</p>
                        </th>
                        <th class="center aligned">
                            <a href="{{ route('reportGroup', ['group' => $group]) }}" class="ui red labeled icon mini basic button"><i class="flag icon"></i>{{ __('group.report._') }}</a>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @if($group->encrypted)
        @foreach ($group->files as $file)
            <decrypt-file file="{{ $file->name }}" id="{{ $file->id }}" url="{{ route('downloadFile', ['file' => $file]) }}"></decrypt-file>
        @endforeach
    @endif
@endsection
