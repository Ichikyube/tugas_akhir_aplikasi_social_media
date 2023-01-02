<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<body>
    <div class="container">
  <div class="row justify-content-center">
    <div class="card">
       <div class="card-header">Laravel Upload File Example</div>

         <div class="card-body">
            @if ($message = Session::get('success'))

                <div class="alert alert-success alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message }}</strong>

                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('save') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control-file" name="file" id="file" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

         </div>
     </div>
  </div>
</body>
</html>
<!doctype html>
<html lang="en">
  <head>
    <title>Laravel 6 - Multiple Images Upload </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  </head>
  <body>
      <div class="container mt-5">
        <div class="row">
            <div class="m-auto col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12">
            <form action="{{ url('upload-images') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="shadow card">
                        <div class="card-header bg-success">
                            <h5 class="text-white"> Laravel 6 Multiple Images Upload </h5>
                        </div>
                        <div class="card-body">

                            <!-- print success message after file upload  -->
                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                    @php
                                        Session::forget('success');
                                    @endphp
                                </div>
                            @endif

                            @if(session()->has('uploadedImages'))

                                @foreach(session()->get('uploadedImages')  as $in)
                                    <tr>
                                            <td>{{ $in }}</td>
                                    </tr>
                                @endforeach

                            @endif


                            <label for="images"> Images </label>
                                <div class="form-group">
                                    <input type="file" name="images[]" class="form-control" id="images" multiple/>
                                    {!! $errors->first('images', '<small class="text-danger">:message</small>') !!}
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success"> Upload Images </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </body>
</html>
<html lang="en">
<head>
  <title>Laravel Multiple File Upload Example</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body><br>
<div class="container">
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Sorry !</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif

<h3 class="jumbotron"><i class="glyphicon glyphicon-upload"></i> Laravel Multiple File Upload</h3>
<form method="post" action="{{url('upload_data')}}" enctype="multipart/form-data">
  {{csrf_field()}}
        <div class="input-group control-group increment" >
          <input type="file" name="filename[]" class="form-control">
          <div class="input-group-btn">
            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
        </div>
        <div class="clone hide">
          <div class="control-group input-group" style="margin-top:10px">
            <input type="file" name="filename[]" class="form-control">
            <div class="input-group-btn">
              <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-info" style="margin-top:12px"><i class="glyphicon glyphicon-check"></i> Submit</button>
  </form>
   <br><hr>

   <h4><i class="glyphicon glyphicon-picture"></i> Display Data Image    </h4>
   <table class="table table-bordered table-hover table-striped">
    <thead>
    <tr><th>#</th>
        <th>Picture</th>
    </tr>
    </thead>
    <tbody>
        @foreach($data as $image)
       <tr><td>{{$image->id}}</td>
           <td> <?php foreach (json_decode($image->filename)as $picture) { ?>
                 <img src="{{ asset('/image/'.$picture) }}" style="height:120px; width:200px"/>
                <?php } ?>
           </td>
      </tr>
        @endforeach
    </tbody>
   </table>

  </div>

<script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".btn-danger",function(){
          $(this).parents(".control-group").remove();
      });
    });
</script>
</body>
</html>
