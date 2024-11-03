@extends("layouts.adminLayout")
@section("adminContent")
	<div style="margin-bottom: calc(100vh - 450px);">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
					<div class="modal-header">						
						<h4 class="modal-title">Add Product</h4>
						<a role="button" href="{{ URL::to('/admin/products') }}" class="close" aria-hidden="true">&times;</a>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" required>
						</div>	
						<div class="form-group">
							<label>Price</label>
							<input type="text" class="form-control" name="price" required>
						</div>	
						<div class="form-group">
							<label>Description</label>
							<textarea name="description"cols="30" rows="4" class="form-control" required></textarea>
						</div>	
						<div class="form-group">
							<label>Image</label>
							<input type="file" class="form-control" name="image" required>
						</div>	
						<div class="form-group">
							<label>Category</label>
							<select name="c_id" class="form-control text-dark">
								@foreach($categories as $category)
								<option value="{{ $category->c_id }}">{{ $category->c_name }}</option>
								@endforeach
							</select>
						</div>	
						<div class="form-group">
							<label>Outstanding</label>
							<select name="outstanding" class="form-control text-dark">
								<option value="0">No</option>
								<option value="1">Yes</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<a role="button" class="btn btn-default" href="{{ URL::to('/admin/products') }}">Cancel</a>
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
				<div class="full-screen" id="fullScreenModal" onclick="closeFullScreen()">
					<img id="fullScreenImage" src="" alt="Full Screen Image">
				</div>
			</div>
		</div>
	</div>
@endsection