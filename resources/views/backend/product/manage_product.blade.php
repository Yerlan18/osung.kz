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
                        <h3 class="box-title">Product List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name En</th>
                                        <th>Product Price</th>
                                        <th>Product Discount</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $item)
                                    <tr>
                                        <td><img src="{{ asset($item->product_thumbnail) }}" alt="" style="width:100px; height:80px;"></td>
                                        <td>{{ $item->product_name_en }}</td>
                                        <td>{{ $item->selling_price }} $</td>
                                        <td>

                                            @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $dis = ($amount/$item->selling_price)*100;
                                            @endphp


                                            {{round($dis)}} %



                                        </td>
                                        <td>{{ $item->product_qty }} items</td>
                                        <td>
                                            @if($item->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">InActive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status == 1)
                                            <a href="{{ url('product/inactive/'.$item->id) }}" class="btn btn-danger"><i class="fa fa-arrow-down" title="Product Inactivate Data"></i></a>
                                            @else
                                            <a href="{{ url('product/active/'.$item->id) }}" class="btn btn-success"><i class="fa fa-arrow-up" title="Product Activate Data"></i></a>
                                            @endif


                                            <a href="{{ url('product/edit/'.$item->id) }}" class="btn btn-info"><i class="fa fa-pencil" title="Edit Data"></i></a>
                                            <a href="{{ url('product/deleteitem/'.$item->id) }}" class="btn btn-danger" id="delete" onclick="return confirm('Are you sure?')" title="Delete Data"><i class="fa fa-trash"></i></a>
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

            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>


@endsection