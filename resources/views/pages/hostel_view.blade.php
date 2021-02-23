@extends('layouts.app', [
'class' => '',
'elementActive' => 'hostel_view'
])

<style>
    .currency {
        padding-left: 20px;
    }

    /* .currency-symbol {
  position:absolute;
  padding: 2px 5px;
  margin-right: 10px;
} */
</style>

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
                    <h5 class="card-title ml-3"><i class="fas fa-door-open"></i>  {{$hostel->name}}</h5>
                    <div class="row col-md-12">
                        <div class="col-md-6 text-left">
                            <p class="card-category mb-0">Manage this hostel</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editHostel">Edit</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteHostel">Delete</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-8 border-right">
                            <form method="POST" action="/create_room/{{$hostel->id}}" enctype="multipart/form-data">

                                @csrf
                                <div class="form-group col-md-12">
                                    <label for="room_quantity">How many rooms?</label>
                                    <input type="number" class="form-control" id="room_quantity" name="room_quantity" placeholder="Number of rooms to create" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="first_room">The first room number is?</label>
                                    <input type="number" class="form-control" id="first_room" name="first_room" placeholder="e.g. 106" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="occupancy">How many people per room?</label>
                                    <input type="number" class="form-control" id="occupancy" name="occupancy" placeholder="e.g. 2" required>
                                </div>
                                <div class="form-row col-md-12">
                                    <div class="form-group col-md-6">
                                        <label for="gender">Status</label>
                                        <select id="status" class="form-control" name="status" required>
                                            <option value="Available" selected>Available</option>
                                            <option value="Booked">Booked</option>
                                            <option value="Unavailable">Unavailable</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="price">Price (₦)</label>
                                        <input type="number" class="form-control currency" min="0.01" max="1000000.00" id="price" name="price" step="0.01" placeholder="e.g. 50000.00">
                                        <small>This is price per occupant</small>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-info">Create</button>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <Strong>SUMMARY</Strong>
                            <dl class="row mt-3">
                                <dt class="col-sm-9">Total rooms</dt>
                                <dd class="col-sm-3">{{count($rooms) == null ? 0 : count($rooms)}}</dd>

                                <dt class="col-sm-9">Total occupancy</dt>
                                <dd class="col-sm-3">{{$occupancy != null ? $occupancy : 0}}</dd>

                                <dt class="col-sm-9">Occupancy rate</dt>
                                <dd class="col-sm-3">0</dd>

                                <dt class="col-sm-9">Student satisfaction</dt>
                                <dd class="col-sm-3">0</dd>

                                <dt class="col-sm-9">Incidents reported</dt>
                                <dd class="col-sm-3">0</dd>
                            </dl>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editHostel" tabindex="-1" aria-labelledby="editHostelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editHostelLabel">Edit {{$hostel->name}}</h5>
                    <i class="nc-icon nc-simple-remove" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <form action="/admin_hostels/edit/{{$hostel->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-12">
                            <label for="hostel_name">Hostel Name</label>
                            <input type="text" class="form-control" id="hostel_name" name="hostel_name" value="{{$hostel->name}}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="desc">Description</label>
                            <input type="text" class="form-control" id="desc" name="desc" value="{{$hostel->description}}">
                        </div>


                        <div class="form-group col-md-12">
                            <label for="gender">Gender</label>
                            <select id="gender" class="form-control" name="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female" selected>Female</option>
                                <option value="Co-ed">Co-ed</option>
                            </select>
                        </div>


                        <button type="submit" class="btn btn-info">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteHostel" tabindex="-1" aria-labelledby="deleteHostelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteHostelLabel">Delete {{$hostel->name}}</h5>
                    <i class="nc-icon nc-simple-remove" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        Are you sure?
                        <p>This will delete all the rooms in this hostel as well.</p>
                    </div>
                    <form action="/admin_hostels/delete/{{$hostel->id}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>

</div>

</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>