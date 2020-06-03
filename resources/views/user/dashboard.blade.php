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
                    {{ __('dashboard.admin._') }}
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
                                <x-group-list :group="$group"></x-group-list>
                            </td>
                            <td class="collapsing">
                                <a href="{{ route('group.manage', ['group' => $group]) }}" class="ui blue icon labeled button">
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
