<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tasks

            <a style="float: right;" href="{{route('tasks.create')}}" class="btn btn-primary">Create Task</a>            
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <th scope="row">{{$task->id}}</th>
                                        <td>{{$task->name}}</td>
                                        <td>{{$task->start_date}}</td>
                                        <td>{{$task->end_date}}</td>
                                        <td>{{$task->created_at}}</td>
                                        <td>
                                            <a href="{{ route('tasks.edit', $task->id)}}" class="text-primary">Edit</a>

                                            <form method="post" action="{{route('tasks.destroy', $task->id)}}" 
                                                style="float: right;"
                                                onSubmit="alert('Are you sure you wish to delete?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger">Delete</button>
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
    
</x-app-layout>
