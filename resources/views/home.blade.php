@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Videos
    <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus"></i> Add video </button>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> {{ config('app.name', 'Laravel') }}</a></li>
    <li class="active">Videos</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">

          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>No.</th>
                <th>video Id</th>
              </tr>
            </thead>
            <tbody>
              @php 
              $i=1;
              @endphp
              @foreach($videos as $item)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$item->video_id}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Video</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <form action="{{route('save-video')}}" method="post">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Video address/Id</label>
              <input type="text" name="url" class="form-control" id="url" aria-describedby="urlHelp" placeholder="Enter URL or id" required>
              <small id="urlHelp" class="form-text text-muted"><strong>n-BXNXvTvV4</strong> or <strong>https://www.youtube.com/watch?v=n-BXNXvTvV4</strong></small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>        
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
@endsection
