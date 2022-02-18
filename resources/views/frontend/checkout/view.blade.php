@extends('frontend.frontend_master')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
@section('title')
Checkout
@endsection


<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                            <!-- panel-heading -->
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                                        <span>Osung </span>Checkout Form
                                    </a>
                                </h4>
                            </div>
                            <!-- panel-heading -->

                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">

                                        <!-- guest-login -->
                                        <form class="register-form" role="form" action="{{ route('checkout.submit') }}" method="POST">
                                            @csrf
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <h3 class="checkout-subtitle"><b>Shipping Form</b></h3>

                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                                                    <input type="text" name="shipping_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="" value="{{ Auth::user()->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Email <span>*</span></label>
                                                    <input type="email" name="shipping_email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="" value="{{ Auth::user()->email }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Phone <span>*</span></label>
                                                    <input type="text" name="shipping_phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="" value="{{ Auth::user()->phone }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Post Code <span>*</span></label>
                                                    <input type="text" name="post_code" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Please type your Postal Code here" required>
                                                </div>
                                            </div>

                                            <!-- already-registered-login -->
                                            <div class="col-md-6 col-sm-6 already-registered-login">

                                                <div class="form-group">
                                                    <h5>Division <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="division_id" class="form-control" aria-invalid="false">
                                                            <option value="" active="">Select Your Category</option>
                                                            @foreach($divisions as $item)
                                                            <option value="{{ $item->id }}">{{ $item->division_area }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>District <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="district_id" class="form-control" aria-invalid="false">
                                                            <option value="" active="" disabled="">Please choose</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>State <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="state_id" class="form-control" aria-invalid="false">
                                                            <option value="" active="" disabled="">Please choose</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Notes <span class="text-danger">*</span></h5>
                                                    <textarea id="editor2" name="notes" rows="5" cols="40">
You can type here some additional information
						                        </textarea>
                                                </div>

                                            </div>
                                            <!-- already-registered-login -->
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div>
                        <!-- checkout-step-01  -->

                    </div><!-- /.checkout-steps -->
                </div>
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">List of products</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        @foreach($carts as $item)
                                        @if(Session::has('coupon'))
                                        <li>
                                            <img src="{{ $item->options->image }}" alt="" style="width:50px; height:50px;">
                                            <div style="display:inline-block;padding:10px;">
                                                <div style="display:flex;flex-direction:column;">
                                                    <slim>Quantity: {{ $item->qty }}</slim>
                                                    <slim>Price:$ {{ session()->get('coupon')['total_amount'] }}</slim>
                                                </div>
                                            </div>
                                        </li>
                                        @else
                                        <li>
                                            <img src="{{ $item->options->image }}" alt="" style="width:50px; height:50px;">
                                            <div style="display:inline-block;padding:10px;">
                                                <div style="display:flex;flex-direction:column;">
                                                    <slim>Quantity: {{ $item->qty }}</slim>
                                                    <slim>Price:$ {{ $item->price }}</slim>
                                                </div>
                                            </div>
                                        </li>
                                        @endif

                                        @endforeach
                                        @if(Session::has('coupon'))
                                        <li><strong> Total: $ {{ session()->get('coupon')['total_amount'] }}</strong> </li>
                                        @else
                                        <li><strong> Total: $ {{ $cartTotal }}</strong> </li>
                                        @endif

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.body.brands')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->




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

        $('select[name="district_id"]').on('change', function() {
            var dis_id = $(this).val();
            if (dis_id) {
                $.ajax({
                    url: "{{  url('/state/sub-subcategory/ajax') }}/" + dis_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="state_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="state_id"]').append('<option value="' + value.id + '">' + value.state_name + '</option>');
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