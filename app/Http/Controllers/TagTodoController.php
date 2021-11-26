<?php

namespace App\Http\Controllers;

use App\TagTodo;
use Illuminate\Http\Request;

class TagTodoController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return TagTodo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate(['tag_id' => ['required'], 'todo_id' => ['required']]);
        $tag_todo = TagTodo::create($request->only(['tag_id', 'todo_id']));
        $tag_todo->save();
        return $tag_todo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TagTodo  $TagTodo
     * @return \Illuminate\Http\Response
     */
    public function show(int $id) {
        $tag_todo = TagTodo::with(['tag', 'todo', 'account'])
            ->where('id', '=', $id)->get();
        return $tag_todo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TagTodo  $TagTodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id) {
        $tag_todo = TagTodo::find($id);
        $tag_todo->update($request->only(['tag_id', 'todo_id']));
        return $tag_todo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TagTodo  $TagTodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id) {
        return TagTodo::destroy($id);
    }
}
