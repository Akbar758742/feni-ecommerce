@extends('backend.master')
@section('mainContent')
    <div class="container-fluid dashboard-content ">
        <!-- basic form  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="section-block" id="basicform">
                    <h3 class="section-title">Basic Form Elements</h3>
                    <p>Use custom button styles for actions in forms, dialogs, and more with support for multiple sizes,
                        states, and more.</p>
                </div>
                  @if (Session::has('success'))
                        {{ Session::get('success') }}
                    @elseif(Session::has('danger'))
                        {{ Session::get('danger') }} <!-- here to 'withWarning()' -->
                    @endif
                <div class="card">

                    <h5 class="card-header">add new</h5>
                    <div class="card-body">
                        <form action="{{ route('category.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="inputText3" class="col-form-label">Name</label>
                                <input id="inputText3" name="name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputText3" class="col-form-label">order</label>
                                <input id="inputText3" name="order" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputText3" class="col-form-label">status</label>
                                <select name="status" id="inputText3" class="form-control">
                                    <option>select status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary text-right">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end basic form  -->
    </div>
@endsection
