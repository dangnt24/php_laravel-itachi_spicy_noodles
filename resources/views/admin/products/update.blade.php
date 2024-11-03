@extends("layouts.adminLayout")
@section("adminContent")
	<div style="margin-bottom: calc(100vh - 450px);">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
					<div class="modal-header">						
						<h4 class="modal-title">Update Product</h4>
						<a role="button" href="{{ URL::to('/admin/products') }}" class="close" aria-hidden="true">&times;</a>
					</div>
					<div class="modal-body">
						<input type="hidden" name="id" value="{{ $product->pro_id }}">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" required value="{{ $product->pro_name }}">
						</div>	
						<div class="form-group">
							<label>Price</label>
							<input type="text" class="form-control" name="price" required value="{{ $product->pro_price }}">
						</div>	
						<div class="form-group">
							<label>Description</label>
							<textarea name="description"cols="30" rows="4" class="form-control" required>{{ $product->pro_description }}</textarea>
						</div>	
						<div class="form-group">
							<label>Image</label>
							<input type="file" class="form-control" name="image">
							<img src="{{ asset('FE/img/products/'.$product->pro_image) }}" alt="product" style="width: 50px; height: 50px; margin-top: 4px;" onclick="openFullScreen(this)">
						</div>	
						<div class="form-group">
							<label>Category</label>
							<select name="c_id" class="form-control text-dark">
								@foreach($categories as $category)
								<option value="{{ $category->c_id }}" <?php echo $product->c_id == $category->c_id?"selected": ""; ?>>{{ $category->c_name }}</option>
								@endforeach
							</select>
						</div>	
						<div class="form-group">
							<label>Outstanding</label>
							<select name="outstanding" class="form-control text-dark">
								<option value="0" <?php echo $product->outstanding == 0?"selected": "";?>>No</option>
								<option value="1" <?php echo $product->outstanding == 1?"selected": "";?>>Yes</option>
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