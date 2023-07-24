@extends('layouts.custom.app')

@section('page_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Add Item To Free Shop</h1>

    </div>
    <!-- /.container-fluid -->

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-12">
                    <div class="p-5">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add Item</h1>
                        </div>
                        <form action="{{ url('/dashboard/shop/item/add') }}" method="POST" class="user"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="item_name" class="form-control form-control-user"
                                        id="exampleFirstName" placeholder="Item Name" required>
                                </div>

                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="item_category" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Item Category" required>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="exampleInputPassword1">Item Image</label>
                                    <input type="file" name="item_image" class="form-control" id="exampleInputPassword1"
                                        accept="image/*" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Add Item
                            </button>
                            <hr>

                        </form>
                        <hr>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
