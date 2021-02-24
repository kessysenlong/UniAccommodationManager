@extends('layouts.app', [
'class' => '',
'elementActive' => 'book_room'
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
                    <h5 class="card-title">Book a room</h5>
                    <p class="card-category">Reserve and pay for your room ahead of the semester</p>
                </div>
                <div class="card-body">
                    <div id="row">
                        <div class="col-md-6">
                        @if(count($hostels) > 0)
                        @foreach($hostels as $hostel)
                        <a href="/hostel/{{$hostel->id}}">
                        <div class="card text-center">
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">{{$hostel->name}}</h6>
                                        <small> {{$hostel->spacesLeft()}} spaces left</small>
                                    </div>
                                    <p class="text-left">{{$hostel->description}}</p>
                                </div>
                            </div>
                        </div>
                        </a>
                        @endforeach
                        @else
                        Hostels have not been created, contact your administrator.
                        @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection