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
                        fichiers
                    </div>
                </div>
                <div class="statistic">
                    <div class="value">
                        <i class="folder icon"></i> {{ $stats['groups'] }}
                    </div>
                    <div class="label">
                        groupes
                    </div>
                </div>
                <div class="statistic">
                    <div class="value">
                        <i class="user icon"></i> {{ $stats['users'] }}
                    </div>
                    <div class="label">
                        utilisateurs
                    </div>
                </div>
                <div class="statistic">
                    <div class="value">
                        <i class="flag icon"></i> {{ $stats['reports'] }}
                    </div>
                    <div class="label">
                        rapports non traités
                    </div>
                </div>
            </div>
            <table class="ui celled striped table">
                <thead>
                    <tr>
                        <th colspan="2">
                            Rapports non traités
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $reportgroup)
                        @foreach($reportgroup as $report)
                            <tr>
                                @if($loop->first)
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
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
