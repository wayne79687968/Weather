<x-admin.admin-master>

@section('content')
    @if (Session('user_update_message'))
        <div class="alert alert-success">{{Session('user_update_message')}}</div>
    @endif
    <h1>User Profile</h1>
    <form method="post" action="{{ route('user.profile.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{$user->email}}">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    {{-- datatable --}}
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">Roles</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <td>Id</td>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Attach</th>
                            <th>Detach</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <td>Id</td>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Attach</th>
                            <th>Detach</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td class="text-center" style="width: 2%"><input type="checkbox" onclick="return false;"
                                @foreach ($user->roles as $user_role)
                                    @if ($role->slug == $user_role->slug)
                                        checked
                                    @endif
                                @endforeach
                                ></td>

                            <td style="width: 3%">{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->slug}}</td>
                            <td style="width: 10%">
                                <form method="post" action="{{ route('user.role.attach', $user) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="role" value="{{ $role->id }}">
                                    <button class="btn btn-primary"
                                    @if ($user->roles->contains($role))
                                        disabled
                                    @endif
                                    >Attach</button>
                                </form>
                            </td>
                            <td style="width: 10%">
                                <form method="post" action="{{ route('user.role.detach', $user) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="role" value="{{ $role->id }}">
                                    <button class="btn btn-danger"
                                    @if (!$user->roles->contains($role))
                                        disabled
                                    @endif
                                    >Detach</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- {{$users->links()}} --}}
    </div>
@endsection

</x-admin.admin-master>
