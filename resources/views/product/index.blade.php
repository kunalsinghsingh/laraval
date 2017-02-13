@extends('layouts.master')
@section('content')
<div class="container">
<div class="row">

  <div class="col-md-6">
    <form class="form-inline" action="{{route('product.details')}}">

       
            <div class="form-group">
                <input type="text" class="form-control Nform" name='name' value="{{isset($_GET['name'])?$_GET['name']:''}}" placeholder="product name">
            </div>

            <button type="submit" class="btn btn-info form-control " md-ink-ripple="">Submit<div class="md-ripple-container"></div></button>
            <a href="" class="btn btn-info form-control " md-ink-ripple="">Reset</a>
           
       
       <a href="{{route('product.product')}}" class="btn btn-primary pull-right col-md-2" >Add New File</a>  
    </form>
</div>

</div>  
 
 </div>
 <h1>Product Management</h1>
<table class="table table-striped table-bordered">
    <thead>
    
        
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Details</th>
        <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{$product->id}}</td>  
            <td>{{$product->name}}</td>
            <td>{{$product->details}}</td>
            <td>
             <a href="{{URL::route('edit')}}/{{$product -> id}}" class="label label-primary active" ui-toggle-class="">Edit</a> 
                <a href="{{URL::route('delete')}}/{{$product->id}}" class="label label-danger active" ui-toggle-class="" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>  
            </td>
            
        </tr>
        @endforeach

       
                        </tbody>
</table>
<div align="right">{{$products->links() }}</div>

</div>
@endsection

