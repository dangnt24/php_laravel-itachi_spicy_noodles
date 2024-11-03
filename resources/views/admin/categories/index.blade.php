@extends("layouts.adminLayout")
@section("adminContent")
    <div class="container p-5">
        <div class="table-wrapper">
            <form action="{{ URL::to('/admin/categories/deleteManyItems') }}" method="get">
            <div class="table-title mb-4">
                <div class="row">
                    <div class="col-sm-6">
						<h2><b>Categories</b></h2>
					</div>
					<div class="col-sm-6 text-end">
						<a href="{{ URL::to('/admin/categories/create') }}" class="btn btn-primary mb-3"><i class="fa-solid fa-plus me-1"></i> <span>Add Category</span></a>
						<button onclick="return confirm('Are you sure to delete the selected items?')" type="submit" class="btn btn-danger mb-3" id="deleteButton"><i class="fa-solid fa-trash me-1"></i> <span>Delete</span></button>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
                        <th>Categories</th>
                        <th>Name</th>
                        <th class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $item)
                    <tr>
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" name="categories[]" value="{{ $item->c_id }}">
							</span>
						</td>
                        <td>
                            <a href="{{ URL::to('/admin/categories/update?c_id='.$item->c_id) }}" class="edit me-3">#0{{ $item->c_id }}</a>
                        </td>
                        <td>{{ $item->c_name }}</td>
                        <td class="text-center">
                            <a onclick="return confirm('Do you want delete `{{ $item->c_name }}`?')" href="{{ URL::to('/admin/categories/delete?c_id='.$item->c_id) }}" class="delete"><i class="fa-solid fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </form>
        </div>
    </div>
@endsection
