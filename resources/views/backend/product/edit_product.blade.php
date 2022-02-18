@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit product</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('update-product') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="row">
                                <div class="col-12">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <h5>Brand List <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="brand_id" class="form-control" aria-invalid="false">
                                                        <option value="" active="">Select Your Brand</option>
                                                        @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ ($brand->id == $product->brand_id) ? 'selected' : '' }}>{{ $brand->brand_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <h5>Category List <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" class="form-control" aria-invalid="false">
                                                        <option value="" active="">Select Your Category</option>
                                                        @foreach($categories as $cat)
                                                        <option value="{{ $cat->id }}" {{ ($cat->id == $product->category_id) ? 'selected' : '' }}>{{ $cat->category_name_en }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <h5>SubCategory List <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subcategory_id" class="form-control" aria-invalid="false">
                                                        <option value="" active="">Select Your SubCategory</option>
                                                        @foreach($subcategory as $cat)
                                                        <option value="{{ $cat->id }}" {{ ($cat->id == $product->subcategory_id) ? 'selected' : '' }}>{{ $cat->subcategory_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <h5>SubSubCategory List <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subsubcategory_id" class="form-control" aria-invalid="false">
                                                        <option value="" active="">Select Your SubSubCategory</option>
                                                        @foreach($subsubcategory as $cat)
                                                        <option value="{{ $cat->id }}" {{ ($cat->id == $product->subsubcategory_id) ? 'selected' : '' }}>{{ $cat->subsubcategory_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Name En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_en" class="form-control" value="{{ $product->product_name_en }}">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Name Ru <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_ru" class="form-control" value="{{ $product->product_name_ru }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Code <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_code" class="form-control" value="{{ $product->product_code }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product quantity <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_qty" class="form-control" value="{{ $product->product_qty }}">

                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Tags En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_en" class="form-control" value="{{ $product->product_tags_en }}" data-role="tagsinput" placeholder="add tags">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Tags Ru <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_ru" class="form-control" value="{{ $product->product_tags_ru }}" data-role="tagsinput" placeholder="add tags">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Size En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_en" class="form-control" value="{{ $product->product_size_en }}" data-role="tagsinput" placeholder="add tags">
                                                </div>
                                            </div>
                                        </div>

                                    </div>



                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Color En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_en" class="form-control" value="{{ $product->product_color_en }}" data-role="tagsinput" placeholder="add tags">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Color Ru <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_ru" class="form-control" value="{{ $product->product_color_ru }}" data-role="tagsinput" placeholder="add tags">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Size Ru <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_ru" class="form-control" value="{{ $product->product_size_ru }}" data-role="tagsinput" placeholder="add tags">
                                                </div>
                                            </div>
                                        </div>

                                    </div>



                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Selling price <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="selling_price" class="form-control" value="{{ $product->selling_price }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="discount_price" class="form-control" value="{{ $product->discount_price }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Short Desc En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_desc_en" id="textarea" class="form-control">{{ $product->short_desc_en }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Short Desc Ru <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_desc_ru" id="textarea" class="form-control">{{ $product->short_desc_ru }}</textarea>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product Long Desc En <span class="text-danger">*</span></h5>
                                                    <textarea id="editor1" name="long_desc_en" rows="10" cols="80">
                                                {!! $product->long_desc_en !!}
                                                </textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product Long Desc Ru <span class="text-danger">*</span></h5>
                                                    <textarea id="editor2" name="long_desc_ru" rows="10" cols="80">
                                                {!! $product->long_desc_ru !!}
                                                </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_2" name="special_offer" value="1" {{ ($product->special_offer == 1)? 'checked':'' }}>
                                                <label for="checkbox_2">Special offer</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_3" name="special_deals" value="1" {{ ($product->special_deals == 1)? 'checked':'' }}>
                                                <label for="checkbox_3">Special deals</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_4" name="hot_deals" value="1" {{ ($product->hot_deals == 1)? 'checked':'' }}>
                                                <label for="checkbox_4">Hot deals</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" id="checkbox_5" name="featured" value="1" {{ ($product->featured == 1)? 'checked':'' }}>
                                                <label for="checkbox_5">Featured</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-rounded btn-info" value="Submit">
                            </div>
                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>

    <section class="content">



        <h3>Editing of Multiple Images</h3>
        <form action="{{ route('update-product-img') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                @foreach($multiImg as $img)

                <div class="col-md-3">


                    <div>
                        <div class="box bt-3 border-info">
                            <div class="box-header">
                                <img src="{{ asset($img->photo_name) }}" alt="" style="width:150px; height:100px;">
                            </div>

                            <div class="box-body d-flex m-3">
                                <a href="{{ route('product.multiimg.delete', $img->id) }}" class="btn btn-danger mr-3">
                                    <bold>DELETE</bold>
                                </a>
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="file" name="multi_img[{{ $img->id }}]" class="form-control">
                                        <div class="row" id="preview_img"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>



                @endforeach




            </div>

        </form>



    </section>







    <section class="content">



        <h3>Editing of Thumbnail Image</h3>
        <form action="{{ route('update-product-thumb') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="old_img" value="{{ $product->product_thumbnail }}">

                <div class="col-md-3">


                    <div>
                        <div class="box bt-3 border-info">
                            <div class="box-header">
                                <img src="{{ asset($product->product_thumbnail) }}" alt="" style="width:150px; height:100px;">
                            </div>

                            <div class="box-body d-flex m-3">

                                <div class="form-group">
                                    <div class="controls">
                                        <input type="file" name="product_thumbnail" class="form-control" onchange="mainTHM(this)">
                                        <img src="" alt="" id="thmIMG">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>








            </div>

        </form>



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
                        $('select[name="subsubcategory_id"]').html('');
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
        $('select[name="subcategory_id"]').on('change', function() {
            var subcategory_id = $(this).val();
            if (subcategory_id) {
                $.ajax({
                    url: "{{  url('/category/sub-subcategory/ajax') }}/" + subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subsubcategory_id"]').append('<option value="' + value.id + '">' + value.subsubcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

    });
</script>

<script type="text/javascript">
    function mainTHM(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#thmIMG').attr('src', e.target.result).width(120).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


<script>
    $(document).ready(function() {
        $('#multiImg').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(80)
                                    .height(80); //create image element 
                                $('#preview_img').append(img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>



@endsection