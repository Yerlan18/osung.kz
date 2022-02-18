@extends('admin.admin_master')

@section('admin')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Shipping Area List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Division</th>
                                        <th>District</th>
                                        <th>State</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($states as $item)
                                    <tr>
                                        <td>{{$item->division->division_area}}</td>
                                        <td>{{ $item->district->district_name}}</td>
                                        <td>{{ $item->state_name}}</td>
                                        <td>
                                            <a href="{{ url('ship/state/edit/'.$item->id) }}" class="btn btn-info"><i class="fa fa-pencil" title="Edit Data"></i></a>
                                            <a href="{{ url('ship/state/delete/'.$item->id) }}" class="btn btn-danger" id="delete" onclick="return confirm('Are you sure?')" title="Delete Data"><i class="fa fa-trash"></i></a>
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
                        <h3 class="box-title">Add District</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form action="{{ route('state.store') }}" method="POST">
                                @csrf


                                <div class="form-group">
                                    <h5>Division <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="division_id" id="select" required="" class="form-control" aria-invalid="false">
                                            <option value="" active="">Select Your City</option>
                                            @foreach($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->division_area }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <h5>District <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="district_id" class="form-control" aria-invalid="false">
                                            <option value="" active="" disabled="">Select Your SubCategory</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <h5>State name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="state_name" class="form-control">
                                    </div>
                                </div>



                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add District" />
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



<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="division_id"]').on('change', function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: "{{  url('ship/state/subcategory/ajax') }}/" + id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="district_id"]').html('');
                        var d = $('select[name="district_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.district_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

    });
</script>
@endsection