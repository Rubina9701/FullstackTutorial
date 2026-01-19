@extends('layouts.master')

@section('content')
<a href="index.php?action=create">Add Student</a>

<table border="1" cellpadding="5">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Actions</th>
    </tr>

    @foreach($students as $student)
    <tr>
        <td>{{ $student['name'] }}</td>
        <td>{{ $student['email'] }}</td>
        <td>{{ $student['course'] }}</td>
        <td>
            <a href="index.php?action=edit&id={{ $student['id'] }}">Edit</a>
            <a href="index.php?action=delete&id={{ $student['id'] }}">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
