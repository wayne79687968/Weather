<x-admin.admin-master>

@section('content')
    <div class="row">
        <div class="col-sm-3">
            @if (session('role-noupdate'))
                <div class="alert alert-danger">
                    {{session('role-noupdate')}}
                </div>
            @endif
            <h1>Edit Role: {{$role->name}}</h1>
            <form method="post" action="{{ route('role.update', $role->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$role->name}}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                </div>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>

            {{-- datatable --}}
        <div class="col-sm-9">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h1 class="m-0 font-weight-bold text-primary">Permissions</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Id</td>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td>Id</td>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td class="text-center" style="width: 2%"><input type="checkbox" onclick="return false;"
                                        @foreach ($role->permissions as $role_permission)
                                            @if ($permission->slug == $role_permission->slug)
                                                checked
                                            @endif
                                        @endforeach
                                        ></td>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->slug}}</td>
                                    <td style="width: 10%">
                                        <form method="post" action="{{ route('role.permission.attach', $role) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="permission" value="{{ $permission->id }}">
                                            <button class="btn btn-primary"
                                            @if ($role->permissions->contains($permission))
                                                disabled
                                            @endif
                                            >Attach</button>
                                        </form>
                                    </td>
                                    <td style="width: 10%">
                                        <form method="post" action="{{ route('role.permission.detach', $role) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="permission" value="{{ $permission->id }}">
                                            <button class="btn btn-danger"
                                            @if (!$role->permissions->contains($permission))
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
            </div>
        </div>
    </div>
@endsection

</x-admin-master>
