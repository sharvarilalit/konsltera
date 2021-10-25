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
                    <h1>Cart</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12 main-section">


                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                {{-- <?php print_r($cartItems); ?> --}}


            </div>

            @if (isset($cartItems) && count($cartItems) > 0)
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width:50%">Product</th>
                            <th style="width:10%">Unit Price</th>
                            <th style="width:8%">Quantity</th>
                            <th style="width:22%" class="text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp

                        @foreach ($cartItems as $details)
                            @php $total += $details['products']['price'] * $details['quantity'] @endphp
                            <tr data-id="{{ $details['id'] }}">
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-3 hidden-xs">
                                            <?php if($details['products']['image']==null){?>
                                            <img src="{{ asset('uploads/blank.png') }}" height="100px" width="100%" />
                                            <?php }else{ ?>
                                            <img src="{{ asset('uploads/' . $details['products']['image']) }}" alt=""
                                                width="100%" height="100px">
                                            <?php } ?>
                                            <div class="col-sm-9">
                                                <h4 class="nomargin">{{ $details['products']['title'] }}</h4>
                                            </div>
                                        </div>
                                </td>
                                <td data-th="Price">${{ $details['products']['price'] }}</td>
                                <td data-th="Quantity">
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $details['id'] }}">
                                        <input type="hidden" name="prevcartquantity" value="{{ $details['quantity'] }}">
                                        <input type="hidden" name="productId" value="{{ $details['productId'] }}">

                                        <input type="number" value="{{ $details['quantity'] }}"
                                            class="form-control quantity update-cart" min="0" name="quantity"
                                            max="{{ $details['products']['quantity'] + $details['quantity'] }}" />
                                        <button type="submit" class="btn btn-sm btn-primary">update</button>
                                    </form>
                                </td>
                                <td data-th="Subtotal" class="text-center">
                                    ${{ $details['products']['price'] * $details['quantity'] }}</td>
                                <td class="actions" data-th="">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $details['id'] }}" name="id">
                                        <button class="btn btn-danger btn-sm remove-from-cart">X</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right">
                                <h3><strong>Total ${{ $total }}</strong></h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right">
                                <a href="{{ route('user.products') }}" class="btn btn-warning"><i
                                        class="fa fa-angle-left"></i> Continue Shopping</a>
                                <button class="btn btn-success">Checkout</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            @else
                <h4>Oops cart is empty !!</h4>
            @endif
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(function() {
            $('#adds').on('click', add);
            $('#subs').on('click', remove);

        });


        function add() {
            var input = $('#noOfRoom'),
                value = input.val();

            input.val(++value);

            if (value > 0) {
                $('#subs').removeAttr('disabled');
            }
        }


        function remove() {
            var input = $('#noOfRoom'),
                value = input.val();

            if (value > 0) {
                input.val(--value);
            } else {
                $('#subs').attr('disabled', 'disabled');
            }
        }
    </script>
@endsection
