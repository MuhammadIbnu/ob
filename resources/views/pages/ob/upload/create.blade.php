@extends('layouts.ob')
@push('css')

@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <h4>Upload Bukti Tugas</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i>Refresh
                    </button>
                    <a href="{{ route('ob.upload.index') }}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-backward"></i>
                        Kembali</a>
                </p>
            </div>
            <form action="{{ route('ob.upload.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    @foreach ($tasks as $t)
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>{{ $t->name }}</label>
                            <input type="hidden" name="task_id[]" value="{{ $t->id }}">
                            <input id="input_{{ $t->id }}" type="file" name="image[]" class="form-control" accept="image/jpeg,image/jpg,image/png," required>
                            <br>
                            <img src="" style="width: 400px; height: 200px; display: none;" id="gambar_{{ $t->id }}" alt="..." class="img-thumbnail img-responsive">
                        </div>
                    </div>
                    <script type="text/javascript">
                        
                        var input_<?php echo $t->id ?> = document.getElementById('input_<?php echo $t->id ?>');
                        var gbr_<?php echo $t->id ?> = document.getElementById('gambar_<?php echo $t->id ?>');

                        input_<?php echo $t->id ?>.addEventListener('change', function() {
                            <?php $fungsi =  'fungsi_' . $t->id;
                            echo $fungsi; ?>(this);
                        })

                        function <?php $fungsi =  'fungsi_' . $t->id;
                            echo $fungsi; ?>(a) {
                            if (a.files && a.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('gambar_<?php echo $t->id ?>').src = e.target.result;
                                }
                                gbr_<?php echo $t->id ?>.style.display = "block";
                                reader.readAsDataURL(a.files[0]);
                            }
                        }
                    </script>
                    @endforeach
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection