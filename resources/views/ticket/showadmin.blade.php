@extends('ticket.layout')
@section('content')
@include('layouts.flash')
@if($tickets->sorted)
<p><span class="text-success" role="button" onclick="event.preventDefault();document.getElementById('form-incomplete-{{$tickets->id}}').submit()">Status: Closed</span></p>
<form style="hidden" method="post" id="{{'form-incomplete-'.$tickets->id}}" action="{{route('ticket.incomplete1',$tickets->id)}}">
  @csrf
  @method('patch')
</form>

@else

<td><span class="text-primary" type="button" onclick="event.preventDefault();document.getElementById('form-complete-{{$tickets->id}}').submit()">Status: Open</span></td>
<form style="hidden" method="post" id="{{'form-complete-'.$tickets->id}}" action="{{route('ticket.complete1',$tickets->id)}}">
  @csrf
  @method('patch')
</form>
@endif
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-success">Message</h6>
    <a href="{{route('ticket.admin')}}" class="navbar-nav ml-auto">
      <span class="m-0 font-weight-bold text-primary navbar-nav ml-auto"><b>&larr; Go back</b> </span>
    </a>
  </div>
  <div class="card-body">
    <form action="{{route('ticket.comment',$tickets->id)}}" method="post" enctype="multipart/form-data">
      @csrf
      @method('patch')
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <tbody>
          <tr>
            <td class="text-danger">{{ $tickets->message }}</td>
            @if($tickets->image)
            <td><a href="{{route('ticket.file',$tickets->id)}}" target="_blank">Image</a></td>
            @else
            <td></td>
            @endif
          </tr>
          <tr>
            <td> <textarea class="form-control" name="comments" placeholder="Enter your message here" rows="7" id="editor">{{$tickets->comments}}</textarea></td>
            <td><input type="submit" class="btn btn-success btn-sm" value="Comment"></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  ClassicEditor
    .create(document.querySelector('#editor'))
    .catch(error => {
      console.error(error);
    });
</script>
@endsection