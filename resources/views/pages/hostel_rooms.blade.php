@extends('layouts.app', [
'class' => '',
'elementActive' => 'hostel_rooms'
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
                    <h5 class="card-title">Book a room in {{$hostel->name}}</h5>
                    <p class="card-category">Only available rooms can be selected</p>
                </div>
                <div class="card-body">
                    <div id="row" style="display: flex;">
                        <div class="card col-6 pt-2 align-top" style="display: inline-block;" id="map">
                            <div class="text-center">
                                @if(count($rooms) > 0)
                                @foreach($rooms as $room)
                                @if($room->checkStatus() == 'Available')
                                <button class="btn btn-success" value="{{$room->id}}" onclick="selectRoom(this)">{{$room->name}}</button>
                                @elseif($room->checkStatus() == 'Booked')
                                <button class="btn btn-warning" value="{{$room->id}}" onclick="selectRoom(this)">{{$room->name}}</button>
                                @else
                                <button class="btn btn-danger" value="{{$room->id}}" disabled>{{$room->name}}</button>
                                @endif
                                @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="card col-4 ml-5" style="display: inline-block;" id="form">
                            <h6 class="pt-3">Booking Form</h6>
                            <form action="/book_room" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group col-md-12">
                                    <label for="room">Room chosen</label>
                                    <input type="number" class="form-control-plaintext" id="room" name="room" required readonly>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="session">Session</label>
                                    <select class="form-control" name="session" id="session" required>
                                        @if($sessions != null)
                                        @foreach($sessions as $session)
                                        <option value="{{$session->id}}">{{$session->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <!-- <input type="session" class="form-control-plaintext" id="session" name="session" required readonly> -->
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control-plaintext" id="price" name="price" required readonly>
                                </div>
                                <!-- hidden -->
                                <input type="number" class="form-control" id="room_id" name="room_id" required readonly hidden>

                                @if($sessions != null)
                                <button type="submit" class="btn btn-info ml-3">Book</button>
                                @else
                                <button type="button" class="btn btn-info ml-3" disabled>Book</button>
                                <br>
                                <small class="text-danger">There is no session to book for. Contact your administrator</small>
                                @endif
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    function selectRoom(obj) {
        var room = obj.value;

        $.ajax({
            type: "GET",
            url: "/room_data/get/" + room,
            dataType: 'JSON',
            success: function(data) {
                if (data != null) {
                    document.getElementById('room').value = data.name;
                    document.getElementById('price').value = data.price;
                    document.getElementById('room_id').value = data.id;
                    // console.log(data)
                } else {
                    alert('Invalid room select, try again');
                }
            },
            error: function(response) {
                alert("Something went wrong, try again");
            }

        });
    }
</script>