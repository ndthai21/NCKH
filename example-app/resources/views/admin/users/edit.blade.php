@extends('admin.layouts.app')
@section('title', 'Edit User', $user->name)
@section('content')
    <div class="card">
        <h1>Edit User</h1>
        <div>
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="input-group-static col-5 mb-4">
                        <label for="image-input">Image</label>
                        <input type="file" accept="image/*" name="image" id="image-input" class="form-control">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-5">
                        <img src="{{ $user->images ? asset('upload/users/' . $user->images->first()->url) : 'upload/users/default.jpg' }}"
                            id="show-image" alt="">
                    </div>
                </div>

                <div class="input-group input-group-static mb-4">
                    <label for="name-input">Name</label>
                    <input type="text" value="{{ old('name') ?? $user->name }}" name="name" id="name-input"
                        class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label for="email-input">Email</label>
                    <input type="email" value="{{ old('email') ?? $user->email }}" name="email" id="email-input"
                        class="form-control">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label for="phone-input">Phone</label>
                    <input type="text" value="{{ old('phone') ?? $user->phone }}" name="phone" id="phone-input"
                        class="form-control">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label for="gender-select">Gender</label>
                    <select name="gender" id="gender-select" class="form-control" value="{{ $user->gender }}">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label for="address-textarea">Address</label>
                    <textarea name="address" id="address-textarea" class="form-control">{{ old('address') ?? $user->address }}</textarea>
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
                    @foreach ($roles as $groupName => $groupRoles)
                        <div class="col-6">
                            <h4>{{ $groupName }}</h4>
                            <div>
                                @foreach ($groupRoles as $role)
                                    <div class="form-check">
                                        <input class="form-check-input" name="role_ids[]"                                    
                                            {{ $user->roles->contains('id', $role->id) ? 'checked' : '' }}
                                            type="checkbox" value="{{ $role->id }}">
                                        <label class="form-check-label" for="role{{ $role->id }}">{{ $role->display_name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            
                <button type="submit" class="btn btn-submit btn-primary">Update</button>
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
