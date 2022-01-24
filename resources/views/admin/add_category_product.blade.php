@extends('admin_layout')
@section('admin_content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Thêm Danh Mục Sản Phẩm</h3>
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
                        <h2>Thêm Thông Tin Danh Mục <small></small></h2>
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
                        <form  method="post"  action="{{URL::to('/save-category-product')}}">
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
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Tên Danh Mục<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="category_product_name" placeholder="Smart Phone" required="required" />
                                </div>
                            </div>
                            
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Mô Tả<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea type="text" class="form-control" data-validate-length-range="6" data-validate-words="2" name="category_product_description" placeholder="Bao gồm các sản phẩm" required="required"></textarea>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Hiển Thị<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control col-sm-6" name="category_product_status" id="">
                                        <option value="1">Hiển Thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button name="btn__add_category_product" type='submit' class="btn btn-primary" >Thêm</button>
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