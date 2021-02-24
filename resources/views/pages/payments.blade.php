@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'payments'
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
                        <h5 class="card-title">My payments</h5>
                        <p class="card-category">Manage your hostel payments here</p>
                    </div>
                    <div class="card-body text-center">  
                        <h2>Coming Soon!</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

