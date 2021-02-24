@extends('layouts.app', [
'class' => '',
'elementActive' => 'admin_sessions'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- error bags -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!--  -->
            <div class="card demo-icons">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">Manage Sessions</h5>
                            <p class="card-category">Sessions allow students book rooms for a specific term or academic year</p>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-success float-right" data-toggle="modal" data-target="#addSession">Add Session</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" style="display: flex;">
                        <div class="col-6">
                            @if(count($sessions) > 0)
                            @foreach($sessions as $session)
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">{{$session->name}}
                                            @if($session->isActive())
                                            <i class="fas fa-toggle-on fa-lg pr-2 text-success"></i>
                                            @endif
                                        </h6>

                                        <div class="justify-content-between">
                                            <i data-target="#editSession{{$session->id}}" data-toggle="modal" class="fas fa-cog fa-lg p-2 text-primary"></i>
                                            <i data-toggle="modal" data-target="#deleteSession{{$session->id}}" class="fas fa-trash-alt fa-lg p-2 text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p>Starts: {{$session->start}}</p>
                                        <p>Ends: {{$session->end}}</p>
                                        <p>Bookable: {{$session->isbookable() ? 'Yes' : 'No'}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="text-center">You have not created any sessions yet.</div>
                            @endif
                        </div>

                        <div class=" card col-6">
                            <h6>Summary</h6>
                            <strong>
                               @if($active_session != null)
                               <p>Current session: {{$active_session->name}}</p>
                               @endif
                            </strong>
                            <p></p>
                        </div>
                        <div class="mx-auto">
                            {{ $sessions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- add modal -->
<div class="modal fade" id="addSession" tabindex="-1" aria-labelledby="addSessionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSessionLabel">Add a new school session</h5>
                <i class="nc-icon nc-simple-remove" data-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body">
                <form action="/admin_sessions/add" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-12">
                        <label for="session">Session</label> <small class="text-danger">required</small>
                        <input type="text" class="form-control" id="session" name="session" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="starts">Starts</label>
                        <input type="date" class="form-control" id="starts" name="starts">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="ends">Ends</label>
                        <input type="date" class="form-control" id="ends" name="ends">
                    </div>

                    <div class="form-group ml-3">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" name="bookable" type="checkbox" value="">
                                <span class="form-check-sign"></span>
                                Do you want to allow students book for this session yet? </label>
                        </div>
                    </div>

                    <div class="form-group ml-3">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" name="active" type="checkbox" value="">
                                <span class="form-check-sign"></span>
                                Do you want to make this the current active session? <br>
                                <small>Note: there can only be one active session.</small>
                            </label>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-info">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach($sessions as $session)
<!-- edit modal -->
<div class="modal fade" id="editSession{{$session->id}}" tabindex="-1" aria-labelledby="addSessionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSessionLabel">Edit {{$session->name}} session</h5>
                <i class="nc-icon nc-simple-remove" data-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body">
                <form action="/admin_sessions/edit/{{$session->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-12">
                        <label for="session">Session</label> <small class="text-danger">required</small>
                        <input type="text" class="form-control" id="session" name="session" value="{{$session->name}}" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="starts">Starts</label>
                        <input type="date" class="form-control" id="starts" name="starts" value="{{$session->start}}">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="ends">Ends</label>
                        <input type="date" class="form-control" id="ends" name="ends" value="{{$session->end}}">
                    </div>

                    <div class="form-group ml-3">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" name="bookable" type="checkbox" value="">
                                <span class="form-check-sign"></span>
                                Do you want to allow students book for this session yet? </label>
                        </div>
                    </div>

                    <div class="form-group ml-3">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" name="active" type="checkbox" value="">
                                <span class="form-check-sign"></span>
                                Do you want to make this the current active session? <br>
                                <small>Note: there can only be one active session.</small>
                            </label>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-info">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- delete modal -->
<div class="modal fade" id="deleteSession{{$session->id}}" tabindex="-1" aria-labelledby="deleteSessionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSessionLabel">Delete {{$session->name}} session</h5>
                <i class="nc-icon nc-simple-remove" data-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body text-center">
                <form action="/admin_sessions/delete/{{$session->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    Are you sure?<br>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection