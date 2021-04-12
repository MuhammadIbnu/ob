@extends('layouts.ob')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h4>Image Upload</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i>Refresh
                    </button>
                    <a href="{{ route('ob.upload.create') }}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-upload"></i>
                        Upload Bukti</a>
                </p>
            </div>
            <div class="box-body">

                <div class="table-responsive">
                    <table class="table table-hover myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Upload</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <?php
                                    $created_at = $data->created_at;
                                    $tanggal = substr($created_at, 0, 10);
                                    echo $tanggal;
                                    ?>
                                </td>
                                <td>
                                    <a href="{{ route('ob.upload.edit', $data->created_at) }}" class="btn btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')


@endsection

<script>
    $(document).ready(function() {
        $('.myTable').DataTable();
    });
</script>