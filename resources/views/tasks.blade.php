@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-1 col-sm-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('task')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-4">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>

                        <!-- Category Name -->
                        <div class="form-group">
                            <label for="task-category" class="col-sm-3 control-label">Category</label>

                            <div class="col-sm-4">
                                <select class="form-control" name="category_id">
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Tasks
                    </div>

                    <div class="panel-body" id="taskdiv">
                        <table class="table table-striped task-table" style="margin-bottom:0px">
                            <thead>
                                <th>Task</th>
                                <th>Category</th>
                                <th>Shop</th>
                                <th>Price</th>
                                <th class="text-center">Completed</th>                              
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text"><div>{{ $task->name }}</div></td>
                                        <td class="table-text"><div>{{ $task->category->category_name }}</div></td>
                                        <td class="table-text"><div>{{ $task->shop }}</div></td>
                                        <td class="table-text"><div>{{ $task->price }}</div></td>
                                        <td class="table-text">
                                            <div class="text-center">
                                                <?php if ($task->completed){ ?><i class="fa fa-btn fa-check"></i><?php } ?>
                                            </div>
                                        </td>
                                        <!-- Task Edit Button -->
                                        <td class="table-text">
                                            <a href="{{ url('taskdetail/'.$task->id) }}">
                                                <button type="button" class="btn btn-info edit-btn">
                                                    <i class="fa fa-btn fa-edit"></i>Edit
                                                </button>
                                            </a>
                                        </td>
                                        <!-- Task Delete Button -->
                                        <td class="table-text">
                                            <form action="{{ url('task/'.$task->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit task</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-4">
                                <input type="text" name="name" id="task-name" class="form-control">
                            </div>
                        </div>

                        <!-- Category Name -->
                        <div class="form-group">
                            <label for="task-category" class="col-sm-3 control-label">Category</label>

                            <div class="col-sm-4">
                                <select class="form-control" name="category_id">
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        </div>

                        <!-- Shop Name -->
                        <div class="form-group">
                            <label for="task-shop" class="col-sm-3 control-label">Shop</label>

                            <div class="col-sm-4">
                                <input type="text" name="shop" id="task-shop" class="form-control">
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                            <label for="task-price" class="col-sm-3 control-label">Price</label>

                            <div class="col-sm-4">
                                <input type="text" name="price" id="task-price" class="form-control">
                            </div>
                        </div>


                        <!-- Task Completion -->
                        <div class="form-group">
                            <label for="task-price" class="col-sm-3 control-label">Completion</label>

                            <div class="col-sm-4">
                                <input style="margin-top:10px;" type="checkbox" aria-label="Completed" id="task-completed">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection