<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Comment;
use App\Models\Product;
session_start();

class CommentController extends Controller
{
       //comment
       public function send_comment(Request $request) {
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $cmt = new Comment();
        $cmt->comment = $comment_content;
        $cmt->comment_name_user = $comment_name;
        $cmt->comment_product_id = $product_id;
        $cmt->comment_status = 0;
        $cmt->save();
    }

    public function load_comment(Request $request) {
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id',$product_id)->where('comment_status','>=',1)->get();
        $output = '';   
        foreach($comment as $comment_value) {
            if($comment_value->comment_name_user != 'Admin'){
                $output .= '
                
                <div class="col-sm-12 style_cmt">
                    <div class="col-sm-2"><img src="'.url('public/frontend/images/icon_user.png').'" width="60%"></div>
                    <div class="col-sm-10">
                        <p style="color: #37a911;">@'.$comment_value->comment_name_user.' &nbsp '.$comment_value->comment_date.'</p>
                        <p>'.$comment_value->comment.'</p>
                    </div>
                </div> ';

            } 
            
            foreach($comment as $rep_comment_value) {
                if($rep_comment_value->comment_parent == $comment_value->comment_id) {
                    $output .= '
                    <div class="col-sm-12 style_cmt" style="margin-left: 70px; width: 100%;">
                        <div class="col-sm-2" ><img src="'.url('public/frontend/images/logo.png').'" width="80%"></div>
                        <div class="col-sm-10">
                            <p style="color: #17a2b8;">@Admin &nbsp '.$rep_comment_value->comment_date.'</p>
                            <p>'.$rep_comment_value->comment.'</p>
                        </div>
                    </div>
                    
                    ';
                }
            }
        }
        echo $output;
    }

    public function manage_comment() {
        $comment = Comment::with('product')->where('comment_parent','=',null)->orderBy('comment_id','DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent','>',0)->get();
        return view('pages.comment.manage_comment')->with(compact('comment','comment_rep'));
    }

    public function confirm_comment($comment_id) {
        $comment = Comment::find($comment_id);
        $comment->comment_status = 1;
        $comment->save();
        Session::put('message','Cập nhật thành công bình luận');
        return Redirect::to('/manage-comment');
    }

    public function del_comment($comment_id) {
        $comment = Comment::find($comment_id);
        $comment->delete();
        Session::put('message','Xóa thành công bình luận');
        return Redirect::to('/manage-comment');
    }

    public function reply_comment(Request $request) {
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent = $data['comment_id'];
        $comment->comment_name_user = 'Admin';
        $comment->comment_status = 1;

        $comment->save();
    }
}
