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
                            <form action="{{ url('ship/district/update/'.$diss->id) }}" method="POST">
                                @csrf



                                <div class="form-group">
                                    <h5>Division <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="division_id" id="select" required="" class="form-control" aria-invalid="false">
                                            <option value="" active="">Select Your City</option>
                                            @foreach($divs as $division)
                                            <option value="{{ $division->id }}" selected="{{ $division->id == $diss->division_id }}">{{ $division->division_area }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>




                                <div class="form-group">
                                    <h5>District name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="district_name" class="form-control" value="{{ $diss->district_name }}">
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