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
                        <h5 class="card-title">Manage Rooms</h5>
                        <p class="card-category">create and edit rooms here</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            
               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

