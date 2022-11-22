@extends('admin.layouts.master')

@section('title','Category List')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('category#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>

                @if(session('createSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i> {{ session('createSuccess') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                </div>
                @endif

                @if(session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-trash"></i> {{ session('deleteSuccess') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-2 bg-white py-2 rounded shadow-sm text-center">
                        <h3><i class="fa-solid fa-database"></i> {{ $categories->total() }}</h3>
                    </div>
                    <div class="col-3 d-flex align-items-center text-center">
                        @if(request('key') != null)
                        <h4 class="text-secondary">Search key : <span class="text-danger">{{ request('key') }}</span></h4>
                        @endif
                    </div>
                    <div class="col-3 offset-4">
                        <form action="{{ route('category#list') }}" method="get">
                            {{-- @csrf --}}
                            <div class="input-group">
                                <input type="text" name='key' class="form-control" placeholder="Search Here..." value="{{ request('key') }}">
                                <button type="submit" class="text-white btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                @if(count($categories) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr class="tr-shadow">
                                <td>001</td>
                                <td class="desc">Samsung S8 Black</td>
                                <td>2018-09-27 02:12</td>
                                <td>CRUD</td>
                            </tr>
                            <tr class="spacer"></tr> --}}
                            @foreach ($categories as $category )
                            <tr class="tr-shadow">
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at->diffForHumans()}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fa-solid fa-eye"></i>
                                        </button> --}}

                                        <a href="{{ route('category#edit',$category->id) }}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        </a>

                                        <a href="{{ route('category#delete',$category->id )}}">
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
                        {{-- {{ $categories->links() }} --}}
                        {{ $categories->appends(request()->query())->links() }} {{-- with search key --}}
                    </div>
                </div>
                @else
                <h3 class="text-center text-secondary mt-5">There is no data Here.</h3>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
