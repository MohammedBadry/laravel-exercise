
<a href="{{ url('/tasks/'.$id.'/edit')}}" class="text-primary">Edit</a>

<form method="post" action="{{route('tasks.destroy', $id)}}" 
	style="float: right;"
	onSubmit="alert('Are you sure you wish to delete?');">
	@csrf
	@method('DELETE')
	<button type="submit" class="text-danger">Delete</button>
</form>
