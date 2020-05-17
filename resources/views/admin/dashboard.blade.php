@extends('templates.app')

@section('content')
    <div class="ui container first">
        <div class="ui segment">
            <div class="ui four statistics">
                <div class="statistic">
                    <div class="value">
                        <i class="file icon"></i> {{ $stats['files'] }}
                    </div>
                    <div class="label">
                        {{ __('dashboard.admin.stats.files') }}
                    </div>
                </div>
                <div class="statistic">
                    <div class="value">
                        <i class="folder icon"></i> {{ $stats['groups'] }}
                    </div>
                    <div class="label">
                        {{ __('dashboard.admin.stats.groups') }}
                    </div>
                </div>
                <div class="statistic">
                    <div class="value">
                        <i class="user icon"></i> {{ $stats['users'] }}
                    </div>
                    <div class="label">
                        {{ __('dashboard.admin.stats.users') }}
                    </div>
                </div>
                <div class="statistic">
                    <div class="value">
                        <i class="flag icon"></i> {{ $stats['reports'] }}
                    </div>
                    <div class="label">
                        {{ __('dashboard.admin.stats.reports') }}
                    </div>
                </div>
            </div>

            <br>

            <a href="{{ url('/admin/horizon') }}" class="ui purple labeled icon button">
                <i class="tasks icon"></i>
                {{ __('dashboard.admin.buttons.horizon') }}
            </a>

            <table class="ui celled striped table">
                <thead>
                    <tr>
                        <th colspan="2">
                            {{ __('dashboard.admin.table.title') }}
                        </th>
                        <th>
                            {{ __('dashboard.admin.table.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $reportgroup)
                        <tr>
                            <td>
                                <div class="ui list">
                                    <div class="item">
                                        @if ($reportgroup[0]->group->files->count() == 1)
                                            <i class="file icon"></i>
                                        @else
                                            <i class="folder icon"></i>
                                        @endif
                                        <div class="content">
                                            <a href="{{ route('showGroup', ['group' => $reportgroup[0]->group]) }}" class="header">
                                                {{ $reportgroup[0]->group->name }}
                                            </a>
                                            <div class="description">{{ trans_choice('group.welcome.synopsis', $reportgroup[0]->group->files->count(), ['date' => $reportgroup[0]->group->expiry_formatted, 'files' => $reportgroup[0]->group->files->count(), 'app' => config('app.name')]) }}</div>

                                            @if ($reportgroup[0]->group->files->count() > 1)
                                                <div class="list">
                                                    @foreach ($reportgroup[0]->group->files as $file)
                                                        <div class="item">
                                                            <i class="file icon"></i>
                                                            <div class="content">
                                                                <a href="{{ route('downloadFile', ['file' => $file]) }}" class="header">
                                                                    {{ $file->name }}
                                                                </a>
                                                                <div class="description">{{ hfs($file->size) }}</div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p>{{ count($reportgroup) }} rapports déposés</p>
                            </td>
                            <td>
                                <a href="#" class="ui blue button">Afficher rapports</a>
                            </td>
                        </tr>
                        {{-- @foreach ($reportgroup as $report)
                                @if ($loop->first)
                                    <td rowspan="{{ $loop->count }}">
                                        {{ $report->group->name }}
                                    </td>
                                @endif
                                <td>
                                    @switch($report->reason['type'])
                                        @case('spam')
                                        <i class="exclamation triangle icon"></i> Spam
                                        @break

                                        @case('identity')
                                        <i class="id card icon"></i> Usurpation d'identité
                                        <a class="ui tag label">{{ $report->reason['who'] }}</a>
                                        @break

                                        @case('shock')
                                        <i class="surprise icon"></i> Contenu choquant
                                        @break

                                        @case('copyright')
                                        <i class="legal icon"></i> DMCA
                                        <a class="ui tag label">{{ $report->reason['who'] }}</a>
                                        <a class="ui tag label">{{ $report->reason['what'] }}</a>
                                        <a class="ui tag label">{{ $report->reason['sign'] }}</a>
                                        @break

                                        @case('confidential')
                                        <i class="user lock icon"></i> Contenu privé / confientiel
                                        @break
                                    @endswitch
                                    @if($report->group->encrypted)
                                        <a class="ui tag label">{{ $report->reason['password'] }}</a>
                                    @endif
                                </td>
                                <td class="right aligned collapsing">
                                    <report-buttons id="{{ $report->id }}"></report-buttons>
                                </td>
                            </tr>
                        @endforeach --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
