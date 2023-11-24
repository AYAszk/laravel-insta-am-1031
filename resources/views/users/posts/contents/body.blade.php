{{-- Clickable Image 11.8 --}}
<div class="container p-0">
   <a href="{{ route('post.show', $post->id) }}">
     <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="w-100">
   </a>
</div>

<div class="card-body">
    {{-- Heart button + no. of likes + categories --}}
    <div class="row align-items-center">
        <div class="col-auto">
             @if ($post->isLiked())  {{--return output is TRUE --}}
                <form action="{{ route('like.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-sm p-0">
                        <i class="fa-solid fa-heart text-danger"></i>
                    </button>
                </form>
            @else
                <form action="{{ route('like.store', $post->id) }}" method="post">
                    @csrf

                    <button type="submit" class="btn btn-sm shadow-none p-0">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </form>
            @endif
             {{-- INCLUDE THE MODAL HERE --}}
             @include('users.posts.contents.modals.likes')
            
        </div>

        <div class="col-auto px-0">
            <span>{{ $post->likes->count() }}</span>
        </div>

        <div class="col text-end">
            @forelse ($post->categoryPost as $category_post) {{-- 11.21 it can be true if category will be selected.--}}
                <div class="badge bg-secondary bg-opacity-50">
                    {{ $category_post->category->name }}
                </div>
            @empty   {{-- Is like "else" if condition tends to become false. It will display the uncategorized category. Since category was been deleted. --}}
               <div class="badge bg-dark text-wrap">
                  Uncategorized
               </div>
            @endforelse
        </div>
    </div>

    {{-- owner + description --}}
    <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark fw-bold">
        {{ $post->user->name }}
    </a>
    &nbsp;
    <p class="d-inline fw-light">{{ $post->description }}</p>
    <p class="text-uppercase text-muted xsmall">
        {{ date('M d, Y', strtotime ($post->created_at)) }}
    </p>

    {{-- Include coments here --}}
    @include('users.posts.contents.comments')
</div>