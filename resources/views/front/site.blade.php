@extends('front._layouts.default')

@section('content')


<div class="page">

    <div id="catalog">
        @foreach ($categories as $category)
        <section data-catalog="download" class="active">
            <header>
                <h4 class="cat_title"><a href="#" target="_blank">{{$category->name}}<br><span style="font-size:12px">更多</span></a></h4>
            </header>
            <ul class="website-list">

                @foreach ($category->sites()->take(12)->get() as $site)
                <li class="hot-item"> <a href="{{$site->url}}" class="website" target="_blank">{{$site->name}}</a>
                    <p class="description">{{$site->intro}}</p>
                </li>
                @endforeach
            </ul>
             </section>
        @endforeach



    </div>




</div>


@stop