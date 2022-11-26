@extends('admin.layouts.master')

@section('title','User Update')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card mx-auto">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between">
                            <a href="{{ route('admin#userList') }}" class="text-decoration-none"><i class="fa-solid fa-arrow-left-long text-dark"></i></a>
                            <h3 class="text-center title-2">{{ $user->name }} Profile</h3>
                            <div class=""></div>
                        </div>
                        <hr>
                        <form action="{{ route('admin#updateUser',$user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 offset-1">
                                    @if($user->image == null)
                                        @if($user->gender == "male")
                                        <img src="{{ asset('image/default_user.png') }}" alt="" class="img-thumbnail shadow-sm">
                                        @else
                                        <img src="{{ asset('image/default_female.jpg') }}" alt="" class="img-thumbnail shadow-sm">
                                        @endif
                                    @else
                                    <img src="{{ asset('storage/'.$user->image) }}" alt="John Doe" class="img-thumbnail shadow-sm"/>
                                    @endif
                                    <div class="mt-3">
                                        <input type="file" name="image" class="form-control @error('image')
                                        is-invalid
                                        @enderror">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-dark text-white w-100"><i class="fa-solid fa-circle-chevron-right mr-1"></i>Update</button>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$user->name) }}" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name...">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$user->email) }}" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email...">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                        <textarea name="address" id="" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror">{{ old('name',$user->address) }}</textarea>
                                        @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                        <input name="phone" type="number" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone',$user->phone) }}" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone...">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                            <option value="male" @if($user->gender == "male") selected @endif>Male</option>
                                            <option value="female" @if($user->gender == "female") selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Role</label>
                                        <input name="role" type="text" class="form-control" value="{{ old('role',$user->role) }}" aria-required="true" aria-invalid="false" placeholder="Enter Admin Address..." disabled>
                                    </div>
                                    {{-- @error('categoryName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
