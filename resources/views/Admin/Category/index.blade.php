<x-app-layout>

    <div class="container ">
        <div class="row g-5 py-5 my-5">
            <div class="col-sm-6 col-md-8">
                <div class="card">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card-header">
                        All Category
                    </div>


                    <table class="table table-bordered table-striped table-hover mb-0">

                        <thead class="table-light">
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">User</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $key=>$row)
                            <tr>

                                <!-- [   $categories->firstItem()+$loop->index ] this is for ordering items number in pagination. -->

                                <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                                <td>{{$row->category_name}}</td>
                                <td>{{$row->user->name}}</td>

                                <!-- Simply we can use like that when we join the table by Query -->
                                <!-- <td>{{$row->name}}</td> -->
                                <td>
                                    @if($row->created_at == NULL)
                                    <span class="text-danger">No Date Set</span>
                                    @else
                                    {{$row->created_at->diffForHumans()}}

                                    <!-- when use query for getting data then have to use this Carbon -->
                                    <!-- {{Carbon\Carbon::parse($row->created_at)->diffForHumans()}} -->
                                    @endif

                                </td>
                                <td>
                                    <a href="{{route('category.edit',$row->id)}}" class="btn  btn-info">Edit</a>
                                    <a href="{{route('soft.category.delete',$row->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Connecting pagination by using default method -->
                    {{$categories -> links()}}
                </div>
            </div>
            <!-- add category card -->
            <div class="col-6 col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add Category
                    </div>
                    <div class="card-body">
                        <form action="{{route('add.category')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" name="category_name" value="{{old('category_name')}}" class="form-control" id="category_name">
                                @error("category_name")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary" style="float:right;">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Trash card  -->

            <div class="card ">
                <div class="card-header">
                    Trush Category
                </div>


                <table class="table table-bordered table-striped table-hover mb-0">

                    <thead class="table-light">
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">User</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trashCat as $key=>$row)
                        <tr>

                            <!-- [   $categories->firstItem()+$loop->index ] this is for ordering items number in pagination. -->

                            <th scope="row">{{$trashCat->firstItem()+$loop->index}}</th>
                            <td>{{$row->category_name}}</td>
                            <td>{{$row->user->name}}</td>

                            <!-- Simply we can use like that when we join the table by Query -->
                            <!-- <td>{{$row->name}}</td> -->
                            <td>
                                @if($row->created_at == NULL)
                                <span class="text-danger">No Date Set</span>
                                @else
                                {{$row->created_at->diffForHumans()}}

                                <!-- when use query for getting data then have to use this Carbon -->
                                <!-- {{Carbon\Carbon::parse($row->created_at)->diffForHumans()}} -->
                                @endif

                            </td>
                            <td>
                                <a href="{{route('category.restore',$row->id)}}" class="btn  btn-info">Restore</a>
                                <a href="{{route('permanently.delete.category',$row->id)}}" class="btn btn-danger">Permanently Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Connecting pagination by using default method -->
                {{$trashCat -> links()}}
            </div>

            <!-- Trash card end -->
        </div>

    </div>

</x-app-layout>