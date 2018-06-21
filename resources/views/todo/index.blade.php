<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index Page </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>  
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>

    <div class="container">
      
      <div style="display: flex; justify-content: flex-end; margin-top: 15px;">
            <a class="btn btn-success" href="{{action('TodoController@create') }}">
                <i class="fa fa-aw fa-plus"></i> 
                Add New Data </a>
          
      </div>

    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Date</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Passport Office</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($todos as $todo)
      @php
        $date=date('Y-m-d', $todo['date']);
        @endphp
      <tr>
        <td>{{$todo['id']}}</td>
        <td>{{$todo['name']}}</td>
        <td>{{$date}}</td>
        <td>{{$todo['email']}}</td>
        <td>{{$todo['number']}}</td>
        <td>{{$todo['office']}}</td>
        
        <td><a href="{{action('TodoController@edit', $todo['id'])}}" class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{action('TodoController@destroy', $todo['id'])}}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
  

