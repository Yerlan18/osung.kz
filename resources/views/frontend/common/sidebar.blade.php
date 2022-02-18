<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">
            @php
            $categories = App\Models\Category::orderBy('category_name_en', 'ASC')->get();
            @endphp
            @foreach( $categories as $cat)
            <li class="dropdown menu-item mb-5"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $cat->category_icon }}" aria-hidden="true"></i>{{ (session()->get('language') == 'eng') ? $cat->category_name_en : $cat->category_name_ru  }}</a>
                <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                            @php
                            $subcategories = App\Models\SubCategory::where('category_id',$cat->id )->orderBy('subcategory_name_en', 'ASC')->get();
                            @endphp

                            @foreach($subcategories as $sub)

                            <div class="col-sm-12 col-md-3">
                                <a href="{{ url('subcategory/product/'.$sub->id.'/'.$sub->subcategory_slug_en) }}" style="padding:0;">
                                    <h2 class="title">{{ (session()->get('language') == 'eng') ? $sub->subcategory_name_en : $sub->subcategory_name_ru }}</h2>
                                </a>
                                <ul class="links list-unstyled">
                                    @php
                                    $subsubcategories = App\Models\SubSubCategory::where('subcategory_id',$sub->id )->orderBy('subsubcategory_name_en', 'ASC')->get();
                                    @endphp
                                    @foreach($subsubcategories as $f)
                                    <li> <a href="{{ url('subsubcategory/product/'.$f->id.'/'.$f->subsubcategory_slug_en) }}" style="padding:0;">{{ (session()->get('language') == 'eng') ? $f->subsubcategory_name_en : $f->subsubcategory_name_ru }}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                            @endforeach

                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                </ul>
                <!-- /.dropdown-menu -->
            </li>
            @endforeach
            <!-- /.menu-item -->
        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>