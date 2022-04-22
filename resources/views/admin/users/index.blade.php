<x-admin.admin-master>

@section('content')
    @if (Session('user_delete_message'))
        <div class="alert alert-danger">{{Session('user_delete_message')}}</div>
    @elseif(Session('user_create_message'))
        <div class="alert alert-success">{{Session('user_create_message')}}</div>
    @elseif(Session('user_update_message'))
        <div class="alert alert-success">{{Session('user_update_message')}}</div>
    @endif

    {{-- datatable --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">All Users</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>Registered Date</th>
                            <th>Updated Profile Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>Registered Date</th>
                            <th>Updated Profile Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            {{-- <td>{{$users->firstItem() + $key}}</td> --}}
                            <td>{{$user->id}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at->diffForHumans()}}</td>
                            <td>{{$user->updated_at->diffForHumans()}}</td>
                            <td>
                                <form method="get" action="{{ route('user.profile.show', $user->id) }}" enctype="miltipart/form-data">
                                    @csrf
                                    <button class="btn btn-success">Edit</button>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="{{ route('user.delete', $user->id) }}" enctype="miltipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
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

@section('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection

</x-admin.admin-master>
