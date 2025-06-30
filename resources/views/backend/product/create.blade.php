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
                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">


                                <div class="form-group col-6">
                                    <label for="inputText3" class="col-form-label">Name</label>
                                    <input id="inputText3" name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror


                                </div>
                                <div class="form-group col-6">
                                    <label for="inputText3" class="col-form-label">short description</label>
                                    <textarea id="inputText3" name="short_description"
                                        class="form-control @error('short_description') is-invalid @enderror"> </textarea>
                                    @error('short_description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group col-6">
                                    <label for="inputText3" class="col-form-label">description</label>
                                    <textarea id="inputText3" name="description" class="form-control @error('description') is-invalid @enderror"> </textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group col-6">
                                    <label for="inputText3" class="col-form-label">product details</label>
                                    <textarea id="inputText3" name="product_details" class="form-control @error('product_details') is-invalid @enderror"> </textarea>
                                    @error('product_details')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group col-6">
                                    <label for="inputText3" class="col-form-label ">quantity</label>
                                    <input id="inputText3" name="quantity" type="number"
                                        class="form-control @error('quantity') is-invalid @enderror">
                                    @error('quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group col-6">
                                    <label for="inputText3" class="col-form-label ">price</label>
                                    <input id="inputText3" name="price" type="number"
                                        class="form-control @error('price') is-invalid @enderror">
                                    @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group col-6">
                                    <label for="inputText3" class="col-form-label ">discount (%)</label>
                                    <input id="inputText3" name="discount" type="number"
                                        class="form-control @error('discount') is-invalid @enderror">
                                    @error('discount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group col-6">
                                    <label for="inputText3" class="col-form-label">delivery policy</label>
                                    <input id="inputText3" name="delivery_policy" type="text"
                                        class="form-control @error('delivery_policy') is-invalid @enderror">
                                    @error('delivery_policy')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror


                                </div>
                                <div class="form-group col-6">
                                    <label for="inputText3" class="col-form-label">return policy</label>
                                    <input id="inputText3" name="return_policy" type="text"
                                        class="form-control @error('return_policy') is-invalid @enderror">
                                    @error('return_policy')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror


                                </div>
                                <div class="form-group col-6">
                                    <label for="inputText3" class="col-form-label ">image</label>
                                    <input id="inputText3" name="image[]" type="file" multiple class="form-control">


                                </div>
                                <div class="form-group col-6">
                                    <label for="inputText3" class="col-form-label ">order</label>
                                    <input id="inputText3" name="order" type="number"
                                        class="form-control @error('order') is-invalid @enderror">
                                    @error('order')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="form-group col-6">
                                    <label for="category" class="col-form-label">category</label>
                                    <select name="category_id" id="category" class="form-control">
                                        <option value="">select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                        @endforeach


                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label for="subcategory" class="col-form-label">sub category</label>
                                    <select name="sub_category_id" id="sub_category" class="form-control">
                                        <option value="">select sub category</option>

                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="inputText3" class="col-form-label">status</label>
                                    <select name="status" id="inputText3" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group text-right col-12">
                                    <button type="submit" class="btn btn-primary text-right">Submit</button>
                                </div>
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

@push('body-scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function() {
            $("#category").on("change", function() {

                var category_id = ($("#category").val());

                $.ajax({
                    data: {
                        category_id: category_id
                    },
                    url: "{{ route('get-subcategory') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                    $.each(data.subcategories, function(index,val) {

                      html += "<option value='" + val.id + "'>" + val.name + "</option>";
                    });

                    $('#sub_category').html(html);


                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });

            });
        });
    </script>
@endpush
