<x-admin.admin-master>

@section('content')
    <div class="row">
        @if (session('permission-delete'))
            <div class="alert alert-danger col-sm-12 ml-4">
                {{session('permission-delete')}}
            </div>
        @elseif (session('permission-update'))
            <div class="alert alert-success col-sm-12 ml-4">
                {{session('permission-update')}}
            </div>
        @endif
        <div class="col-sm-3">
            <form method="post" action="{{ route('permission.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="btn btn-primary btn-block mt-4">Create</button>
                </div>
            </form>
        </div>

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
                                    <td>Id</td>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
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
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->slug}}</td>
                                    <td>
                                        <form method="get" action="{{ route('permission.edit', $permission->id) }}" enctype="miltipart/form-data">
                                            @csrf
                                            <button class="btn btn-success">Edit</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('permission.delete', $permission->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
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

</x-admin.admin-master>
