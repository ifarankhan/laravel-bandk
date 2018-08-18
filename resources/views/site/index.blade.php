@extends('layouts.app-front')

@section('content')
    <div class="col-md-2 column">
        <div class="sideNav" style="width: 100%;height: 100%;">
            <button>
                <span></span>
            </button>
            <ul>
                <?php
                $html = '';
                ?>
                {!! getLeftMenu($categories, $html) !!}
                {{--@if(count($categories) > 0)
                    @foreach($categories as $category)
                        <li class="home"><a href="javascript:;">{{ $category->title }}</a>
                            @if($category->childrenCount > 0)
                                <ul class="nav child_menu">
                                    @foreach($category->children as $child)
                                        <li class="current-page"><a href="#">{{ $child->title }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endif--}}
                {{-- <li class="home"><a href="javascript:;">Home</a>
                     <ul class="nav child_menu">
                         <li class="current-page"><a href="#">Dashboard</a></li>
                         <li><a href="index2.html">Dashboard2</a></li>
                         <li><a href="index3.html">Dashboard3</a></li>
                     </ul>
                 </li>


                 <li class="newIndividual"><a href="javascript:;">New Appliction</a>
                     <ul class="nav child_menu">
                         <li class="current-page"><a href="#">Dashboard</a></li>
                         <li><a href="index2.html">Dashboard2</a></li>
                         <li><a href="index3.html">Dashboard3</a></li>
                     </ul>
                 </li>
                 <li class="howToGuide"><a href="javascript:;">How-to guides</a>
                     <ul class="nav child_menu">
                         <li class="current-page"><a href="#">Dashboard</a></li>
                         <li><a href="index2.html">Dashboard2</a></li>
                         <li><a href="index3.html">Dashboard3</a></li>
                     </ul>
                 </li>--}}
            </ul>
        </div>
    </div>
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
@endsection
