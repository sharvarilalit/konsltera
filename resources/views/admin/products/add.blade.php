@extends('layouts.dashboard', [
'class' => '',
'elementActive' => 'home'
])


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> {{ isset($getColorbyId) ? 'Update' : 'Add' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Color</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-body p-20">
                            <div class="bs-stepper">

                                <form id="myform" action='{{ route('admin.product.save') }}' method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name='id'
                                        value="{{ isset($getColorbyId) ? $getColorbyId->id : 0 }}" />
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            <div class="form-group">
                                                <label for="name">{{ __('Name') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="title" class="form-control" id="title"
                                                    placeholder="Name"
                                                    value="{{ isset($getColorbyId) ? $getColorbyId->title : '' }}"
                                                    required="" />
                                                @error('title')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Details') }} <span
                                                        style='color:red'>*</span></label>
                                                <textarea type="text" name="details" class="form-control" id="details"
                                                    placeholder="details"
                                                    value="{{ isset($getColorbyId) ? $getColorbyId->details : '' }}"
                                                    required=""></textarea>
                                                @error('details')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Price') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="number" name="price" class="form-control" id="price"
                                                    placeholder="Name"
                                                    value="{{ isset($getColorbyId) ? $getColorbyId->price : '' }}"
                                                    required="" />
                                                @error('price')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Quantity') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="number" name="quantity" class="form-control" id="quantity"
                                                    placeholder="Name"
                                                    value="{{ isset($getColorbyId) ? $getColorbyId->quantity : '' }}"
                                                    required="" />
                                                @error('quantity')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="status" >{{ __('Status') }}</label>
                    
                                                    <select id="status" class="form-control" name="status" required="">
                                                        <option>Select</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">InActive</option>
                                                    </select>
                                            </div>

                                            <div class="form-group">
                                              <label for="status" >{{ __('Upload Image') }}</label>
                                              <input type="file" name="image" placeholder="Choose image" id="image" class="form-control">                                               @error('image')
                                                    <small style="color:red">{{ $message }}</small>
                                               @enderror
                                            </div>

                                            @if(isset($getColorbyId)&& $getColorbyId->image!=null){
                                                <input type="hidden" name="prevfile" id="prevfile" value="{{$getColorbyId->image}}" />
                                            }
                                            @endif

                                        </div>
                                        <div id="information-part" class="content" role="tabpanel"
                                            aria-labelledby="information-part-trigger">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script type="text/javascript">
        $(function() {

            $('#myform').validate({
                rules: {
                    title: {
                        required: true,
                    },
                    details: {
                        required: true,
                    },
                    price: {
                        required: true,
                    },
                    quantity: {
                        required: true
                    },
                },
                messages: {
                    title: {
                        required: "Please enter a  title",
                    },
                    details: {
                        required: "Please provide a details",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
