@extends('layouts.custom.app')

@section('page_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">New Requests</h1>

    </div>
    <!-- /.container-fluid -->

    <div class="container-fluid">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            {{ $post->post_title }}
                        </div>
                        <div class="card-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{{ $post->post_video }}"
                                    allow="autoplay; encrypted-media" allowfullscreen="allowfullscreen" frameborder="0"
                                    autoplay="0" controls></iframe>
                            </div>

                            <p>{{ $post->post_description }}</p>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal"
                                data-type="approved" data-post-id="{{$post->id}}">Approve</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"
                                data-type="rejected" data-post-id="{{$post->id}}">Reject</button>
                            {{-- <button class="btn btn-primary">Post By</button> --}}
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Leave a Comment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{url('dashboard/post/action/update')}}">
                              @csrf
                                <div class="form-group">
                                    <label for="comment">Comment:</label>
                                    <textarea class="form-control" name="admin_comment" id="comment" required></textarea>
                                </div>
                                <input type="hidden" id="button-type" name="button_type" value="">
                                <input type="hidden" id="post_id" name="post_id" value="">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="submit-comment-btn">Submit</button>
                        </div>
                      </form>

                    </div>
                </div>
            </div>




        </div>
        <div class="row">
            <p> {{ $posts->links() }}</p>
        </div>




    </div>
@endsection


@section('extraJS')
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var type = button.data('type') // Extract info from data-* attributes
            var post_id = button.data('post-id') // Extract info from data-* attributes

            var modal = $(this)
            modal.find('#button-type').val(type)
            modal.find('#post_id').val(post_id)

        })

        
    </script>
@endsection
