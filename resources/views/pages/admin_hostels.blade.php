@extends('layouts.app', [
'class' => '',
'elementActive' => 'admin_hostel'
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
          <h5 class="card-title">Manage Hostels</h5>
          <p class="card-category">create and edit hostels here</p>
        </div>
        <div class="card-body">
          <div class="row">

            <div class="col-md-6">
              <form method="POST" action="{{route('hostel.create')}}">
                @csrf
                <div class="form-group col-md-12">
                  <label for="hostel_name">Hostel Name</label>
                  <input type="text" class="form-control" id="hostel_name" name="hostel_name" placeholder="Name or title of hostel" required>
                </div>
                <div class="form-group col-md-12">
                  <label for="desc">Description</label>
                  <input type="text" class="form-control" id="desc" name="desc" placeholder="Short description">
                </div>

                <div class="form-group col-md-12">
                  <label for="gender">Gender</label>
                  <select id="gender" class="form-control" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female" selected>Female</option>
                    <option value="Co-ed">Co-ed</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-info">Create</button>
              </form>
            </div>



            <div class="col-md-6">
              @if(count($hostels) < 1) 
              <p>You have not created any hostels yet</p>
                @else
                @foreach($hostels as $hostel)
                <div class="card">
                  <a href="/admin_hostels/view/{{$hostel->id}}">
                    <div class="row m-1">
                      <div class="col-md-2"><i class="nc-icon nc-settings-gear-65"></i></div>
                      <div class="col-md-10">{{$hostel->name}}<br>
                        <small>{{$hostel->description}}</small>
                      </div>
                    </div>
                  </a>
                </div>
                @endforeach
                @endif
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection