<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Todo::select(['id', 'uid', 'content'])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'content' => ['required', 'max:256'],
            'uid' => ['required']
        ]);
        $todos = Todo::create($request->only(['content', 'uid']));
        $todos->save();
        return $todos;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(int $id) {
        $todo = Todo::select(['id', 'uid', 'content', 'created_at', 'updated_at'])->where('id', $id)->get();
        $todo->load(['account','tag']);
        return $todo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id) {
        $todo = Todo::find($id);
        $todo->update($request->only(['content']));
        return $todo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id) {
        return Todo::destroy($id);
    }
}
