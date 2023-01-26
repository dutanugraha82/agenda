@extends('master')
@section('pageTitle')
    Sunting Agenda Kegiatan
@endsection
@section('content')
    <div class="card">
        <form action="{{route('activities.update',$activity->id)}}" method="POST" class="p-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="act_name">Nama Agenda Kegiatan <sup class="text-danger" style="font-size:14px">*</sup></label>
                <textarea name="act_name" class="form-control" cols="30" rows="3">{{ old('act_name',$activity->act_name)}}</textarea>
                @error('act_name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="act_address">Alamat/Tempat Kegiatan  <sup  style="color:red;font-size:16px">*</sup></label>
                <textarea name="act_address" class="form-control" cols="30" rows="3">{{ old('act_address',$activity->act_address)}}</textarea>
                @error('act_address')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="act_date">Tanggal Kegiatan<sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="datetime-local" class="form-control" name="act_date" value="{{ $activity->act_date }}" />
                        @error('act_date')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="partisipant">Jumlah Partisipan <sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="number" class="form-control" name="partisipant" value="{{old('partisipant',$activity->partisipant)}}"/>
                        @error('partisipant')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="">Current Image</label>
                            <img src="{{ asset('/storage'.'/'.$activity->image) }}" alt="">
                        </div>
                        <label for="partisipant">Update Gambar <sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="number" class="form-control" name="partisipant" value="{{old('partisipant',$activity->partisipant)}}"/>
                        @error('partisipant')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="type">Jenis Agenda <sup  style="color:red;font-size:16px">*</sup></label>
                        <select name="type" class="form-control">
                            <option value="publish" {{ ($activity->type == 'publish') ? "selected" : '' }}>Publish (Umum)</option>
                            <option value="private" {{ ($activity->type == 'private') ? "selected" : '' }}>Private (Rahasia) </option>
                        </select>
                        @error('type')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category">Kategori Agenda <sup  style="color:red;font-size:16px">*</sup></label>
                        <select name="category" class="form-control">
                            <option value="internal" {{ ($activity->category == 'internal') ? "selected" : '' }}> Internal</option>
                            <option value="umum" {{ ($activity->category == 'umum') ? "selected" : '' }}>Umum </option>
                        </select>
                        @error('category')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
            </div>
            <input type="submit" value="Sunting Agenda Kegiatan" class="btn btn-primary btn-sm"/>

        </form>
    </div>

@endsection

