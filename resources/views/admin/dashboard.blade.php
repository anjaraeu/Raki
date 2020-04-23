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
                    <tr>
                        <th>

                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
