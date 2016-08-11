@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Category
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('category')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Category Name -->
                        <div class="form-group">
                            <label for="task-category" class="col-sm-3 control-label">Category</label>

                            <div class="col-sm-6">
                                <input type="text" name="category_name" id="task-category" class="form-control" value="{{ old('category') }}">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Category
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Categories -->
            @if (count($categories) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Categories
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Category</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="table-text"><div> {{ $category->category_name }} </div></td>
                                        <!-- Category Delete Button -->
                                        <td>
                                            <form action="{{ url('category/'.$category->id) }}" method="POST">
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
@endsection