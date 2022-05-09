<x-admin-master>
    @section('content')
        <h1>User Profile {{$user->name}}</h1>

        <div class="row">
          
            <div class="col-sm-6">
                
                <form method="post" action="{{route('user.profile.update', $user)}}" enctype="multipart/form-data">
                    <!-- https://randomuser.me/ for random person pic-->
                        @csrf
                        @method('PUT')
                
                        <div class="mb-4">
                            <img class="img-profile rounded-circle" height="40px" width="40px" src="{{$user->avatar}}">
                        </div>

                        <div class="form-group">
                            <input type="file" name="avatar">
                        </div>    

                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" name="username" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}" id="username" value="{{$user->username}}">
                            @error('username')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email" value="{{$user->email}}">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    @endsection
</x-admin-master>