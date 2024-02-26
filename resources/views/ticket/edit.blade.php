@extends('ticket.layout')
@section('content')
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-success">Message</h6>
<a href="{{route('home')}}" class="navbar-nav ml-auto">
  <span class="m-0 font-weight-bold text-primary navbar-nav ml-auto"><b>&larr; Back Home</b> </span>
</a>
</div>
<div class="card-body">
  <form action="{{route('ticket.update',$tickets->id)}}" method="post" enctype="multipart/form-data">
      @csrf
      @method('patch')
  <table class="table">
        @include('layouts.flash')
    <tbody>
       <tr>
           <td> <textarea class="form-control"  name="message" placeholder="Enter your message here" required rows="7">{{$tickets->message}}</textarea>
               <input class="mt-2" type="file" name="image"></td>
           <td><input type="submit" class="btn btn-success btn-sm" value="update"></td>
       </tr>
     </tbody>
     </table>
   </form>
</div>
</div>
@endsection
