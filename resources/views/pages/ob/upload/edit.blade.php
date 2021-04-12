@extends('layouts.ob')
@push('css')

@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <h4>Edit Bukti Tugas</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i>Refresh
                    </button>
                    <a href="{{ route('ob.upload.index') }}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-backward"></i>
                        Kembali</a>
                </p>
            </div>
            <form action="{{ route('ob.upload.update', $tanggal) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="box-body">
                    <?php $index = 0;  ?>
                    @foreach ($data as $d)
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label><?php echo $task_name[$index] ?></label>
                            <input type="hidden" name="id_image[]" value="{{ $d->id }}">
                            <input type="hidden" name="task_id[]" value="<?php echo $task_id[$index] ?>">
                            <input id="input_{{ $d->id }}" type="file" name="<?php echo $task_id[$index] ?>" class="form-control" accept="image/jpeg,image/jpg,image/png,">
                            <br>
                            <img src="{{ url('images_tugas/'. $d->image) }}" style="width: 400px; height: 200px;" id="gambar_{{ $d->id }}" alt="..." class="img-thumbnail img-responsive">
                        </div>
                    </div>
                    <script type="text/javascript">
                        var input_<?php echo $d->id ?> = document.getElementById('input_<?php echo $d->id ?>');
                        var gbr_<?php echo $d->id ?> = document.getElementById('gambar_<?php echo $d->id ?>');

                        input_<?php echo $d->id ?>.addEventListener('change', function() {
                            <?php $fungsi =  'fungsi_' . $d->id;
                            echo $fungsi; ?>(this);
                        })

                        function <?php $fungsi =  'fungsi_' . $d->id;
                                    echo $fungsi; ?>(a) {
                            if (a.files && a.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('gambar_<?php echo $d->id ?>').src = e.target.result;
                                }
                                gbr_<?php echo $d->id ?>.style.display = "block";
                                reader.readAsDataURL(a.files[0]);
                            }
                        }
                    </script>
                    <?php $index++;  ?>
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