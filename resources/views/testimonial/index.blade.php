@extends('layouts.custom.app')
@section('extraCss')
    <style>
        .user-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #ddd;
            background-size: cover;
            background-position: center;
        }
    </style>
@endsection

@section('page_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">User Testimonials</h1>
        {{-- <p><a href="{{ url('dashboard/shop/item/add') }}" class="btn btn-primary">Add Item</a></p> --}}

    </div>
    <!-- /.container-fluid -->

    <div class="container-fluid">
        @include('layouts.notifications.dismisable')
        <div class="row">

            @foreach ($testimonials as $testimonial)
                <div class="col-lg-4 mb-4">
                    <div class="card">

                        <div class="card-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <img src="{{ $testimonial->imageurl }}" width="100%" height="100%" alt="">
                            </div>
                            <p>Name: {{ $testimonial->written_by }}</p>
                            <p>Description: {{ $testimonial->shortdesc }}</p>

                        </div>
                        <div class="card-footer">
                            <a href="{{ url('dashboard/testimonials/delete/')."/".$testimonial->id }}" class="btn btn-danger">Delete</a>
                           
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Modal -->





        </div>
        <div class="row">
            <p> {{ $testimonials->links() }}</p>
        </div>
     
    </div>
@endsection


@section('extraJS')
@endsection
