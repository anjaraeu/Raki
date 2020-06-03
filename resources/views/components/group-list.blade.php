<div class="ui list">
    <div class="item">
        @if ($group->files->count() == 1)
            <i class="file icon"></i>
        @else
            <i class="folder icon"></i>
        @endif
        <div class="content">
            <a href="{{ route('group.show', ['group' => $group]) }}" class="header">
                {{ $group->name }}
            </a>
            <div class="description">{{ trans_choice('group.welcome.synopsis', $group->files->count(), ['date' => $group->expiry_formatted, 'files' => $group->files->count(), 'app' => config('app.name')]) }}</div>

            @if ($group->files->count() > 1)
                <div class="list">
                    @foreach ($group->files as $file)
                        <div class="item">
                            <i class="file icon"></i>
                            <div class="content">
                                <a href="{{ route('file.download', ['file' => $file]) }}" class="header">
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
