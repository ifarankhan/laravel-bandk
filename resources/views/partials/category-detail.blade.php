<h1>{{ $category->title }}</h1>

@if(count($contents) > 0)
    @foreach($contents as $content)
        <div class="section">
            <h2>{{ $content->title  }}</h2>
            <p>
                {{ $content->description }}
            </p>
        </div>
    @endforeach
@endif