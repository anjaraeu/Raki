@foreach ($group->files as $file)
    @if ($group->encrypted && !$file->encrypted)
        <div class="ui icon info message">
            <i class="notched circle loading icon"></i>
            <div class="content">
                <div class="header">
                    {{ __('group.encrypted.wait.title') }}
                </div>
                <p>{{ __('group.encrypted.wait.message') }}</p>
            </div>
        </div>
        @break
    @endif
@endforeach

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
                    @if ($type == 'admin')
                        <a href="{{ route('group.delete', ['group' => $group]) }}" class="ui red labeled medium icon button"><i class="delete icon"></i> {{ __('group.manage.delete.group') }}</a>
                    @else
                        <a data-popup-activate="on" href="{{ route('group.download', ['group' => $group]) }}"
                           class="ui blue labeled medium icon button @if($group->encrypted) disabled @endif">
                            <i class="file archive icon"></i> {{ __('group.download._') }}
                        </a>
                        <div class="ui special popup">
                            <em>{{ __('group.download.tooltip') }}</em>
                        </div>
                    @endif
                </th>
            @else
                <th>
                </th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($group->files as $file)
            <tr
            @if ($group->encrypted && !$file->encrypted)
            class="disabled"
            @endif>
                <td class="collapsing selectable">
                    <a  @if ($group->encrypted)
                            @click.prevent="openModal('{{ $file->id }}')"
                        @else
                            href="{{ route('file.download', ['file' => $file]) }}"
                        @endif>
                        <h4><i class="file export icon"></i> {{ $file->name }}</h4>
                    </a>
                </td>
                <td class="center aligned">
                    {{ $file->checksum }}
                </td>
                <td class="center aligned collapsing">
                    @if ($type == 'admin')
                        <a href="{{ route('file.delete', ['file' => $file]) }}" class="ui red labeled icon button"><i class="delete icon"></i> {{ __('group.manage.delete.file') }}</a>
                    @else
                        <a  @if ($group->encrypted)
                                @click.prevent="openModal('{{ $file->id }}')"
                            @else
                                href="{{ route('file.download', ['file' => $file]) }}"
                            @endif class="ui blue
                                @if ($group->encrypted && !$file->encrypted) disabled @endif
                            labeled icon button">
                            <i class="download icon"></i> {{ __('group.download.single') }}
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="2">
                <p>{{ trans_choice('group.welcome.synopsis', $group->files->count(), ['date' => $group->expiry_formatted, 'files' => $group->files->count(), 'app' => config('app.name')]) }}</p>
            </th>
            <th class="center aligned">
                <a href="{{ route('report.create', ['group' => $group]) }}" class="ui red labeled icon mini basic button"><i class="flag icon"></i>{{ __('group.report._') }}</a>
            </th>
        </tr>
    </tfoot>
</table>

@if($group->encrypted)
    @foreach ($group->files as $file)
        <decrypt-file file="{{ $file->name }}" id="{{ $file->id }}" url="{{ route('file.download', ['file' => $file]) }}"></decrypt-file>
    @endforeach
@endif
