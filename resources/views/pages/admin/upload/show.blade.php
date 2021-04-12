@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h4>Detail Upload Tugas</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i>Refresh
                    </button>
                    <a href="{{ route('admin.upload.index') }}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-backward"></i>
                        Kembali</a>
                </p>
            </div>
            <form action="#">
                @csrf
                @method('POST')
                <div class="box-body">
                    <?php $index = 0;  ?>
                    @foreach ($data as $d)
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label><?php echo $task_name[$index] ?></label>
                            
                            <br>
                            <img src="{{ url('images_tugas/'. $d->image) }}" style="width: 400px; height: 200px;" id="gambar_{{ $d->id }}" alt="..." class="img-thumbnail img-responsive">
                        </div>
                    </div>
                    
                    <?php $index++;  ?>
                    @endforeach


                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')


@endsection

