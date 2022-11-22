@extends('admin.layouts.master')

@section('title','Role Change')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#change',$account->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 offset-1">
                                    @if($account->image == null)
                                    <img src="{{ asset('image/default_user.png') }}" alt="" class="img-thumbnail shadow-sm">
                                    @else
                                    <img src="{{ asset('storage/'.$account->image) }}" alt="John Doe" />
                                    @endif

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-dark text-white w-100"><i class="fa-solid fa-circle-chevron-right mr-1"></i>Change</button>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$account->name) }}" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name..." disabled>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Role</label>
                                        <select name="role" id="role" class="form-control">
                                            <option value="">Choose Role</option>
                                            <option value="user" @if($account->role == 'user') selected @endif>user</option>
                                            <option value="admin" @if($account->role == 'admin') selected @endif>admin</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$account->email) }}" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email..." disabled>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                        <textarea name="address" id="" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror" disabled>{{ old('name',$account->address) }}</textarea>
                                        @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                        <input name="phone" type="number" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone',$account->phone) }}" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone..." disabled>
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control @error('gender') is-invalid @enderror" disabled>
                                            <option value="">Choose Gender</option>
                                            <option value="male" @if($account->gender == "male") selected @endif>Male</option>
                                            <option value="Female" @if($account->gender == "female") selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
