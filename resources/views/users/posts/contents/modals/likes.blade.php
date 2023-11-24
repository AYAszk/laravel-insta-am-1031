<div class="modal fade" id="delete-post-{{ $post->id }}">
  <div class="modal-dialog">
     <div class="modal-content border-danger">
         <div class="modal-header border-danger">
            <h3 class="h5 modal-title text-danger">
              <i class="fa-regular fa-heart"></i> Likes
            </h3>
         </div>

         <div class="modal-body">
        @if ($post->likes->count() > 0)
          <ul class="list-group">
           @forelse ($post->likes as $like)
                <tr>
                    <td>
                        @if ($like->user->avatar)
                            <img src="{{ $like->user->avatar }}" alt="{{ $like->user->name }}" class="rounded-circle d-block mx-auto avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user d-block text-center icon-md"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('profile.show', $like->user->id) }}" class="text-decoration-none text-dark fw-bold">
                            {{ $like->user->name }}
                        </a>
                    </td>
                    <td>{{ $like->user->email }}</td>
                </tr>
           @empty
           @endforelse
         </div>

         <div class="modal-footer border-0">
             <form action="#" method="post">
                  @csrf

                  <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
             </form>
         </div>
        @endif
      </div>
  </div>
</div>

         