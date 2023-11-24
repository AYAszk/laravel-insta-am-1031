<div class="modal fade" id="display-likes-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title">
                <i class="fa-solid fa-heart text-danger"></i> Likes
                </h3>
            </div>
            <div class="modal-body">
                @foreach ($post->likes as $like)
                    {{-- Iterating over each 'like' related to the post --}}
                    <div class="row align-items-center mb-3">
                        <div class="col-auto">
                            {{-- Link to theprofile of the user who liked the post --}}
                            <a href="{{ route('profile.show', $like->Likes->id) }}">
                                {{-- Checking if the user has an avatar --}}
                                @if ($like->Likes->avatar)
                                    {{-- Displaying the user's avatar --}}
                                    <img src="{{ $like->Likes->avatar }}" alt="{{ $like->Likes->name }}" class="rounded-circle avatar-md">
                                @else
                                    {{-- If no avatar, displaying a default icon --}}
                                    <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col ps-0 text-truncate">
                            {{-- Link to the profile and displaying the user's name --}}
                            <a href="{{ route('profile.show', $like->Likes->id) }}" class="text-decoration-none text-dark fw-bold">
                                {{ $like->Likes->name }}
                            </a>
                            {{-- Displaying the user's email --}}
                            <p>{{ $like->Likes->email }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
                        Close
                </button>
            </div>
        </div>
    </div>
</div>
         