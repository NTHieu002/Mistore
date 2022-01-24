@extends('admin_layout')
@section('admin_content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Cập Nhật Sản Phẩm</h3>
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
                        <h2>Cập Nhật Thông Tin Sản Phẩm <small></small></h2>
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
                        {{csrf_field()}}
                        <span class="section">Thông Tin </span>
                        
                        @foreach($edit_product as $value)
                        <form  method="GET"  action="{{URL::to('/update-product/'.$value->product_id)}}">
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Tên Sản Phẩm<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="product_name" value="{{$value->product_name}}" required="required" />
                                </div>
                            </div>
                            
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Mô Tả<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea type="text" class="form-control" data-validate-length-range="6" data-validate-words="2" name="product_desc" required="required">
                                        {{$value->product_desc}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Số Lượng<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" value="{{$value->product_quantity}}" data-validate-length-range="6" data-validate-words="2" name="product_quantity" placeholder="Cái" required="required" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Giá<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" value="{{$value->product_price}}" name="product_price"  required="required" />
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
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button name="btn__update_product" type='submit' class="btn btn-primary" >Cập Nhật</button>
                                        <button type='reset' class="btn btn-success">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endforeach
                        <?php
                            use Illuminate\Support\Facades\Session;
                            $mess = Session::get('message');
                            if($mess) {
                                echo $mess;
                                Session::put('message',null);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection