<?php

use App\Task;
use App\Category;
use Illuminate\Http\Request;

Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();
    $category = Category::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks,
        'categories' => $category
    ]);
});

Route::get('/about',function() {
    return view('about');
});

Route::get('/graphs',function() {
    return view('graphs');
});

Route::get('/graphsdata', function() {
    $categories = Category::orderBy('created_at', 'asc')->get();
    $tasks = Task::orderBy('created_at', 'asc')->get();

    $categoriesjson = array();
    $tasksjson = array();
    
    $i = 0;
    foreach ($categories as $category)
    {
        $categoriesjson[$i] = $category->category_name;
        $i++;
    }

    $i = 0;
    foreach($categories as $category)
    {
        $total = 0;
        foreach ($tasks as $task)
        {
            if($task->category->category_name == $category->category_name){
                if($task->completed)
                {
                    $total = $total + $task->price;
                }
            }
        }
        $tasksjson[$i] = $total;
        $i++;
    }


    return response()->json([
      'values' => $tasksjson,
      'labels' => $categoriesjson,
      'type' => 'pie'
    ]);
});

Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->category_id = $request->category_id;
    $task->save();

    return redirect('/');
});

Route::delete('/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();

    return redirect('/');
});

Route::get('/taskdetail/{id}', function ($id) {
    
    $category = Category::orderBy('created_at', 'asc')->get();
    $task = Task::find($id);

    return view('taskdetail',[
        'task' => $task,
        'categories' => $category
        ]);
});

Route::post('/taskdetail',function(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = Task::find($request->task_id);
    $task->name = $request->name;
    $task->category_id = $request->category_id;
    $task->shop = $request->shop;
    $task->price = $request->price;
    if($request->completed == 'on'){
        $task->completed = true;
    }
    else{
        $task->completed = false;
    }
    $task->update();

    return redirect('/');
});

/* list of the categories */
Route::get('/categories', function () {
    $category = Category::orderBy('created_at', 'asc')->get();

    return view('categories', [
        'categories' => $category
    ]);
});

Route::post('/category', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'category_name' => 'required|unique:category|max:255'
    ]);

    if ($validator->fails()) {
        return redirect('/categories')
            ->withInput()
            ->withErrors($validator);
    }

    $category = new Category;
    $category->category_name = $request->category_name;
    $category->save();

    return redirect('/categories');
});

Route::delete('/category/{id}', function ($id) {
    Category::findOrFail($id)->delete();
    return redirect('/categories');
});


