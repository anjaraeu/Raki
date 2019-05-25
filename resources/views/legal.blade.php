@extends('app')

@section('content')
<div class="ui container first">
    <div class="ui segment">
        <h2>{{ __('static.legal.title') }}</h2>

        <p>{{ __('static.legal.p1') }}</p>

        <h2>{{ __('static.legal.terms') }}</h2>

        <p>{{ __('static.legal.p2') }}</p>

        <div class="ui bulleted list">
            <div class="item">{{ __('static.legal.forbid.basic') }}</div>
            <div class="item">{{ __('static.legal.forbid.identity') }}</div>
            <div class="item">{{ __('static.legal.forbid.corp') }}</div>
            <div class="item">{{ __('static.legal.forbid.spam') }}</div>
            <div class="item">{{ __('static.legal.forbid.malware') }}</div>
            <div class="item">{{ __('static.legal.forbid.copyright') }}</div>
        </div>

        <p>{{ __('static.legal.p3') }}</p>

        <p>{{ __('static.legal.p4') }}</p>

        <p>{{ __('static.legal.p5') }}</p>

        <code>
            AnjaraFiles is a file sharing system over the Internet.<br>
            Copyright &copy; 2019 Anjara - Files contributors<br>
            <br>
            This program is free software: you can redistribute it and/or modify<br>
            it under the terms of the GNU Affero General Public License as published by<br>
            the Free Software Foundation, either version 3 of the License, or<br>
            (at your option) any later version.<br>
            <br>
            This program is distributed in the hope that it will be useful,<br>
            but WITHOUT ANY WARRANTY; without even the implied warranty of<br>
            MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the<br>
            GNU Affero General Public License for more details.<br>
            <br>
            You should have received a copy of the GNU Affero General Public License<br>
            along with this program.  If not, see <a href="https://www.gnu.org/licenses/">https://www.gnu.org/licenses/</a>.<br>
        </code>
    </div>
</div>
@endsection
