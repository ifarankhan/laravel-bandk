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
            </ul>
        </div>
    </div>
    <div class="col-md-10 col-sm-12 detail column" id="content-details">

    </div>
@endsection
