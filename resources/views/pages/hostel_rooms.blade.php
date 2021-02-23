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
                                <button class="btn btn-success" value="{{$room->id}}" onclick="selectRoom(this)">{{$room->name}}</button>
                                @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="card col-4 ml-5" style="display: inline-block;" id="form">
                            <h6 class="pt-3">Booking Form</h6>
                            <form action="" method="post">
                                @csrf
                                <div class="form-group col-md-12">
                                    <label for="room">Room chosen</label>
                                    <input type="number" class="form-control" id="room" name="room" required readonly>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label for="session">Session</label>
                                    <input type="session" class="form-control" id="session" name="session" required readonly>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" required readonly>
                                </div>
                                <!-- hidden -->
                                <input type="number" class="form-control" id="room_id" name="room_id" required readonly hidden>


                                <button type="submit" class="btn btn-info ml-3">Book</button>
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
            url: "/room_data/get/"+room,
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