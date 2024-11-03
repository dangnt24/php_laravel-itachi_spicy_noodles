@extends("layouts.adminLayout")
@section("adminContent")
<div class="container p-5">
    <div class="table-wrapper">
        <form action="{{ URL::to('/admin/accounts/deleteManyItems') }}" method="get">
            <div class="table-title mb-4">
                <div class="row">
                    <div class="col-sm-6">
                        <h2><b>Accounts</b></h2>
                    </div>
                    <div class="col-sm-6 text-end">
                        <a href="{{ URL::to('/admin/accounts/create') }}" class="btn btn-primary mb-3"><i
                                class="fa-solid fa-plus me-1"></i> <span>Add Account</span></a>
                        <button onclick="return confirm('Are you sure to delete the selected items?')" type="submit"
                            class="btn btn-danger mb-3" id="deleteButton"><i class="fa-solid fa-trash me-1"></i>
                            <span>Delete</span></button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>Birthday</th>
                            <th>Avatar</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accounts as $item)
                        <tr class="{{ $item->role_id == 1? 'text-warning fw-bold': '' }}">
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" name="accounts[]" value="{{ $item->username }}">
                                </span>
                            </td>
                            <td>
                                <a href="{{ URL::to('/admin/accounts/update?username='.$item->username) }}"
                                    class="edit me-3 ">{{ $item->username }}</a>
                            </td>
                            <td>
                                <div class="account_overflow">{{ $item->fullname }}</div>
                            </td>
                            <td>{{ date("Y-m-d", strtotime($item->birthday)) }}</td>
                            <td><img src="{{ asset('FE/img/avatars/'.$item->avatar) }}" alt="avatar"
                                    style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid #ccc;"></td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td class="text-center">
                                <a onclick="return confirm('Do you want delete account `{{ $item->username }}`?')"
                                    href="{{ URL::to('/admin/accounts/delete?username='.$item->username) }}"
                                    class="delete"><i class="fa-solid fa-trash text-danger"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
@endsection
