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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h3 class="card-title">DataTable with minimal features & hover style</h3> --}}
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <!-- /.card-header -->


                        {{-- <?php print_r($allcolors); ?> --}}
                        <div class="card-body">
                            <label><a href="{{ route('admin.product.add') }}" class="btn btn-success">Add</a></label>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S.L</th>
                                        <th>Name</th>
                                        <th>Details</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($allcolors as $key=>$item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->details }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>
                                                <?php if($item->image==null){?>
                                                <img src="{{ asset('uploads/blank.png') }}" height="90px" width="90px" />
                                            </td>

                                            <?php }else{ ?>
                                            <img src="{{ asset('uploads/' . $item->image) }}" height="90px" width="90px" />
                                            </td>

                                            <?php } ?>
                                            <td>
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ route('admin.product.deleted', $item->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-shopping-cart"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@section('script')
    <script>
        $(function() {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
