@extends('backend.master')
@section('mainContent')
    <div class="container-fluid dashboard-content ">
        <div class="row">
            <!-- pageheader -->
            <!-- ============================================================== -->

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">General Tables</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- end pageheader -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- bordered table -->
            <!-- ============================================================== -->
            <div class="col-12">
                 @if (Session::has('success'))
                 <p class="alert alert-success">  {{ Session::get('success') }}</p>

                        @elseif(Session::has('danger'))
                        <p class="alert alert-danger">{{ Session::get('danger') }}</p>
                             <!-- here to 'withWarning()' -->
                        @endif
                <div class="card table-card">

                    <div class="row">

                        <div class="col-6">
                            <h5 class="card-header">category list</h5>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('sub-category.create') }}" class="btn btn-primary text-white add-new-btn">Add new</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">category</th>
                                    <th scope="col">order</th>
                                    <th scope="col">status</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subCategories as $subCategory)


                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $subCategory->name }}</td>
                                    <td>{{ $subCategory->category->name }}</td>
                                    <td>{{ $subCategory->order }}</td>
                                    <td class="{{ $subCategory->status == 1 ? 'text-success' : 'text-danger' }}">{{ $subCategory->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <a href="{{ route('sub-category.edit', $subCategory->id) }}" class="btn btn-info text-white .table-card">Edit</a>
                                        <a href="{{ route('sub-category.destroy', $subCategory->id) }}" onclick="return confirm('Are you sure you want to delete this sub-category?')" class="btn btn-warning text-white .table-card">Delete</a>
                                    </td>
                                </tr>
                                 @endforeach

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
 {{ $subCategories->links() }}
                        </div>

                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end bordered table -->
            <!-- ============================================================== -->
        </div>
    </div>
@endsection
