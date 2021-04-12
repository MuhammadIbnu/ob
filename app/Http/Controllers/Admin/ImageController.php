<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;
use App\Task;

class ImageController extends Controller
{
    
    public function index()
    {
        $datas = Image::orderBy('id', 'DESC')->groupBy('created_at')->get();
        
        return view('pages.admin.upload.index', compact('datas'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        
        $data = Image::where('created_at', $id)->orderBy('task_id', 'ASC')->get();
       
        foreach ($data as $d) {
            $tasks = Task::where('id', $d['task_id'])->first();
            $task_name[] = $tasks['name'];
        }

        return view('pages.admin.upload.show', compact('task_name', 'data'));
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
