@extends('templates.app')

@section('content')
    <div class="ui container first">
        <div class="ui segment">
            <h1 class="ui header">
                Rapports non traités pour "{{ $group->name }}"
            </h1>
            <div class="ui relaxed divided list">
                @foreach ($group->reports as $report)
                    @if ($report->processed)
                        @break
                    @endif
                    <div class="item">
                        @switch($report->reason['type'])
                            @case('spam')
                            <i class="large exclamation triangle middle aligned icon"></i>
                            <div class="content">
                                <div class="header">Spam</div>
                            </div>
                            @break

                            @case('identity')
                            <i class="large id card middle aligned icon"></i>
                            <div class="content">
                                <div class="header">Usurpation d'identité</div>
                                <div class="description">{{ $report->reason['who'] }}</div>
                            </div>
                            @break

                            @case('shock')
                            <i class="large surprise middle aligned icon"></i>
                            <div class="content">
                                <div class="header">Contenu choquant</div>
                            </div>
                            @break

                            @case('copyright')
                            <i class="large legal middle aligned icon"></i>
                            <div class="content">
                                <div class="header">DMCA</div>
                                <div class="description">{{ $report->reason['who'] }}, {{ $report->reason['what'] }}, {{ $report->reason['sign'] }}</div>
                            </div>
                            @break

                            @case('confidential')
                            <i class="large user lock middle aligned icon"></i>
                            <div class="content">
                                <div class="header">Contenu privé / confidentiel</div>
                            </div>
                            @break
                        @endswitch
                        @if($report->group->encrypted)
                            <a class="ui tag label">{{ $report->reason['password'] }}</a>
                        @endif
                    </div>
                @endforeach
            </div>
            <report-buttons slug="{{ $group->slug }}"></report-buttons>
            <x-file-table type="admin" :group="$group"></x-file-table>
        </div>
    </div>
@endsection
