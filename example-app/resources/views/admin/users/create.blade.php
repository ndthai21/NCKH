@extends('admin.layouts.app')
@section('title', 'Create User')
@section('content')
    <div class="card">
        <h1>Create User</h1>
        <div>
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="input-group-static col-5 mb-4">
                        <label for="image-input">Image</label>
                        <input type="file" accept="image/*" name="image" id="image-input" class="form-control">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-5">
                        <img src="" id="show-image" alt="">
                    </div>
                </div>

                <div class="input-group input-group-static mb-4">
                    <label for="name-input">Name</label>
                    <input type="text" value="{{ old('name') }}" name="name" id="name-input" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label for="email-input">Email</label>
                    <input type="email" value="{{ old('email') }}" name="email" id="email-input" class="form-control">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label for="phone-input">Phone</label>
                    <input type="text" value="{{ old('phone') }}" name="phone" id="phone-input" class="form-control">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label for="gender-select">Gender</label>
                    <select name="gender" id="gender-select" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label for="address-textarea">Address</label>
                    <textarea name="address" id="address-textarea" class="form-control">{{ old('address') }}</textarea>
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label for="password-input">Password</label>
                    <input type="password" name="password" id="password-input" class="form-control">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label for="roles-checkbox">Roles</label>
                </div>
                <div class="row">
                    @foreach ($roles as $groupName => $role)
                        <div class="col-6">
                            <h4>{{ $groupName }}</h4>
                            <div>
                                @foreach ($role as $item)
                                    <div class="form-check">
                                        <input class="form-check-input" name="role_ids[]" type="checkbox"
                                            value="{{ $item->id }}" id="role{{ $item->id }}">
                                        <label class="form-check-label"
                                            for="role{{ $item->id }}">{{ $item->display_name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-submit btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script>
        $(() => {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#show-image').attr('src', e.target.result);
                    };  
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image-input").change(function() {
                readURL(this);
            });
        });
    </script>
@endsection
