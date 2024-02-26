<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

  <div class="container">
    <h2 class="text-success">Pending Tickets</h2>
    <a href="{{route('ticket.admin')}}">
      <span class="m-0 font-weight-bold text-primary"><b>&larr; Go back</b> </span>
    </a>
    @include('layouts.flash')
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Date Created</th>
            <th>From</th>
            <th>Site</th>
            <th>Message</th>
            <th>Admin Comments</th>
          </tr>
        </thead>
        <tbody>
          @if($tickets->count('sorted')==0)
          <tr>
            <td>
              <p>No Pending Tickets</p>
            </td>
          </tr>
          @else
          @foreach($tickets as $t)
          <tr>
            <td>{{ $t->created_at }}</td>
            <td>{{ $t->owner->name }}</td>
            <td>{{ $t->owner->site }}</td>
            <td>{{ $t->message }}</td>
            <td>{!! $t->comments !!}</td>
            <td><span role="button" onclick="event.preventDefault();document.getElementById('form-complete-{{$t->id}}').submit()">Close</span></td>
            <form style="hidden" method="post" id="{{'form-complete-'.$t->id}}" action="{{route('ticket.close',$t->id)}}">
              @csrf
              @method('patch')
            </form>
          </tr>
          @endforeach
          @endif

        </tbody>
      </table>
    </div>
  </div>

</body>

</html>