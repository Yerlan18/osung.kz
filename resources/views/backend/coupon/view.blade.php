@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Coupon List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Coupon name</th>
                                        <th>Coupon discount</th>
                                        <th>Validity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coupons as $item)
                                    <tr>
                                        <td>{{ $item->coupon_name }}</td>
                                        <td>{{ $item->coupon_discount }}</td>
                                        <td>{{ $item->coupon_validity }}</td>
                                        <td>
                                            @if($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                            <a href="{{ url('coupons/inactive/rate/'.$item->id) }}" class="btn btn-success"><i class="fa fa-arrow-up" title="Product Inactivate Data"></i></a>
                                            @else
                                            <a href="{{ url('coupons/active/rate/'.$item->id) }}" class="btn btn-danger"><i class="fa fa-arrow-down" title="Product Activate Data"></i></a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('coupons/item/edit/'.$item->id) }}" class="btn btn-info"><i class="fa fa-pencil" title="Edit Data"></i></a>
                                            <a href="{{ url('coupons/item/delete/'.$item->id) }}" class="btn btn-danger" id="delete" onclick="return confirm('Are you sure?')" title="Delete Data"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>

            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Coupon</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form action="{{ route('coupon.store') }}" method="POST">
                                @csrf



                                <div class="form-group">
                                    <h5>Coupon name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="coupon_name" class="form-control">

                                    </div>
                                </div>




                                <div class="form-group">
                                    <h5>Coupon discount % <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="coupon_discount" class="form-control">

                                    </div>
                                </div>




                                <div class="form-group">
                                    <h5>Coupon validity <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="coupon_validity" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                    </div>
                                </div>


                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Coupon" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

@endsection