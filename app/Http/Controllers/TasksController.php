<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;    // 追加

class TasksController extends Controller
{
    // getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        // タスク一覧を取得
        $tasks = Task::all();
        
        // タスク一覧ビューを表示
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    // getでtasks/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $task = new Task;
        
        // タスク作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    // postでtasks/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        // タスクを作成
        $task = new Task;
        $task->content = $request->content;
        $task->save();
        
        // トップページへリダイレクト
        return redirect('/');
    }

    // getでtasks/（任意のid）にアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        // idでタスクを検索して取得
        $task = Task::findOrFail($id);
        
        // タスク詳細ビューを表示
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    // getでtasks/（任意のid）/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        // idでタスクを検索して取得
        $task = Task::findOrFail($id);
        
        // タスク編集ビューで表示
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    // putまたはpatchでtasks/（任意のid）にアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        // idでタスクを検索して取得
        $task = Task::findOrFail($id);
        
        // タスクを更新
        $task->content = $request->content;
        $task->save();
        
        // トップページへリダイレクト
        return redirect('/');
    }

    // deleteでtasks/（任意のid）にアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        // idでタスクを検索して取得
        $task = Task::findOrFail($id);
        // タスクを削除
        $task->delete();
        
        // トップページへリダイレクト
        return redirect('/');
    }
}
