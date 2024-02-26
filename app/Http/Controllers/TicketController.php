<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreBlogPost;
use App\Mail\AdminResponse;
use App\ticket;
use Illuminate\Support\Facades\Mail;


class TicketController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'verified']);
  }

  public function create()
  {
    return view('ticket.create');
  }

  public function store(StoreBlogPost $request)
  {

    $tickets = auth()->user()->ticket()->Create(['subject' => $request->subject, 'message' => $request->message]);

    if ($request->hasFile('image')) {
      $filename = $request->image->getClientOriginalName();
      $path = $request->image->storeAs('public/images/', $filename);
      $tickets->update(['image' => $filename]);
    }

    $data = [
      'title' => 'New Ticket',
      'content' => 'New ticket in ticketing system'
    ];
    mail::send('ticket.mail', $data, function ($message) {
      $message->to('liazurah@betterglobeforestry.com', 'Alex')->subject('New Ticket');
    });
    return redirect('tickets/create')->with('message', 'Ticket Created Successfully');
  }

  public function show($id)
  {
    $tickets = ticket::find($id);
    return view('ticket/show')->with(['tickets' => $tickets]);
  }

  public function file($id)
  {
    $tickets = ticket::find($id);
    $filename = $tickets->image;
    $path = storage_path('app/public/images/' . $filename);
    return response()->file($path);
  }



  public function edit($id)
  {
    $tickets = ticket::find($id);
    return view('ticket.edit')->with(['tickets' => $tickets]);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'message' => 'required'
    ]);
    $tickets = ticket::find($id);
    $tickets->update(['message' => $request->message]);

    if ($request->hasFile('image')) {
      $filename = $request->image->getClientOriginalName();
      $path = $request->image->storeAs('public/images/', $filename);
      $tickets->update(['image' => $filename]);
    }

    return redirect('home')->with('message', ' Ticket updated Successfully');
  }


  public function admin()
  {
    abort_if(!auth()->user()->admin,403);
    $tickets = ticket::orderBy('tickets.created_at', 'DESC')->get();
    return view('ticket/admin')->with(['tickets' => $tickets]);
  }

  public function report()
  {
    abort_if(!auth()->user()->admin,403);
    $tickets = Ticket::where('sorted', false)
      ->orderBy('tickets.created_at', 'DESC')
      ->get();
    return view('ticket/report')->with(['tickets' => $tickets]);
  }

  public function showadmin($id)
  {
    $tickets = ticket::find($id);
    return view('ticket/showadmin')->with(['tickets' => $tickets]);
  }

  public function comment(Request $request, $id)
  {
    $ticket = ticket::find($id);
    $user = User::where('id',$ticket->user_id)->first();
    $ticket->update(['comments' => $request->comments]);
    Mail::to($user->email)->send(new AdminResponse($ticket, $request->comments, auth()->user()));
    return redirect()->back()->with('message', ' Ticket commented Successfully');
  }

  public function users()
  {
    abort_if(!auth()->user()->admin,403);
    $tickets = User::get();
    return view('ticket/users')->with(['tickets' => $tickets]);
  }

  public function complete(Request $request, $id)
  {
    $tickets = User::find($id);
    $tickets->update(['admin' => true]);
    return redirect('tickets/users')->with('message', 'Successfully upgraded to Admin');
  }

  public function incomplete(Request $request, $id)
  {
    $tickets = User::find($id);
    $tickets->update(['admin' => false]);
    return redirect('tickets/users')->with('message', 'Successfully Downgraded User');
  }


  public function close(Request $request, $id)
  {
    $tickets = ticket::find($id);
    $tickets->update(['sorted' => true]);
    return redirect('tickets/report')->with('message', 'Ticket closed');
  }

  public function complete1(Request $request, $id)
  {
    $tickets = ticket::find($id);
    $tickets->update(['sorted' => true]);
    return redirect('tickets/admin')->with('message', 'Ticket closed');
  }

  public function incomplete1(Request $request, $id)
  {
    $tickets = ticket::find($id);
    $tickets->update(['sorted' => false]);
    return redirect('tickets/admin')->with('message', 'ticket Reopened');
  }

  public function dashboard()
  {
    abort_if(!auth()->user()->admin,403);
    $user = User::get();
    $received = ticket::get();
    $tickets = ticket::where('sorted', true)->get();
    $ticket = ticket::where('sorted', false)->get();
    return view('ticket/dashboard')->with(['tickets' => $tickets, 'ticket' => $ticket, 'user' => $user, 'received' => $received]);
  }

  public function destroy(Ticket $ticket)
  {

    abort_if(!$ticket->sorted, 403, 'Cannot delete untill processed and closed');
    $ticket->delete();
    return back()->with('message', 'Deleted Successfully');
  }
}
