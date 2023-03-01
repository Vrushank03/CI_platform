<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Company CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb my-auto">
                <div class="pull-left">
                    <h2><b> COMPANY CRUD USING LARAVEL</b> </h2>
                </div>
                <div class="pull-right mb-3 mt-3">
                    <!-- <a class="btn btn-success" href="{{ route('companies.create') }}"> Create Company</a> -->
                    <a class="btn btn-success" href="/companies/create"> Create Company</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Company Name</th>
                    <th>Company Email</th>
                    <th>Company Address</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->address }}</td>
                        <td>
                            <a class="btn btn-primary" href="/companies/edit/{{$company->id}}">Edit</a>
                            <a class="btn btn-danger " href="/companies/destroy/{{$company->id}}'">Delete</a>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $companies->links() !!}
        <a class="btn btn-primary" href="{{ route('signout') }}"> LogOut</a>
    </div>
</body>
</html>