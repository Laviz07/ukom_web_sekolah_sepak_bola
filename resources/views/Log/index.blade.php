@extends('layouts.layout')
@section('title', 'Log Aktifitas')

@section('content')
<div class="container mt-4 mb-4">

    <div class="card align-items-center" style="border: 2px solid #00171F;">
        <div class="card-body">
            <span class="h3 text-uppercase "> <strong>Log Aktifitas</strong></span>
        </div>
    </div>

    <div class="mt-3">
        <table class="table table-hovered table-bordered DataTable">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Host</th>
                <th>Action</th>
                <th>Log</th>
                <th>Created At</th>
              </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
            ?>
            @foreach($logs as $log)
  
            <tr idUS="{{$log->id}}" >
                <td class="col-1" style=" width: 50px; text-align:center;">{{$no++}}</td>
                <td class="col-1">{{$log->username}}</td>
                <td class="col-1">{{$log->host}}</td>
                <td class="col-1">{{$log->action}}</td>
                <td class="col-6">{{$log->log}}</td>
                <td class="col-2">{{$log->created_at}}</td>
              
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection
@section('footer')
    <script type="module">
         $('.DataTable').DataTable();
    </script>
@endsection