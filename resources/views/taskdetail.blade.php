@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-1 col-sm-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Item Detail
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('itemdetail')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <input type="text" hidden="hidden" value="{{ $task->id }}" name="task_id">

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Item</label>

                            <div class="col-sm-4">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ $task->name }}">
                            </div>
                        </div>

                        <!-- Category Name -->
                        <div class="form-group">
                            <label for="task-category" class="col-sm-3 control-label">Category</label>

                            <div class="col-sm-4">
                                <select class="form-control" name="category_id">
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        <?php if ($task->category_id==$category->id) { ?>selected="selected"<?php } ?>
                                        >{{ $category->category_name }}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        </div>

                        <!-- Shop -->
                        <div class="form-group">
                            <label for="task-category" class="col-sm-3 control-label">Shop</label>

                            <div class="col-sm-4">
                                <input type="text" name="shop" id="task-shop" class="form-control" value="{{ $task->shop }}">
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                            <label for="task-category" class="col-sm-3 control-label">Price</label>

                            <div class="col-sm-4">
                                <input type="text" name="price" id="task-price" class="form-control" value="{{ $task->price }}">
                            </div>
                        </div>

                        <!-- Task Completion -->
                        <div class="form-group">
                            <label for="task-price" class="col-sm-3 control-label">Purchased</label>

                            <div class="col-sm-4">
                                <input style="margin-top:10px;" name="completed" type="checkbox" 
                                <?php if ($task->completed) { ?>checked="checked"<?php } ?>
                                aria-label="Completed" id="task-completed">
                            </div>
                        </div>


                        <!-- Update Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-2">
                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>
                            </div>
                            <div class="col-sm-2">
                                <a href="{{ url('/') }}">
                                    <button type="button" class="btn btn-warning">
                                        Cancel
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>
                    <form action="{{ url('task/'.$task->id) }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-btn fa-trash"></i>Delete
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

