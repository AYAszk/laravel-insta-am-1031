@extends('layouts.app')  {{--11.16 --}}

@section('title','Admin: Users')

@section('content')

@auth 
    <ul class="navbar-nav float-end">
        <form action="{{ route('admin.users') }}" method="get" style="width: 300px">
            <input type="search" name="search" id="search" class="form-control form-control-sm mb-2" placeholder="Search for names..." value="{{ $search }}"  >
        </form>
    </ul>
@endauth
    <table class="table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-success text-secondary">
            <tr>
                <th></th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>CREATED AT</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($all_users as $user)
                <tr>
                    <td>
                        @if ($user->avatar)
                           <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle d-block mx-auto avatar-md">
                        @else
                           <i class="fa-solid fa-circle-user d-block text-center icon-md"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        @if ($user->trashed())
                            <i class="fa-regular fa-circle text-secondary"></i>&nbsp; Inactive
                        @else
                            <i class="fa-solid fa-circle text-success"></i>&nbsp; Active
                        @endif
                    </td>
                    <td>
                        @if (Auth::user()->id !== $user->id)
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if ($user->trashed())
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-user-{{ $user->id }}">
                                           <i class="fa-solid fa-user-check"></i> Activate {{ $user->name }}
                                        </button>
                                    @else
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{ $user->id }}">
                                           <i class="fa-solid fa-user-slash"></i> Deactivate {{ $user->name }}
                                        </button>
                                   @endif
                                </div>
                            </div>
                            {{-- Include the modal here --}}
                            @include('admin.users.modal.status') {{-- 🐳activateするかどうかの選択肢が出るようにする。 --}}
                        @endif
                    </td>
                </tr>
            @empty
                    <tr>
                        <td colspan="6">
                            <p class="lead text-muted text-center">
                                No results found.
                            </p>
                        </td>
                    </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $all_users->links() }}
    </div>
@endsection