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
                        <h3 class="box-title">Add Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form action="{{ url('category/update/'.$cat->id) }}" method="POST">
                                @csrf



                                <div class="form-group">
                                    <h5>Category Name En <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_name_en" class="form-control" value="{{ $cat->category_name_en }}">

                                    </div>
                                </div>




                                <div class="form-group">
                                    <h5>Category Name Ru <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_name_ru" class="form-control" value="{{ $cat->category_name_ru }}">

                                    </div>
                                </div>




                                <div class="form-group">
                                    <h5>Category Icon <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_icon" class="form-control" value="{{ $cat->category_icon }}">

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