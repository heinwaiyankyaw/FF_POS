@extends('admin.layouts.master')

@section('title','Users List')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Users List</h2>
                        </div>
                    </div>
                </div>



        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2 text-center">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="dataList">
                    @foreach ($users as $user)
                    <tr class="align-items-center">
                        <input type="hidden" name="userId" id="userId" value="{{ $user->id }}">
                        <td class="col-2">
                            @if($user->image == null)
                                @if($user->gender =="female")
                                <img src="{{ asset('image/default_female.jpg') }}" alt="Female" class="img-thumbnail shadow-sm" style="width:50px; height:50px;">
                                @else
                                <img src="{{ asset('image/default_user.png') }}" alt="Male" class="img-thumbnail shadow-sm" style="width:50px; height:50px;">
                                @endif
                            @else
                            <img src="{{ asset('storage/'.$user->image) }}" alt="userImg" class="img-thumbnail shadow-sm" style="width:50px; height:50px;">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <select class="form-control statusChange">
                                <option value="admin" @if($user->role == "admin") selected @endif>Admin</option>
                                <option value="user" @if($user->role == "user") selected @endif>User</option>
                            </select>
                        </td>
                        <td>
                            <div class="table-data-feature">
                                <a href="{{ route('admin#updateUserPage',$user->id) }}">
                                <button class="item mr-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                </a>

                                <a href="{{ route('admin#deleteUser',$user->id) }}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button></a>
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                {{ $users->links() }}
            </div>
    </div>
</div>
</div>
</div>
</div>
@endsection
@section('scriptSource')
    <script src="{{ asset('js/userList.js') }}"></script>
@endsection
