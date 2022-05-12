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
                        All Brand
                    </div>


                    <table class="table table-bordered table-striped table-hover mb-0">

                        <thead class="table-light">
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Brand Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $key=>$row)
                            <tr>

                                <!-- [   $categories->firstItem()+$loop->index ] this is for ordering items number in pagination. -->

                                <th scope="row">{{$brands->firstItem()+$loop->index}}</th>
                                <td>{{$row->brand_name}}</td>
                                <td><img src="" alt=""></td>

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
                                    <a href="{{route('brand.edit',$row->id)}}" class="btn btn-info">Edit</a>
                                    <a href="{{route('soft.brand.delete',$row->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Connecting pagination by using default method -->
                    {{$brands -> links()}}
                </div>
            </div>
            <!-- add category card -->
            <div class="col-6 col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add Brand
                    </div>
                    <div class="card-body">
                        <form action="{{route('add.brand')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="brand_name" class="form-label">Brand Name</label>
                                <input type="text" name="brand_name" value="{{old('brand_name')}}" class="form-control" id="brand_name">
                                @error("brand_name")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="brand_image" class="form-label">Brand image</label>
                                <input type="file" name="brand_image" value="{{old('brand_image')}}" class="form-control" id="brand_image">
                                <img src="" alt="">
                                @error("brand_image")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary" style="float:right;">Add Brand</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

</x-app-layout>