@extends('templates.app')

@section('content')
    <div class="ui container first">
        <div class="ui segment">
           <h1 class="ui header">
               {{ __('dashboard.page.header.top', ['user' => Auth::user()->name]) }}
                <div class="sub header">{{ trans_choice('dashboard.page.header.subheader', $groups, ['groups' => count($groups)]) }}</div>
           </h1>

            @if (Auth::user()->admin)
                <a href="{{ route('admin.dashboard') }}" class="ui large orange labeled icon button">
                    <i class="toolbox icon"></i>
                    {{ __('dashboard.admin') }}
                </a>
            @endif

            <table class="ui celled striped table">
                <thead>
                    <tr>
                        <th colspan="2">
                            {{ __('dashboard.page.table.header') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                        <tr>
                            <td>
                                {{--<a href="{{ route('showGroup', ['group' => $group]) }}">
                                    {{ $group->name }}
                                </a>--}}
                                <div class="ui list">
                                    <div class="item">
                                        @if ($group->files->count() == 1)
                                            <i class="file icon"></i>
                                        @else
                                            <i class="folder icon"></i>
                                        @endif
                                        <div class="content">
                                            <a href="{{ route('showGroup', ['group' => $group]) }}" class="header">
                                                {{ $group->name }}
                                            </a>
                                            <div class="description">{{ trans_choice('group.welcome.synopsis', $group->files->count(), ['date' => $group->expiry_formatted, 'files' => $group->files->count(), 'app' => config('app.name')]) }}</div>

                                            @if ($group->files->count() > 1)
                                                <div class="list">
                                                    @foreach ($group->files as $file)
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
                            <td class="collapsing">
                                <a href="{{ route('manageGroup', ['group' => $group]) }}" class="ui blue icon labeled button">
                                    <i class="wrench icon"></i>
                                    {{ __('dashboard.page.table.manage') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">
                            <p>{{ __('dashboard.page.table.footer') }}</p>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
