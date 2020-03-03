<div class="mb-3 ml-3">
    <div class="d-block mb-3 text-secondary h4">{{ $post->content }}</div>
    <small class="text-secondary">
        @foreach($post->categories as $category)
            <div class="d-inline">
                <form action="{{ route('home') }}" method="GET" class="d-inline">
                    <button type="submit" class="btn btn-sm btn-labeled btn-info" value="{{ $category->id }}" name="selectCategories[]">
                        <span class="btn-label text-white"><i class="fas fa-hashtag"></i></span>
                        <span class="text-white">
                            {{ $category->name }}
                        </span>
                    </button>
                </form>
            </div>
        @endforeach
    </small>
    <small class="text-info d-block mt-2">Post created {{ $post->created_at->diffForHumans() }} </small>
</div>