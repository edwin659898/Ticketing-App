@extends('ticket.layout')

@section('content')
<h1 class="h3 mb-2 text-gray-800 text-success">Manage Tickets</h1>
@include('layouts.flash')
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-success">Tickets Received</h6>
<a href="{{route('ticket.create')}}" class="navbar-nav ml-auto">
  <span class="m-0 font-weight-bold text-primary navbar-nav ml-auto"><b>Create New Ticket</b> </span>
</a>
</div>

<div class="card-body">
  @if($tickets->count()==0)
  <center><p>No tickets Received</p></center>
  @else
<div class="table-responsive">
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
 <thead class="text-white" style="background-color:#007e33">
   <tr>
     <th>Date Created</th>
     <th>From</th>
     <th>Site</th>
     <th>Subject</th>
     <th>Message</th>
     <th>Status</th>
   </tr>
 </thead>
        @foreach($tickets as $t)
           <tr>
              <td data-order='desc'>{{ $t->created_at }}</td>
              <td>{{ $t->owner->name }}</td>
              <td>{{ $t->owner->site }}</td>
              <td>{{ $t->subject }}</td>
              <td><a href="{{route('ticket.showadmin',$t->id)}}">View</a></td>
              @if($t->sorted)
             <td><span type="button" onclick="event.preventDefault();document.getElementById('form-incomplete-{{$t->id}}').submit()">Sorted</span></td>
              <form style="hidden" method="post" id="{{'form-incomplete-'.$t->id}}"action="{{route('ticket.incomplete1',$t->id)}}">
                @csrf
                @method('patch')
              </form>

              @else

              <td><span type="button" onclick="event.preventDefault();document.getElementById('form-complete-{{$t->id}}').submit()">Pending</span></td>
              <form style="hidden" method="post" id="{{'form-complete-'.$t->id}}"action="{{route('ticket.complete1',$t->id)}}">
                @csrf
                @method('patch')
              </form>
              @endif
           </tr>
           @endforeach
 </tbody>
</table>
@endif
</div>
</div>
</div>
@endsection
