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
                        <h3 class="box-title">Edit SubCategory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form action="{{ url('category/sub/update/'.$subcat->id) }}" method="POST">
                                @csrf



                                <div class="form-group">
                                    <h5>SubCategory Name En <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subcategory_name_en" class="form-control" value="{{ $subcat->subcategory_name_en }}">

                                    </div>
                                </div>




                                <div class="form-group">
                                    <h5>SubCategory Name Ru <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subcategory_name_ru" class="form-control" value="{{ $subcat->subcategory_name_ru }}">

                                    </div>
                                </div>




                                <div class="form-group">

                                    <h5>Basic Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" class="form-control" aria-invalid="false">
                                            <option value="" active="" disabled="">Select Your City</option>
                                            @foreach($cat as $item)
                                            <option value="{{ $item->id }}" {{ $subcat->category_id == $item->id ? 'selected' :'' }}>{{ $item->category_name_en }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                    </div>

                                </div>


                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update SubCategory" />
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