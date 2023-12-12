@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                   <a href="{{route('createage')}}" class="btn btn-primary" style="margin-left: 85%;margin-bottom: 10px;">Add Age</a>
           
           
            <table class="table table-bordered">
         <thead>
      <tr>
        <th>Sr.No.</th>
        <th>User Group</th>
        <th>Age Group</th>
        <th>Operation</th>
       </tr>
    </thead>
    <?php $i=1 ; ?>
    <tbody>
   @foreach($age as $row)
      <tr>
       <td>{{$i++}}</td>
       <td>{{$row->usergroup}}</td>
       <td>{{$row->age}}</td>
       
        <td><a href="{{ route('age.edit',$row->id) }}" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
            <a href="{{route('age.delete',$row->id)}}" class="btn btn-info btn-circle"><i class="fa fa-trash-o"></i></button></td>
     
     </tr>
@endforeach
    </tbody>
  </table>
        </div>
    </div>
</div>
@endsection
