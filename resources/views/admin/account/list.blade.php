@extends('admin.layouts.master')

@section('title','Account List')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Account List</h2>

                        </div>
                    </div>
                </div>

                @if(session('deleteSuccess'))
                <div class="col-5 offset-7">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-trash me-2"></i> {{ session('deleteSuccess') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-2 bg-white py-2 rounded shadow-sm text-center">
                        <h3><i class="fa-solid fa-database"></i> Total - {{ $admins->total()}}</h3>
                    </div>
                    <div class="col-3 d-flex align-items-center text-center">
                        @if(request('key') != null)
                        <h4 class="text-secondary">Search key : <span class="text-danger">{{ request('key') }}</span></h4>
                        @endif
                    </div>
                    <div class="col-3 offset-4">
                        <form action="{{ route('admin#list') }}" method="get">
                            {{-- @csrf --}}
                            <div class="input-group">
                                <input type="text" name='key' class="form-control" placeholder="Search Here..." value="{{ request('key') }}">
                                <button type="submit" class="text-white btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2 mt-3">
                    @if (count($admins)!= 0)
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Address</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin )
                            <tr class="tr-shadow">
                                <input type="hidden" name="adminId" id="adminId" value="{{ $admin->id }}">
                                <td class="col-2">
                                    @if($admin->image == null)
                                        @if($admin->gender == 'female')
                                        <img src="{{ asset('image/default_female.jpg') }}" alt="" class="img-thumbnail shadow-sm">
                                        @else
                                        <img src="{{ asset('image/default_user.png') }}" alt="" class="img-thumbnail shadow-sm">
                                        @endif
                                    @else
                                    <img src="{{ asset('storage/'.$admin->image) }}" alt="John Doe" class="img-thumbnail shadow-sm" />
                                    @endif
                                </td>
                                <td class="col-2">{{ $admin->name }}</td>
                                <td class="col-3">{{ $admin->email }}</td>
                                <td class="col-3">{{ $admin->phone }}</td>
                                <td class="col-3">{{ $admin->address }}</td>
                                <td class="col-3">
                                    @if(Auth::user()->id == $admin->id)
                                        <small class="text-danger">!NOTALLOWED</small>
                                    @else
                                    <select name="status" class="form-control roleStatus">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                    @endif
                                </td>
                                <td class="col-1">
                                    <div class="table-data-feature">
                                        @if(Auth::user()->id == $admin->id)
                                        @else
                                        {{-- <a href="{{ route('admin#changeRole',$admin->id) }}">
                                            <button class="item mr-1" data-toggle="tooltip" data-placement="top" title="Change Role">
                                                <i class="fa-solid fa-person-circle-minus"></i>
                                            </button>
                                        </a> --}}
                                        <a href="{{ route('admin#delete',$admin->id)}}">
                                            <button class="item mr-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $admins->links() }}
                    </div>
                    @else
                    <h3 class="text-center text-secondary mt-5">There is no data Here.</h3>
                    @endif
                </div>

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptSource')
<script src="{{ asset('js/changeRole.js') }}"></script>
@endsection
