<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource;
use App\Models\Todos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    //
    public function index()
    {
        //get posts
        $posts = Todos::all();

        //return collection of posts as a resource
        return new TodoResource(true, 'List Data Todo', $posts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'title' => 'required',
            'description' => 'required', // Perbaikan pada nama kolom 'description'
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Ambil id user dari instance Request
        // $id_user = $request->user()->id; // Anda bisa saja menggunakan $request->id_user jika id user sudah diset pada instance Request

        // Buat post
        $todo = Todos::create([
            'id_user' => $request->id_user,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return new TodoResource(true, 'Data todo Berhasil Ditambahkan!', $todo);
    }

    public function show(Todos $todos)
    {
        return new TodoResource(true, 'Data materi Ditemukan!', $todos);
    }

    public function update(Request $request, Todos $todos)
    {
    }

    public function destroy(Todos $todos)
    {

        //delete post
        $todos->delete();

        //return response
        return new TodoResource(true, 'Data Materi Berhasil Dihapus!', null);
    }
}
