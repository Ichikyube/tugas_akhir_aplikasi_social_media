<!DOCTYPE html>
<html>
    <head>
        <title>Laravel 8 Dropzone Image Upload</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="mt-4 col-md-12">
                    <h2>Laravel 8 Dropzone Image Upload</h2>

                    <form action="{{ route('dropzone.store') }}" method="post" enctype="multipart/form-data" class="dropzone">
                        @csrf

                    </form>
                </div>
                <div class="mt-2 col-md-12">
                    <div class="alert alert-primary">
                        Refresh Your Browser to Update Image Gallery
                    </div>
                </div>
                <div class="mt-2 col-md-12 row">
                    @foreach ($data as $row)
                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="{{ $row['url'] }}" alt="{{ $row['name'] }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $row['name'] }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
        <script type="text/javascript">
            Dropzone.options.imageUpload = {
                maxFilesize         :       1,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                // paramName: 'images',
                // params: {
                //     _token: document.querySelector('meta[name="csrf-token"]').content
                // }
            };
        </script>
    </body>
</html>
