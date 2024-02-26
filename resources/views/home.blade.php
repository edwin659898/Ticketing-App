@extends('ticket.layout')

@section('content')
<h1 class="h3 mb-2 text-gray-800 text-success">My Tickets</h1>
@include('layouts.flash')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-success">Tickets Sent</h6>
    <a href="{{route('ticket.create')}}" class="navbar-nav ml-auto">
      <span class="m-0 font-weight-bold text-primary navbar-nav ml-auto"><b>Create New Ticket</b> </span>
    </a>
  </div>

  <div class="card-body">
    @if($tickets->count()==0)
    <center>
      <p>No tickets Available Kindly Create One</p>
    </center>
    @else
    <div class="table-responsive">
      <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead class="text-white" style="background-color:#007e33">
          <tr>
            <th>Date Created</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        @foreach($tickets as $t)
        <tr>
          <td>{{ $t->created_at }}</td>
          <td>{{ $t->subject }}</td>
          <td><a href="{{route('ticket.show',$t->id)}}">View</a></td>
          @if($t->sorted)
          <td>Sorted</td>
          @else
          <td>Pending</td>
          @endif
          <td>
            <a class="text-danger" onclick="return confirm('Are you sure?')" href="{{route('ticket.delete',$t->id)}}">
              <i class="fa fa-trash"></i>
            </a>
          </td>
        </tr>
        @endforeach
        </tbody>
      </table>
      @endif
    </div>
  </div>
</div>
@endsection