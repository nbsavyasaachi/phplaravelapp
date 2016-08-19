<?php

use App\Task;
use App\Category;
use Illuminate\Http\Request;

Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'des')->paginate(5);
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
    // $categories = Category::orderBy('created_at', 'asc')->get();
    // $tasks = Task::orderBy('created_at', 'asc')->get();

    // $categoriesjson = array();
    // $tasksjson = array();
    
    // $i = 0;
    // foreach ($categories as $category)
    // {
    //     $categoriesjson[$i] = $category->category_name;
    //     $i++;
    // }

    // $i = 0;
    // foreach($categories as $category)
    // {
    //     $total = 0;
    //     foreach ($tasks as $task)
    //     {
    //         if($task->category->category_name == $category->category_name){
    //             if($task->completed)
    //             {
    //                 $total = $total + $task->price;
    //             }
    //         }
    //     }
    //     $tasksjson[$i] = $total;
    //     $i++;
    // }

    // return response()->json([
    //     'values' => $shopstrendjson,
    //     'labels' => $shopsjson,
    //     'type' => 'pie'
    //  ]);

    $tasks = Task::orderBy('created_at', 'asc')->get();
    $shops = Task::distinct()->get(['shop']);
    $shopstrendjson = array();
    $shopsjson = array();

    $i = 0;
    foreach($shops as $shop)
    {
        $total = 0;
        foreach ($tasks as $task)
        {
            if($task->shop == $shop->shop){
                if($task->completed)
                {
                    $total = $total + $task->price;
                }
            }
        }
        $shopstrendjson[$i] = $total;
        $shopsjson[$i] = $shop->shop;
        $i++;
    }

    return response()->json([
        'values' => $shopstrendjson,
        'labels' => $shopsjson,
        'type' => 'pie'
    ]);

    // return response()->json([
    //   'y' => $shopstrendjson,
    //   'x' => $shopsjson,
    //   'type' => 'bar'
    // ]);
});

Route::post('/item', function (Request $request) {
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

Route::delete('/item/{id}', function ($id) {
    Task::findOrFail($id)->delete();

    return redirect('/');
});

Route::get('/itemdetail/{id}', function ($id) {
    
    $category = Category::orderBy('created_at', 'asc')->get();
    $task = Task::find($id);

    return view('taskdetail',[
        'task' => $task,
        'categories' => $category
        ]);
});

Route::post('/itemdetail',function(Request $request){
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


