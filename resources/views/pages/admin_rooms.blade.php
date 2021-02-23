@extends('layouts.app', [
'class' => '',
'elementActive' => 'admin_rooms'
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
                    <h5 class="card-title">Manage Rooms</h5>
                    <p class="card-category">create and edit rooms here</p>
                </div>
                <div class="card-body">
                    @if(count($rooms) > 0)
                    <table id="roomsTable" class="display mx-auto" style="width: 100;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Room no.</th>
                                <th>Hostel</th>
                                <th>Space</th>
                                <th>Occupancy</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                            <tr>
                                <td><input type="checkbox" name="checkRoom[]" id="checkRoom"></td>
                                <td>{{$room->name}}</td>
                                <td>{{$room->hostel}}</td>
                                <td>{{$room->beds}}</td>
                                <td>{{$room->occupancy}}</td>
                                <td>{{$room->status}}</td>
                                <td>{{$room->price}}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editRoom{{$room->id}}"><i class="fas fa-cog"></i></button>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#messageRoom{{$room->id}}"><i class="fas fa-envelope"></i></button>
                                    <button class="btn btn-delete btn-sm" data-toggle="modal" data-target="#deleteRoom{{$room->id}}"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div id="check_counter" hidden></div>
                    @else
                    <div class="text-center">You have not created any rooms yet.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @foreach($rooms as $room)
    <!--edit modal -->
    <div class="modal fade" id="editRoom{{$room->id}}" tabindex="-1" aria-labelledby="editRoomLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoomLabel">Edit {{$room->name}} of {{$room->hostel}}</h5>
                    <i class="nc-icon nc-simple-remove" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <form action="/admin_room/edit/{{$room->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-12">
                            <label for="room_name">Room No.</label>
                            <input type="text" class="form-control" id="room_name" name="room_name" value="{{$room->name}}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="hostel">Hostel</label>
                            <select id="hostel" class="form-control" name="hostel" required>
                                @if(count($hostels) > 0)
                                @foreach($hostels as $hostel)
                                <option value="{{$hostel->id}}">{{$hostel->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="beds">Space</label>
                            <input type="number" class="form-control" id="beds" name="beds" value="{{$room->beds}}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="price">Price (₦)</label>
                            <input type="number" class="form-control currency" min="0.01" max="1000000.00" step="0.01" id="price" name="price" value="{{$room->price}}">
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
    <div class="modal fade" id="messageRoom{{$room->id}}" tabindex="-1" aria-labelledby="messageRoomLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageRoomLabel">Send message to {{$room->name}} of {{$room->hostel}}</h5>
                    <i class="nc-icon nc-simple-remove" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        Are you sure?
                        <p>This will delete all the rooms in this hostel as well.</p>
                    </div>
                    <a href="/admin_hostels/delete/{id}"><button type="button" class="btn btn-danger">Delete</button></a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- delete modal -->
    <div class="modal fade" id="deleteRoom{{$room->id}}" tabindex="-1" aria-labelledby="deleteRoomLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRoomLabel">Delete {{$room->name}} of {{$room->hostel}}</h5>
                    <i class="nc-icon nc-simple-remove" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        Are you sure?
                    </div>
                    <form action="/admin_room/delete/{{$room->id}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    @endforeach
</div>
@endsection