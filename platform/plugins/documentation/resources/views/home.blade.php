@extends('plugins/documentation::layouts.app')

@section('content')
    <div class="tab-content" id="tabContent">
        @foreach ($documentation->topics as $topic)
            @foreach ($topic->articles as $article)
                <div 
                    class="tab-pane fade {{ $loop->parent->first && $loop->first ? 'active show' : '' }}" 
                    id="tab-topic-{{ $topic->id }}-article-{{ $article->id }}"
                > 
                    <h1>{{ $article->title }}</h1> 
                    <p>{!! $article->content !!}</p> 

                </div>
            @endforeach
        @endforeach
    </div>
@endsection
