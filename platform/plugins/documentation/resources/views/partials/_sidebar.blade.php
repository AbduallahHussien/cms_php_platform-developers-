<div id="sidebar">
    <div class="sidebar-header">
        <h5>{{ $documentation->name }}</h5>
    </div>
    <div class="sidebar-menu">
        <ul class="nav nav-bills flex-column">
            @foreach ($documentation->topics as $topic)

            <div class="menu-title">{{ $topic->name }}</div>


            @foreach ($topic->articles as $article)
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $loop->parent->first && $loop->first ? 'active' : '' }}" 
                    id="tab-{{ $topic->id }}-article-{{ $article->id }}-tab" 
                    data-bs-toggle="tab"
                    data-bs-target="#tab-topic-{{ $topic->id }}-article-{{ $article->id }}" 
                    type="button">
                    {{ $article->title }}
                </a>
            </li>
            @endforeach

            @endforeach
        </ul>
    </div>
</div>
