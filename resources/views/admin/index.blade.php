<x-admin.admin-master>

@section('content')

    @if (auth()->user()->isRole('Admin'))
    <h1 class="h3 mb-4 text-gray-800">DashBoard</h1>
    @endif

@endsection

</x-admin.admin-master>
