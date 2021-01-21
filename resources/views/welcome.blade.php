<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo !empty($title) ? $title : env('app_name'); ?></title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
        <script  src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <style type="text/css">
            .form-control, .btn{
                border-radius: 0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <br><br>
                     @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                              {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                    @if(Session::has('success_msg'))
                      <div class="alert alert-success">{{Session::get('success_msg')}}</div>
                    @endif
                    @if(Session::has('error_msg'))
                      <div class="alert alert-danger">{{Session::get('error_msg')}}</div>
                    @endif

                    <h2 style="text-align: center;">Contact Form</h2>
                    <div style="display: none;" class="alert alert-success"></div>
                    <?php if(empty( $contact )){ ?>
                    <form method="post" id="contactForm" action="{{URL::to('/contact/store')}}">
                        @csrf
                        <div class="form-group col-md-6">
                            <label class="control-label">Name : </label>
                            <input class="form-control" type="text" name="name" placeholder="Enter Fullname" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Email : </label>
                            <input class="form-control" type="email" name="email" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Phone : </label>
                            <input class="form-control" type="number" name="phone" placeholder="Enter Phone" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">Designation : </label>
                            <input class="form-control" type="text" name="designation" placeholder="Enter Designation" required>
                        </div>

                        <div class="form-group col-md-6">
                            <button type="submit" id="saveBtn" class="btn btn-success">Submit</button>
                        </div>

                    </form>
                    <?php }else{ ?>

                    <form method="post" id="contactForm" action="{{URL::to('/contact/update')}}">

                        @csrf

                        <div class="form-group col-md-6">
                            <label class="control-label">Name : </label>
                            <input class="form-control" type="text" name="name" placeholder="Enter Fullname" value="{{$contact->full_name}}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Email : </label>
                            <input class="form-control" type="email" name="email" placeholder="Enter Email" required value="{{$contact->email}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Phone : </label>
                            <input class="form-control" type="number" name="phone" placeholder="Enter Phone" required value="{{$contact->phone}}">
                        </div>

                        <input type="hidden" name="contact_id" value="{{$contact->id}}">

                        <div class="form-group col-md-6">
                            <label class="control-label">Designation : </label>
                            <input class="form-control" type="text" name="designation" placeholder="Enter Designation" required value="{{$contact->designation}}">
                        </div>

                        <div class="form-group col-md-6">
                            <button type="submit" id="saveBtn" class="btn btn-success">Update Contact</button>
                        </div>

                    </form>

                    <?php } ?>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row">
                <h2>Contact List</h2>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Designation</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody id="showContact">
                    <?php 

                    if( !empty($items) && count($items) > 0){  foreach ($items as $item) { ?>
                          <tr>
                            <td><?php echo $item->full_name; ?></td>
                            <td><?php echo $item->email; ?></td>
                            <td><?php echo $item->phone; ?></td>
                            <td><?php echo $item->designation; ?></td>
                            <td class="text-center">
                                <a class="btn btn-xs btn-info" href="{{URL::to('contact/edit/'.$item->id)}}">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a class="btn btn-xs btn-danger" href="{{URL::to('contact/delete/'.$item->id)}}">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                          </tr>
                      <?php } }else{ ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No data found</td>
                        </tr>
                    <?php } ?>
                    </tbody>

                  </table>
                  <!-- Pagination -->
                <div class="d-flex justify-content-center" style="float: right;margin-top: -25px">
                    {!! $items->links() !!}
                </div>
            </div>
        </div>
    </body>

    <script type="text/javascript">
        setTimeout(function(){
            $('.alert').hide();
        }, 5000);
    </script>



</html>
