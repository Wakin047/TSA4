<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Task completed</h1>
    <p>The following task was marked as done:</p>
    <h2>{{ $task->title }}</h2>
    @if ($task->description)
        <p>{{ $task->description }}</p>
    @endif
    @if ($task->due_date)
        <p>Due date: {{ $task->due_date->format('F j, Y') }}</p>
    @endif
</body>
</html>
