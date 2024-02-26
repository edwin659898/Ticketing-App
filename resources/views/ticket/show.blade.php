@extends('ticket.layout')
@section('content')
@include('layouts.flash')
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-success">Your Message</h6>
<a href="{{route('home')}}" class="navbar-nav ml-auto">
  <span class="m-0 font-weight-bold text-primary navbar-nav ml-auto"><b>&larr; Go back</b> </span>
</a>
</div>
<div class="card-body">
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <td>{{ $tickets->message }}</td>
                @if($tickets->image)
                <td><a href="{{route('ticket.file',$tickets->id)}}">Image</a></td>
                @endif
                <td><a href="{{route('ticket.edit',$tickets->id)}}">Edit</a></td>
   </tbody>
  </table>
</div>
</div>
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Admin Comments</h6>
</div>
<div class="card-body">
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <td>{!! $tickets->comments !!}</td>
   </tbody>
  </table>
</div>
</div>
@endsection
