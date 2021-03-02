<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UserResource\UserCollection;
use Goodcatch\Modules\Laravel\Model\Module;
use Goodcatch\Modules\Qwshop\Http\Resources\Admin\ModuleResource\ModuleCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Module $model)
    {
        $list = $model->orderBy('id','desc')->paginate($request->per_page??30);
        return $this->success(new ModuleCollection($list) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Module $model)
    {
        if($model->where('name',$request->name)->exists()){
            return $this->error(__('laravel-modules::admins.module_existence'));
        }
        $model = $model->create([
            'name'      =>  $request->username,
            'alias'         =>  $request->phone,
            'description'      =>  $request->description??'',
            'priority'      =>  $request->priority??0,
            'version'      =>  $request->version??'',
            'path'        =>  $request->path??'',
            'type'        =>  $request->type??'',
            'sort'        =>  $request->sort??1,
            'status'        =>  $request->status??0,
        ]);
       
        return $this->success([],__('base.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Module $model,$id)
    {
        $info = $model->find($id);
        return $this->success($info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Module $model, $id)
    {
        if($model->where('name',$request->username)
                        ->where('id','<>',$id)
                        ->exists()
        ){
            return $this->error(__('admins.module_existence'));
        }

        $model = $model->find($id);
        $model->name = $request->name;

        $model->name = $request->name;
        $model->path = $request->path;
        $model->save();
        return $this->success([],__('base.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $model,$id)
    {
        $idArray = array_filter(explode(',',$id),function($item){
            return is_numeric($item);
        });

        $model->destroy($idArray);
        return $this->success([],__('base.success'));
    }
}
