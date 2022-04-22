<x-admin.admin-master>

@section('content')
    <div class="row">
        <div class="col-sm-5">
            @if (session('permission-noupdate'))
                <div class="alert alert-danger">
                    {{session('permission-noupdate')}}
                </div>
            @endif
            <h1>Edit permission: {{$permission->name}}</h1>
            <form method="post" action="{{ route('permission.update', $permission->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$permission->name}}">
                        @error('name')
                            <span class="invalid-feedback" permission="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                </div>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>

{{--         <div class="col-sm-9">
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
                                        @foreach ($permission->permissions as $permission_permission)
                                            @if ($permission->slug == $permission_permission->slug)
                                                checked
                                            @endif
                                        @endforeach
                                        ></td>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->slug}}</td>
                                    <td style="width: 10%">
                                        <form method="post" action="{{ route('permission.permission.attach', $permission) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="permission" value="{{ $permission->id }}">
                                            <button class="btn btn-primary"
                                            @if ($permission->permissions->contains($permission))
                                                disabled
                                            @endif
                                            >Attach</button>
                                        </form>
                                    </td>
                                    <td style="width: 10%">
                                        <form method="post" action="{{ route('permission.permission.detach', $permission) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="permission" value="{{ $permission->id }}">
                                            <button class="btn btn-danger"
                                            @if (!$permission->permissions->contains($permission))
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
        </div> --}}
    </div>
@endsection

</x-admin-master>
