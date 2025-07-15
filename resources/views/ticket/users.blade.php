@extends('ticket.layout')

@section('content')
<h1 class="h3 mb-2 text-gray-800 text-success">Manage Users</h1>
@include('layouts.flash')
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-success">Amend User Rights</h6>
</div>

<div class="card-body">
  @if($tickets->count()==0)
  <center><p>No tickets Received</p></center>
  @else
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
 <thead class="text-success">
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Rights</th>
    <th>Make admin</th>
  </tr>
 </thead>
 <tbody>
      @foreach($tickets->sortBy('name') as $t)
        <tr>
          <td>{{ $t->name }}</td>
          <td>{{ $t->email }}</td>
          @if($t->admin)
          <td>Admin</td>
          @else
          <td>user</td>
          @endif
          @if($t->admin)
          <td><span role="button" onclick="event.preventDefault();document.getElementById('form-incomplete-{{$t->id}}').submit()">&#10003;</span></td>
          <form style="hidden" method="post" id="{{'form-incomplete-'.$t->id}}"action="{{route('ticket.incomplete',$t->id)}}">
           @csrf
           @method('patch')
          </form>

          @else

          <td><span role="button" onclick="event.preventDefault();document.getElementById('form-complete-{{$t->id}}').submit()">&#10007;</span></td>
          <form style="hidden" method="post" id="{{'form-complete-'.$t->id}}"action="{{route('ticket.complete',$t->id)}}">
           @csrf
           @method('patch')
          </form>
          @endif
        </tr>
        @endforeach
 </tbody>
</table>
 <div>{{$tickets->links()}}</div>
@endif
</div>
</div>
</div>
@endsection
