@extends('ticket.layout')

@section('content')
<div class="container-fluid">

          <!-- Page Heading -->
          <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                          @include('layouts.flash')
                            <center><h3 class="panel-title text-mb-1 text-primary">New ticket</h3></center>
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="{{route('ticket.store')}}" enctype="multipart/form-data">
                              @csrf
                                <fieldset>
									<div style = "font-size:11px; color:#cc0000; margin-top:10px"></div>
									            <div class="form-group">
                                        <input class="form-control" placeholder="subject" name="subject" type="text"  required  autofocus>
                                    </div>
                                    <div class="form-group">
                                         <textarea class="form-control"  name="message" placeholder="Enter your message here" required rows="7"></textarea>
                                    </div>
                                       <div class="form-group">
                                            <input type="file" name="image">
                                       </div>
                                    <div class="row">
                                      <div class="col-md-8 order-md-6">
          	                             <input type="submit" class="btn btn-primary btn-sm" value="submit">
                                            </div>
                                              <div class="col-md-4 order-md-6">
                                                <a href="{{route('home')}}">My Tickets</a>
                                            </div>
                                          </div>
                                </fieldset>
                            </form>

                         </div>
						           </div>
                    </div>
                </div>
            </div>

        </div>
@endsection
