@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'admin_incidents'
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
                        <h5 class="card-title">Manage Incidents</h5>
                        <p class="card-category">Manage hostel incidents</p>
                    </div>
                    <div class="card-body">
                        <div id="icons-wrapper">
                            
               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

