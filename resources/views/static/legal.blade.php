@extends('templates.app')

@section('content')
<div class="ui container first">
    <div class="ui segment">
        {!! $md !!}

        <code>
            Raki is a file sharing system over the Internet.<br>
            Copyright &copy; 2019-2020 Anjara - Files contributors<br>
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
