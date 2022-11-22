@extends('admin.layouts.master')

@section('title','Category List')

@section('content')

<div class="main-content">
    <div class="row">
        @if(session('updateSuccess'))
        <div class="col-4 offset-8">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-4 offset-1 align-items-center">
                                @if(Auth::user()->image == null)
                                @if(Auth::user()->gender == 'female')
                                <img src="{{ asset('image/default_female.jpg') }}" alt="" class="img-thumbnail shadow-sm">
                                @else
                                <img src="{{ asset('image/default_user.png') }}" alt="" class="img-thumbnail shadow-sm">
                                @endif
                                @else
                                <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="John Doe" class="img-thumbnail shadow-sm" />
                                @endif
                            </div>
                            <div class="col-md-5 offset-1">
                                <h4 class="my-3 text-muted"><i class="fa-solid fa-id-card-clip"></i> Name - {{ Auth::user()->name }}</h4>
                                <h4 class="my-3 text-muted"><i class="fa-solid fa-envelope"></i> Email - {{ Auth::user()->email }}</h4>
                                <h4 class="my-3 text-muted"><i class="fa-solid fa-location-dot"></i> Address - {{ Auth::user()->address }}</h4>
                                <h4 class="my-3 text-muted"><i class="fa-solid fa-phone"></i> Phone - {{ Auth::user()->phone }}</h4>
                                <h4 class="my-3 text-muted"><i class="fa-solid fa-venus-mars"></i> Gender - {{ Auth::user()->gender }}</h4>
                                <h4 class="my-3 text-muted"><i class="fa-solid fa-calendar-days"></i> Joined at - {{ Auth::user()->created_at->format('j. F. Y') }}</h4>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4 offset-4 text-center">
                                <a href="{{ route('admin#edit') }}">
                                    <button class="btn btn-dark text-white">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit Profile
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
