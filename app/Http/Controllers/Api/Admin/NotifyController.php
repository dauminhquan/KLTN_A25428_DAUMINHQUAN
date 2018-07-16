<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NotifyController extends Controller
{
    public function notifies(){
        $notifies = Notification::all();
        foreach ($notifies as $item)
        {
            $item->admin = $item->admin()->select('name_admin')->first()->name_admin;
        }
        return $notifies;
    }

    public function update_notify(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
           'title_notify' => 'required',
           'description_notify' => 'required',
           'content_notify' => 'required',
        ],[
            'title_notify.required' => 'Khong co tieu de bai viet',
            'description_notify.required' => 'Khong co mo ta bai viet',
            'content_notify.required' => 'Khong co noi dung bai viet'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),403);

        }

        $notify = Notification::findOrFail($id);
        $notify->title_notify = $request->title_notify;
        $notify->description_notify = $request->description_notify;
        $notify->content_notify = $request->content_notify;
        if($request->hasFile('file_attach_notify'))
        {
            Storage::delete($notify->file_attach_notify);
            $notify->file_attach_notify = $request->file('file_attach_notify')->storeAs('public/file_attaches','notify_'.$notify->id.'_file_attach.'.$request->file('file_attach_notify')->getClientOriginalExtension());
        }
        $notify->update();
        return  ['message' => 'Thanh cong'];
    }

    public function delete_notify($id)
    {
        $notify = Notification::findOrFail($id);
        Storage::delete($notify->file_attach_notify);
        $notify->delete();
        return ['message' => 'Xóa thành công'];
    }

    public function add_notify (Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title_notify' => 'required',
            'description_notify' => 'required',
            'content_notify' => 'required',
        ],[
            'title_notify.required' => 'Khong co tieu de bai viet',
            'description_notify.required' => 'Khong co mo ta bai viet',
            'content_notify.required' => 'Khong co noi dung bai viet'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),403);

        }

        $notify = new Notification();

        $notify->id_admin = Auth::user()->admin->id;
        $notify->title_notify = $request->title_notify;
        $notify->description_notify = $request->description_notify;
        $notify->content_notify = $request->content_notify;
        $notify->save();
        if($request->hasFile('file_attach_notify'))
        {
            $notify->file_attach_notify = $request->file('file_attach_notify')->storeAs('public/file_attaches','notify_'.$notify->id.'_file_attach.'.$request->file('file_attach_notify')->getClientOriginalExtension());
        }
        $notify->update();
        return  ['message' => 'Thanh cong'];
    }

    public function delete_list_notify(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'list_id_notify' =>'required|array'
        ],[
            'list_id_notify.required' => 'Không có danh sách ID',
            'list_id_notify.array' => 'Danh sách không đúng định dạng'
        ]);
        $list_id = $request->list_id_notify;
        $true = 0;
        $false = 0;
        foreach ($list_id as $id)
        {
            $notify = Notification::find($id);
            if($notify)
            {
                Storage::delete($notify->file_attach_notify);
                $notify->delete();
                $true++;
            }
            else{
                $false++;
            }
        }

        if($true == 0)
        {
            return response()->json(['message' => 'Danh sach rong hoac toan bo du lieu khong hop le'],403);
        }
        if($false == 0)
        {
            return response()->json(['mesage' => 'Xoa thanh cong']);
        }
        return response()->json(['message' => "Đã xóa thành công $true bài viết, thất bại $false bài viết"]);
    }

    public function notify($id)
    {
        return Notification::findOrFail($id);
    }


}
