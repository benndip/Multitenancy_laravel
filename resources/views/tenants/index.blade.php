@extends('main') 

@section('title', '| All Posts')
    
{{-- @endsection --}}

@section('content') 

    <div class="row mt-5">
        <div class="col-md-10">
          <h1>  All Posts </h1>  
        </div>

        <div class="col-md-2">
            <a href=" {{route('posts.create')}}" class="btn btn-primary btn-block btn-h1-spacing p-3"> Create New Post </a>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <hr>
    </div>

    <table  class="table table-striped">
        <thead class="thead-dark">
          <tr>
                    <th scope="col">id</th>
                    <th>name</th>
                    <th>url</th>

          </tr>
        </thead>
        <tbody>
            
        </tbody>
      </table>
      

@endsection