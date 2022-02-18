@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Coupon</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form action="{{ url('coupons/update/item/'.$coup->id) }}" method="POST">
                                @csrf



                                <div class="form-group">
                                    <h5>Coupon name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="coupon_name" class="form-control" value="{{ $coup->coupon_name }}">

                                    </div>
                                </div>




                                <div class="form-group">
                                    <h5>Coupon Discount <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="coupon_discount" class="form-control" value="{{ $coup->coupon_discount }}">

                                    </div>
                                </div>




                                <div class="form-group">
                                    <h5>Coupon Validity <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="coupon_validity" class="form-control" value="{{ $coup->coupon_validity }}" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">

                                    </div>
                                </div>


                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update" />
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