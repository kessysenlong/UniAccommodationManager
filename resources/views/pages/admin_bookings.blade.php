@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'admin_bookings'
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
                        <h5 class="card-title">Manage Bookings</h5>
                        <p class="card-category">Manage accommodation bookings</p>
                    </div>
                    <div class="card-body">
                    <div class="card-body">
                    @if(count($bookings) > 0)
                    <table id="bookingsTable" class="display mx-auto" style="width: 100;">
                        <thead>
                            <tr>
                                <th>Ref. no</th>
                                <th>Student</th>
                                <th>ID</th>
                                <th>Room</th>
                                <th>Hostel</th>
                                <th>Session</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{$booking->ref}}</td>
                                <td>{{$booking->student_name}}</td>
                                <td>{{$booking->studentID}}</td>
                                <td>{{$booking->room_name}}</td>
                                <td>{{$booking->hostel}}</td>
                                <td>{{$booking->session_name}}</td>
                                <td>{{$booking->amount}}</td>
                                <td>{{$booking->status}}</td>
                                <td>{{$booking->created_at->format('d-m-y')}}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editbooking{{$booking->id}}"><i class="fas fa-cog"></i></button>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#messagebooking{{$booking->id}}"><i class="fas fa-envelope"></i></button>
                                    <!-- <button class="btn btn-delete btn-sm" data-toggle="modal" data-target="#deletebooking{{$booking->id}}"><i class="fas fa-trash-alt"></i></button> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div id="check_counter" hidden></div>
                    @else
                    <div class="text-center">You have not created any bookings yet.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @foreach($bookings as $booking)
    <!--edit modal -->
    <div class="modal fade" id="editbooking{{$booking->id}}" tabindex="-1" aria-labelledby="editbookingLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editbookingLabel">Edit {{$booking->ref}}</h5>
                    <i class="nc-icon nc-simple-remove" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <form action="/admin_booking/edit/{{$booking->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-12">
                            <label for="booking_name">booking No.</label>
                            <input type="text" class="form-control" id="booking_name" name="booking_name" value="{{$booking->ref}}" required>
                        </div>
                       
                        <div class="form-group col-md-12">
                            <label for="beds">Space</label>
                            <input type="number" class="form-control" id="beds" name="beds" value="{{$booking->ref}}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="price">Price (₦)</label>
                            <input type="number" class="form-control currency" min="0.01" max="1000000.00" step="0.01" id="price" name="price" value="{{$booking->ref}}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="status">Status</label>
                            <select id="status" class="form-control" name="status" required>
                                <option value="Available" selected>Available</option>
                                <option value="Booked">Booked</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- message modal -->
    <div class="modal fade" id="messagebooking{{$booking->id}}" tabindex="-1" aria-labelledby="messagebookingLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messagebookingLabel">Send message to of </h5>
                    <i class="nc-icon nc-simple-remove" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        Are you sure?
                        <p>This will delete all the bookings in this hostel as well.</p>
                    </div>
                    <a href="/admin_bookings/delete/"><button type="button" class="btn btn-danger">Delete</button></a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
  
    @endforeach
</div>
@endsection