@extends("layouts.adminLayout")
@section("adminContent")
    <div class="container p-5">
        <div class="table-wrapper">
            <form action="{{ URL::to('/admin/products/deleteManyItems') }}" method="get">
            <div class="table-title mb-4">
                <div class="row">
                    <div class="col-sm-6">
						<h2><b>Products</b></h2>
					</div>
					<div class="col-sm-6 text-end">
						<a href="{{ URL::to('/admin/products/create') }}" class="btn btn-primary mb-3" id="deleteButton"><i class="fa-solid fa-plus me-1"></i> <span>Add Product</span></a>
						<button onclick="return confirm('Are you sure to delete the selected items?')" type="submit" class="btn btn-danger mb-3"><i class="fa-solid fa-trash me-1"></i> <span>Delete</span></button>
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
							<th>Product</th>
							<th>Name</th>
							<th>Price</th>
							<th>Description</th>
							<th>Image</th>
							<th>Category</th>
							<th>Outstanding</th>
							<th class="text-center">Delete</th>
						</tr>
					</thead>
					<tbody>
						@foreach($products as $item)
						<tr title="{{ $item->pro_name }}">
							<td>
								<span class="custom-checkbox">
									<input type="checkbox" name="products[]" value="{{ $item->pro_id }}">
								</span>
							</td>
							<td>
								<a href="{{ URL::to('/admin/products/update?id='.$item->pro_id) }}" class="edit me-3">#0{{ $item->pro_id }}</a>
							</td>
							<td><div class="product_overflow">{{ $item->pro_name }}</div></td>
							<td>{{ $item->pro_price }}</td>
							<td><div class="product_overflow">{{ $item->pro_description }}</div></td>
							<td style="padding: 12px;"><img src="{{ asset('FE/img/products/'.$item->pro_image)}}" alt="product" style="width: 100px; height: 100px; border-radius: 0; border: 1px solid #ccc;" onclick="openFullScreen(this)"></td>
							<td>{{ $item->c_name }}</td>
							<td><input class="outstanding" type="checkbox" <?php echo ($item->outstanding == 1)? "checked": "";?> disabled></td>
							<td class="text-center">
								<a onclick="return confirm('Do you want delete `{{ $item->pro_name }}`?')" href="{{ URL::to('/admin/products/delete?id='.$item->pro_id) }}" class="delete"><i class="fa-solid fa-trash text-danger"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
            </form>
			<div class="full-screen" id="fullScreenModal" onclick="closeFullScreen()">
				<img id="fullScreenImage" src="" alt="Full Screen Image">
			</div>
        </div>
    </div>
@endsection
