
<h1>{{ $category->title }}</h1>

@if(count($content) > 0)
    <div class="section category-front">
        <h2>{{ $content->title  }}</h2>
        <p>
            {!!$content->description  !!}
        </p>
    </div>
@endif