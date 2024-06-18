

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin-top: 20px;">
                <h4>Admin Dashboard</h4>    
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <form action="{{ route('admin.assignRole', $user->id) }}" method="POST">
                           @csrf
                            @method('PATCH')    
                           <label for="role">Assign Role to {{ $user->name }}</label>
                            <select name="role" id="role">
                               @foreach ($roles as $role)
                              <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                              </select>
                             <button type="submit">Assign Role</button>
                         </form>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+
