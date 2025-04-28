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
                <a class="nav-link" 
                    href="javascript:void(0);" 
                    data-article-id="{{ $article->id }}" 
                    data-topic-id="{{ $topic->id }}">
                    {{ $article->title }}
                </a>
            </li>
            @endforeach
            @endforeach
        </ul>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // When an article link is clicked
        $('.sidebar-menu .nav-link').on('click', function() {
            var articleId = $(this).data('article-id');
            var topicId = $(this).data('topic-id');
            
            // Make the AJAX request
            $.ajax({
                url: '/documentation/article/' + articleId,  // Adjust route accordingly
                method: 'GET',
                data: {
                    topic_id: topicId,
                    article_id: articleId
                },
                success: function(response) {
                    // Update the main content with the article content
                    $('#content').html(response.content);
                },
                error: function(xhr, status, error) {
                    console.error("Error loading article:", error);
                    $('#content').html('<p>Error loading article. Please try again.</p>');
                }
            });
        });
    });
</script>

@endpush