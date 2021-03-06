@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sub-SubCategory List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>SubCategory</th>
                                        <th>Sub-SubCategory En</th>
                                        <th>Sub-SubCategory Ru</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subsubcat as $item)
                                    <tr>
                                        <td>{{ $item->category->category_name_en }}</td>
                                        <td>{{ $item->subcategory->subcategory_name_en }}</td>
                                        <td>{{ $item->subsubcategory_name_en }}</td>
                                        <td>{{ $item->subsubcategory_name_ru }}</td>
                                        <td>
                                            <a href="{{ url('category/sub/sub/'.$item->id) }}" class="btn btn-info"><i class="fa fa-pencil" title="Edit Data"></i></a>
                                            <a href="{{ url('category/sub/sub/delete/'.$item->id) }}" class="btn btn-danger" id="delete" onclick="return confirm('Are you sure?')" title="Delete Data"><i class="fa fa-trash"></i></a>
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
                        <h3 class="box-title">Add SubCategory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form action="{{ route('subsubcategory.store') }}" method="POST">
                                @csrf



                                <div class="form-group">
                                    <h5>Sub-SubCategory Name En <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subsubcategory_name_en" class="form-control">
                                    </div>
                                </div>




                                <div class="form-group">
                                    <h5>Sub-SubCategory Name Ru <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subsubcategory_name_ru" class="form-control">

                                    </div>
                                </div>




                                <div class="form-group">

                                    <h5>Category List <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" class="form-control" aria-invalid="false">
                                            <option value="" active="" disabled="">Select Your City</option>
                                            @foreach($cat as $item)
                                            <option value="{{ $item->id }}">{{ $item->category_name_en }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <h5>SubCategory List <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subcategory_id" class="form-control" aria-invalid="false">
                                            <option value="" active="" disabled="">Select</option>
                                        </select>
                                        <div class="help-block"></div>
                                    </div>

                                </div>


                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add SubCategory" />
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
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_name_en + '</option>');
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