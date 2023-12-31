@extends('admin.admin_master')
@section('admin')

    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">User list</h3>
                                <a href="{{ route('users.add') }}" class="btn btn-rounded btn-success mt-5" style="float: right">Add User</a>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th>Role</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Code</th>
                                            <th>Photo</th>
                                            <th width="25%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($allData as  $key =>$user)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->code }}</td>
                                            <td>
                                                <img src="{{ asset('storage/'.$user->profile_photo_path) }}" alt="photo">
                                            </td>
                                            <td>
                                                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ route('users.delete', $user->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
    </div>


@endsection
