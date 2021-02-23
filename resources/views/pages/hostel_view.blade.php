@extends('layouts.app', [
'class' => '',
'elementActive' => 'hostel_view'
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
                    <h5 class="card-title">{{$hostel->name}}</h5>
                    <p class="card-category">Manage this hostel</p>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-8 border-right">
                            <form method="POST" action="/create_room/{{$hostel->id}}">
                            
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
                                <div class="form-group col-md-12">
                                    <label for="price">Price (N)</label>
                                    <input type="number" class="form-control" id="price" name="price" placeholder="e.g. 15000">
                                    <small>This is price per occupant</small>
                                </div>
                                
                                <button type="submit" class="btn btn-info">Create</button>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <p>Total occupancy: {{$occupancy != null ? $occupancy : 0}}</p>
                            <p>Total rooms: {{count($rooms) == null ? 0 : count($rooms)}}</p>
                            <p>Occupancy rate: </p>
                            <p>Student satisfaction: </p>
                            <p>Incidents reported: </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection