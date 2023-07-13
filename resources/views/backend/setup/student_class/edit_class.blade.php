@extends('admin.admin_master')
@section('admin')

    <div class="content-wrapper">
        <div class="container-full">

            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Class Page</h4>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">

                                <form method="post" action="{{ route('update.student.class', $editData->id) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Edit Class <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input id="current_password" type="text" name="name" class="form-control"  value="{{ $editData->name }}"></div>
                                                @error('name')
                                                <span class="text-danger"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info mb-5" value="Update">
                                    </div>

                                </form>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->

                <!-- /.box -->

            </section>

        </div>
    </div>

@endsection
