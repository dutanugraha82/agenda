@extends('master')
@section('pageTitle','Tambah Admin Universitas')
@section('content')
    <div class="container">
 
        <div class="card p-2">
            <form action="/superadmin/pengguna/admin-univ" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control " name="name" value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                   <label for="unit">Unit</label> <br>
                   <select name="unit_id" id="getUnit" class="form-control" >
                   </select>
                   @error('unit_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3 ">
                 <label for="password">Password</label>

                    <div class="d-flex justify-content-between align-items-center">
                      <input type="text" class="form-control" name="password" id="password" value="{{ old('password') }}">
                      <button class="btn btn-dark" onclick="generatePassword()">Random</button>
                      
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Buat Akun</button>
            </form>
        </div>
    </div>

    <script>
     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

     function  generatePassword() {
        event.preventDefault();
        var chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var passwordLength = 10;
        var password = "";
        
        for (var i = 0; i <= passwordLength; i++) {
          var randomNumber = Math.floor(Math.random() * chars.length);
          password += chars.substring(randomNumber, randomNumber +1);
        }

        document.getElementById('password').value = password
     }

    $(document).ready(function(){



      $( "#getUnit" ).select2({
        ajax: { 
          url: "{{route('getUnit')}}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              _token: CSRF_TOKEN,
              search: params.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          },
          cache: true
        }

      });

    });
</script>

   
@endsection