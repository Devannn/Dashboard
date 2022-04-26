@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card top-nav-card">
                    <div class="card-body">
                        <a class="top-nav-card-a-hover" href="{{ url('/home') }}">{{ __('Dashboard') }}</a>
                        <a class="top-nav-card-a-normal">{{ __(' / Extra Pages / ') }}</a>
                        <a class="top-nav-card-a-bold" href="{{ url('/to-do') }}">{{ __('To-Do List') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-2"></div>
        <div class="row justify-content-center">
            {{-- To-Do List Column --}}
            <div class="col-sm-8">
                {{-- New Task Container --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-new-task">{{ __('New Task') }}</div>
                        <div class="card-body card-body-new-task">
                            <!-- New Task Form -->
                            <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="row justify-content-center p-7">
                                    <div class="col-sm-4">
                                        <!-- Task Title -->
                                        <div class="form-group col-sm-12">
                                            <label for="task-name" class="col-sm-3 control-label">Title</label>
                                            <div class="col-sm">
                                                <input type="text" name="title" id="task-title" class="form-control"
                                                    value="{{ old('title') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <!-- Task Body -->
                                        <div class="form-group col-sm-12">
                                            <label for="task-name" class="col-sm-3 control-label">Task</label>
                                            <div class="col-sm">
                                                <input type="text" name="task" id="task-body" class="form-control"
                                                    value="{{ old('task') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add Task Button -->
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-6">
                                            <button type="submit" class="btn btn-primary" style="margin-top:1rem">
                                                <i class="fa fa-btn fa-plus"></i>Add Task
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="py-2"></div>
                {{-- Current Task Container --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('Current Tasks') }}</div>
                        <div class="card-body all-tasks-body">
                            <div class="panel-body">
                                <table class="table task-table card-table-all-tasks">
                                    <thead>
                                        <th>Title</th>
                                        <th>Task</th>
                                        <th>&nbsp;</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td class="table-text">
                                                    <div>{{ $task->title }}</div>
                                                </td>
                                                <td class="table-text">
                                                    <div>{{ $task->task }}</div>
                                                </td>
                                                <!-- Task Delete Button -->
                                                <td>
                                                    <form action="{{ url('task/' . $task->id) }}" method="POST"
                                                        class="">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" id="delete-task-{{ $task->id }}"
                                                            class="btn btn-danger btn-delete-task">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
