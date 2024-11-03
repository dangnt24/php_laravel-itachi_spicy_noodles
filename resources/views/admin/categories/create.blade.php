@extends("layouts.adminLayout")
@section("adminContent")
	<div style="margin-bottom: calc(100vh - 450px);">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST">
                    {{ csrf_field() }}
					<div class="modal-header">						
						<h4 class="modal-title">Add Category</h4>
						<a role="button" href="{{ URL::to('/admin/categories') }}" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
					</div>
					<div class="modal-body">			
						<div class="form-group">
							<label>Category Name</label>
							<input type="text" class="form-control" name="c_name" required>
							<div class="text-danger">{{ $message ?? "" }}</div>
						</div>			
					</div>
					<div class="modal-footer">
						<a role="button" class="btn btn-default" href="{{ URL::to('/admin/categories') }}">Cancel</a>
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection