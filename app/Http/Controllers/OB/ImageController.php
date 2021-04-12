<?php

namespace App\Http\Controllers\OB;

use App\Http\Controllers\Controller;
use App\Image;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class ImageController extends Controller
{

    public function index()
    {
        $user = Auth::user()->id;
        $datas = Image::where('user_id', $user)->groupBy('created_at')->get(); //get data image berdasarkan user yang login
        return view('pages.ob.upload.index', compact('datas'));
    }


    public function create()
    {
        $user = Auth::user()->id;
        $tasks = Task::where('user_id', $user)->get(); // get task berdasarkan user yang login

        return view('pages.ob.upload.create', compact('tasks'));
    }


    public function store(Request $request)
    {
        $now = date('Ymd') . date('His');

        $tasks_id = $request['task_id'];
        foreach ($request->file('image') as $image) {
            $imageName[] = '.' . $image->extension();
        }
        $array = array_combine($tasks_id, $imageName);


        foreach ($array as $key => $value) {
            Image::create([
                'user_id' => Auth::user()->id,
                'task_id' => $key,
                'image' => Auth::user()->id . '-' . $key . '-' . $now . $value
            ]);
        }

        foreach ($array as $key => $value) {
            $nama_file[] = Auth::user()->id . '-' . $key . '-' . $now . $value;
        }
        $index = 0;
        foreach ($request->file('image') as $image) {
            $image->move(public_path('images_tugas'), $nama_file[$index]);
            $index++;
        }
        return redirect()->route('ob.upload.index')->with('success', 'Your images has been upload successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $tanggal = $id;
        
        $data = Image::where('user_id', Auth::user()->id)->where('created_at', $id)->orderBy('task_id', 'ASC')->get();
       
        foreach ($data as $d) {
            $tasks = Task::where('id', $d['task_id'])->first();
            $task_id[] = $tasks['id'];
            $task_name[] = $tasks['name'];
        }

        return view('pages.ob.upload.edit', compact('task_name', 'data', 'tanggal', 'task_id'));
    }


    public function update(Request $request, $id)
    {
        $now = date('Ymd') . date('His');
        $images_id = $request['id_image'];
        $tasks_id = $request['task_id'];

        $index = 0;
        foreach ($tasks_id as $t) {
            $nama_form = strval($tasks_id[$index]);

            if ($request->file($nama_form) != null) {
                $ambil_data_image = Image::find($images_id[$index]);
                File::delete('images_tugas/' . $ambil_data_image['image']);
                $nama_file = Auth::user()->id . '-' . $tasks_id[$index] . '-' . $now . '.' . $request[$nama_form]->extension();
                $request[$nama_form]->move(public_path('images_tugas'), $nama_file);
                Image::whereId($images_id[$index])->update([
                    'image' =>  $nama_file
                ]);
            }
            $index++;
        }

        return redirect()->route('ob.upload.index')->with('success', 'Your images has been upload successfully');
    }


    public function destroy($id)
    {
        // $data = Image::findOrfail($id);
        // File::delete('images_tugas/' . $data['image']);
        // $data->delete();
        // return redirect()->route('ob.upload.index')->with('success', 'Berhasil Menghapus Data');

    }
}
