@extends('layouts.dashboard', [
'class' => '',
'elementActive' => 'home'
])

<!-- Content Header (Page header) -->
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div  class="dropdown float-right">
            <a href="{{route('cart.list')}}" class="btn btn-info">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span
                    class="badge badge-pill badge-danger">{{ $cartItems}}</span>
            </a>
           
        </div>

        <div class="row" style="clear:both;">
            @foreach ($products as $product)
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="card">
                        <div class="card-header p-0">
                        <?php if($product->image==null){?>
                            <img src="{{ asset('uploads/blank.png') }}" height="300px" width="100%" />
                        <?php }else{ ?>
                            <img src="{{ asset('uploads/' . $product->image) }}" alt="" width="100%" height="300px">
                        <?php } ?>
                        </div>    
                        <div class="card-body p-10">
                                <h4>{{ $product->title }}</h3>
                                <p><strong>Price: </strong> {{ $product->price }}$</p>
                                <p>{{ $product->details }}</p>

                                <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="pid">
                                    <input type="number" value="1" min="1" max="{{$product->quantity}}" name="quantity">
                                    <button class="btn btn-success">Add To Cart</button>
                                </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- /.content -->

@endsection
@section('script')
    <script>
        $(function() {
            // $('#example2').DataTable({
            //     "paging": true,
            //     "lengthChange": false,
            //     "searching": true,
            //     "ordering": true,
            //     "info": true,
            //     "autoWidth": false,
            //     "responsive": true,
            // });
        });
    </script>
@endsection
