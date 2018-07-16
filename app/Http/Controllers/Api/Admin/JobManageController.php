<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\JobManageRequest;
use App\Services\Api\Productions\Admin\JobService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobManageController extends Controller
{
    private $jobService;
    public function __construct()
    {
        $this->jobService = new JobService();
    }
    public function index()
    {
        return $this->jobService->getAll();
    }

    public function store(JobManageRequest $request)
    {

       return $this->jobService->save($request);

    }

    public function show($id)
    {
        return $this->jobService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->jobService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->jobService->destroy($id);
    }
    public function delete(DeleteListRequest $request){

        return $this->jobService->delete($request->id_list);
    }


    public function get_list_position()
    {
        return Position::all();
    }
    public function add_position(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name_position' => 'required|unique:positions,name_position'
        ],[
            'name_position.required' => 'Không có tên chức vụ',
            'name_position.unique' => 'Chức vụ đã tồn tại'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $position = new Position();
        $position->name_position = $request->name_position;
        $position->save();
        return response()->json([
            'message' => 'Thêm chức vụ thành công'
        ],200);
    }
    public function delete_list_position(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'list_id_position' => 'required'
        ],[
            'name_position.required' => 'Không có danh sách',

        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        if(gettype($request->list_id_position) != 'array')
        {
            return response()->json([
                'message' => "Không phải list ID"
            ],406);
        }
        if(count($request->list_id_position) < 1)
        {
            return response()->json([
                'message' => "List trống"
            ],406);
        }
        foreach ($request->list_id_position as $item)
        {
            $position = Position::find((int) $item);
            if($position!= null)
            {
                $position->delete();
            }
        }

        return response()->json([
            'message' => 'Xóa danh sách thành công'
        ],200);
    }
    public function delete_position(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:positions,id'
        ],[
            'id.required' => 'Không có id chức vụ',
            'id.unique' => 'Chức vụ đã tồn tại'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $position = Position::find($request->id);
        $position->delete();

        return response()->json([
            'message' => 'Xóa chức vụ thành công'
        ],200);
    }

    public function edit_position(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:positions,id',

        ],[
            'id.required' => 'Không có id chức vụ',
            'id.unique' => 'Chức vụ đã tồn tại'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $position = Position::find($request->id);
        $validator = Validator::make($request->all(),[
            'name_position' => 'required|unique:positions,name_position,'.$position->name_position

        ],[
            'name_position.required' => 'Không có tên chức vụ',
            'name_position.unique' => 'Chức vụ đã tồn tại'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $position->name_position = $request->name_position;
        $position->save();
        return response()->json([
            'message' => 'Sửa chức vụ thành công'
        ],200);
    }

    //skill

    public function get_list_skill()
    {
        return Skill::all();
    }
    public function add_skill(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name_skill' => 'required|unique:skills,name_skill'
        ],[
            'name_skill.required' => 'Không có tên kỹ năng',
            'name_skill.unique' => 'Chức vụ đã tồn tại'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $skill = new Skill();
        $skill->name_skill = $request->name_skill;
        $skill->save();
        return response()->json([
            'message' => 'Thêm kỹ năng thành công'
        ],200);
    }
    public function delete_list_skill(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'list_id_skill' => 'required'
        ],[
            'name_skill.required' => 'Không có danh sách',

        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        if(gettype($request->list_id_skill) != 'array')
        {
            return response()->json([
                'message' => "Không phải list ID"
            ],406);
        }
        if(count($request->list_id_skill) < 1)
        {
            return response()->json([
                'message' => "List trống"
            ],406);
        }
        foreach ($request->list_id_skill as $item)
        {
            $skill = Skill::find((int) $item);
            if($skill!= null)
            {
                $skill->delete();
            }
        }

        return response()->json([
            'message' => 'Xóa danh sách thành công'
        ],200);
    }
    public function delete_skill(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:skills,id'
        ],[
            'id.required' => 'Không có id kỹ năng',
            'id.unique' => 'Chức vụ đã tồn tại'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $skill = Skill::find($request->id);
        $skill->delete();

        return response()->json([
            'message' => 'Xóa kỹ năng thành công'
        ],200);
    }

    public function edit_skill(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:skills,id',

        ],[
            'id.required' => 'Không có id kỹ năng',
            'id.unique' => 'Chức vụ đã tồn tại'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $skill = Skill::find($request->id);
        $validator = Validator::make($request->all(),[
            'name_skill' => 'required|unique:skills,name_skill,'.$skill->name_skill

        ],[
            'name_skill.required' => 'Không có tên kỹ năng',
            'name_skill.unique' => 'Chức vụ đã tồn tại'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $skill->name_skill = $request->name_skill;
        $skill->save();
        return response()->json([
            'message' => 'Sửa kỹ năng thành công'
        ],200);
    }
    public function get_list_post(Request $request)
    {
        if($request->has('email_address_enterprise'))
        {
            if(Auth::user()->type == 2)
            {
                if(Auth::user()->user_name != $request->email_address_enterprise)
                {
                    return response()->json(['message' => 'Khong du quyen'],406);
                }
            }
            $user = User::where('user_name',$request->email_address_enterprise)->first();
            if($user != null)
            {
                $id_enterprise = $user->enterprise->id;
                return Enterprise::findOrFail($id_enterprise)->posts()->select('accept','created_at','id','title_post')->get();
            }
            return [];
        }

        $posts=  Post::join('enterprises','enterprises.id','posts.id_enterprise')->join('users','users.id','enterprises.id_user')->select('users.user_name','posts.id','posts.id_enterprise','posts.title_post'
            ,'posts.description_post','posts.updated_at','enterprises.name_enterprise','enterprises.address_enterprise','posts.accept','posts.created_at','enterprises.avatar_enterprise')->distinct()->orderBy('posts.created_at','desc')->get();
        return $posts;
    }
    public function accept_post($id)
    {
        $post = Post::findOrFail($id);

        $post->accept = 1;
        $post->update();
        return ['status' => 1,'message' =>'Chấp nhận bài viết thành công'];
    }
    public function get_detail_post($id)
    {
        $get_data_service = new GetDataService();
        return $get_data_service->adminGetDetailJob($id);

    }
}
