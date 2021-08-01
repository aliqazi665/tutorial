<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Document</title>
  
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</head>
<body>
    <div id="headers">
        <button type="button" class="btn btn-success addbutton" data-toggle="modal" data-target="#exampleModal">Add a new Product</button>
       </div>



       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add A New Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action=""  id="addproduct" >
        @csrf 
       <div class="form-group">
            <label for="exampleInputEmail1">Enter Product Name</label>
          <input type="name" class="form-control" id="productname" aria-describedby="emailHelp" placeholder="Enter Name" required>
      </div>
      <div class="form-group">
            <label for="exampleInputEmail1">Enter Product Description</label>
          <input type="name" class="form-control" id="productdescription" aria-describedby="emailHelp" placeholder="Enter product description" required>
      </div>
      <div class="form-group">
            <label for="exampleInputEmail1">Enter Product quality </label>
          <input type="name" class="form-control" id="productquality" aria-describedby="emailHelp" placeholder="Enter product quality" required>
      </div>  <div class="form-group">
            <label for="exampleInputEmail1">Enter Product Price</label>
          <input type="number" class="form-control" id="productprice" aria-describedby="emailHelp" placeholder="Enter Price" required>
      </div>  <div class="form-group">
            <label for="exampleInputEmail1">Upload Product  Image</label>
          <input type="file" class="form-control" id="productimage" aria-describedby="emailHelp" placeholder="" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Add Product</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">

$(document).ready(function() {
      $('#addproduct').on('submit',function(){
     var formData = new FormData $('#addproduct')[0];
         for (var value of formData.values()) {
                   console.log(value); 
                  }
        $.ajax({
                type:'POST'
                url: '{{ route('addnewproduct') }}',
                data:formData,
                contentType: false,
                processData: false,
                success: function(){
                console.log('sucess');
            }
            });
         });
      }); 

  

   
 </script>  
