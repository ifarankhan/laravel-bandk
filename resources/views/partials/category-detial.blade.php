<div class="col-md-10 col-sm-12 detail column">
    <h1>{{ $category->title }}</h1>
    <div class="section">
        <h2>{{ getTranslation('description') }}</h2>
        <p>
            {!! $category->description  !!}
        </p>
    </div>

    @if($category->childrenCount > 0)
        <div class="section">
            <h2>{{ getTranslation('sub_categories') }}</h2>
            @foreach($category->children as $child)
                <a class="btn btn-danger btn-xs" href="{{ route("home.category", ["slug" => str_slug($child->title).'-'.$child->id]) }}">{{ $child->title }}</a>
            @endforeach
        </div>
    @endif
</div>