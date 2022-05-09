<x-admin-master>
    @section('content')
        <h1>ALL POSTS</h1>

        @if(session('message'))
            <div class="alert alert-danger">{{session('message')}}</div>
            @elseif(session('post-create-message'))
            <div class="alert alert-success">{{session('post-create-message')}}</div>
            @elseif(session('post-update-message'))
            <div class="alert alert-success">{{session('post-update-message')}}</div>
        @endif

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Owner</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Owner</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      @foreach ($posts as $post)
                      <tr>
                          <td>{{$post->id}}</td>
                          <td>{{$post->user->name}}</td>
                          <td><a href="{{route('posts.edit', $post->id)}}"> {{$post->title}} </a></td>
                          <td><img height="40px" src="{{$post->post_image}}" alt=""></td>
                          <td>{{$post->created_at->diffForHumans()}}</td>
                          <td>{{$post->updated_at->diffForHumans()}}</td>

                            <td>
                                @can('view', $post)
                                <form method="post" action="{{route('posts.destroy', $post->id)}}" enctype="multipart/form-data">  
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                @endcan
                            </td>
                      </tr>
                      @endforeach
                  </tbody>
                 
                </table>
              </div>
            </div>
          </div>
          <div class="pagination justify-content-center">
            {{$posts->links('pagination::bootstrap-4')}}
        </div>
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
      
    @endsection
</x-admin-master>