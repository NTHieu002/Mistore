@extends('admin_layout')
@section('admin_content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Thêm Sản Phẩm</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tên sản phẩm">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Tìm kiếm</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Thêm Thông Tin Sản Phẩm <small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li>&nbsp;</li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form  method="post"  action="{{URL::to('/save-product')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <span class="section">Thông Tin </span>
                            <?php
                                use Illuminate\Support\Facades\Session;
                                $mess = Session::get('message');
                                if($mess) {
                                    echo $mess;
                                    Session::put('message',null);
                                }
                            ?>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Tên Sản Phẩm<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="product_name" placeholder="Xiaomi 11T" required="required" />
                                </div>
                            </div>
                            
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Mô Tả<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea type="text" class="form-control" data-validate-length-range="6" data-validate-words="2" name="product_desc" placeholder="Mô tả sản phẩm" required="required"></textarea>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Giá Sản Phẩm<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="product_price" placeholder="VND" required="required" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Số Lượng<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="product_quantity" placeholder="Cái" required="required" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Danh mục<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control col-sm-6" name="product_category" id="">
                                        @foreach($category_product as $cate)
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Thương Hiệu<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control col-sm-6" name="product_brand" id="">
                                        @foreach($category_brand as $brand)
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Trạng Thái<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control col-sm-6" name="product_status" id="">
                                        <option value="1">Hiển Thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Hình Ảnh<span class="required">*</span></label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control" name="product_img" placeholder="Ảnh Sản Phẩm" required="required"></input>
                                </div>
                            </div>
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button name="btn__add_product" type='submit' class="btn btn-primary" >Thêm</button>
                                        <button type='reset' class="btn btn-success">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection