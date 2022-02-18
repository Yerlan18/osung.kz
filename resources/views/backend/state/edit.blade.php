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
                            <form action="{{ url('ship/state/update/'.$state->id) }}" method="POST">
                                @csrf


                                <div class="form-group">
                                    <h5>Division <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="division_id" id="select" required="" class="form-control" aria-invalid="false">
                                            <option value="" active="">Division</option>
                                            @foreach($divisions as $division)
                                            <option value="{{ $division->id }}" {{ ($division->id == $state->division_id) ? 'selected' : '' }}>{{ $division->division_area }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>




                                <div class="form-group">
                                    <h5>District <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="district_id" id="select" required="" class="form-control" aria-invalid="false">
                                            <option value="" active="">District</option>
                                            @foreach($districts as $district)
                                            <option value="{{ $district->id }}" {{ ($district->id == $state->district_id) ? 'selected' : '' }}>{{ $district->district_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <h5>State name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="state_name" class="form-control" value="{{ $state->state_name }}">
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