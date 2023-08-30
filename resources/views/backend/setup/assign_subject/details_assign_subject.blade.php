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
                                <h3 class="box-title">Assign Subject Details</h3>
                                <a href="{{ route('assign.subject.add') }}" class="btn btn-rounded btn-success mt-5" style="float: right">Add</a>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <h4><strong>Subject : </strong> {{ $detailstData['0']['student_class']['name'] }}</h4>
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead class="thead-light">
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th>Subject</th>
                                            <th width="20%">Full Mark</th>
                                            <th width="20%">Pass mark</th>
                                            <th width="20%">Subjective Mark</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($detailstData as  $key =>$detail)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $detail->school_subject->name }}</td>
                                                <td> {{ $detail->full_mark }}   </td>
                                                <td> {{ $detail->pass_mark }}   </td>
                                                <td> {{ $detail->subjective_mark }}   </td>
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
