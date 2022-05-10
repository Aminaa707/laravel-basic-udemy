<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hello... {{Auth::user()->name}}
        </h2>

        <b style="float:right;"> Total Users <span class="badge bg-danger"> {{count($users)}}</span>
        </b>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- <x-jet-welcome /> -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key=>$row)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>

                            <!-- diffForHumans() its a laravel defult function for change time-->
                            <td>{{$row->created_at->diffForHumans()}}</td>



                            <!-- diffForHumans() its change little bit when we get data by query-->
                            <!-- <td>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>