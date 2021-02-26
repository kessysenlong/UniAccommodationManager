@extends('layouts.app', [
'class' => '',
'elementActive' => 'my_bookings'
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
                    <h5 class="card-title">My Bookings</h5>
                    <p class="card-category">All accommodation bookings</p>
                </div>
                <div class="card-body text-center">
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
                <form action="/booking/cancel/{{$booking->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center">
                        To change rooms or hostel you must cancel this booking and re-book any available rooms.<p>
                        Continue?
                    </div>
                    <button type="submit" class="btn btn-info">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection