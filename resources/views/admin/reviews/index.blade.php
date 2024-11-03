@extends("layouts.adminLayout")

@section("adminContent")
<div class="container p-5">
    <div class="table-wrapper">
        <form action="{{ URL::to('/admin/reviews/deleteManyItems') }}" method="get">
            <div class="table-title mb-4">
                <div class="row">
                    <div class="col-sm-6">
                        <h2><b>Reviews</b></h2>
                    </div>
                    <div class="col-sm-6 text-end">
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
                        <th>ID</th>
                        <th>Username</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Created At</th>
                        <th class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                    <tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" name="reviews[]" value="{{ $review->r_id }}">
                            </span>
                        </td>
                        <td>#0{{ $review->r_id }}</td>
                        <td>{{ $review->username }}</td>
                        <td>{{ $review->rating }} / 5</td>
                        <td>{{ Str::limit($review->comment, 50) }}</td>
                        <td>{{ $review->created_at }}</td>
                        <td class="text-center">
                            <a onclick="return confirm('Do you want to delete this review?')" href="{{ URL::to('/admin/reviews/delete?r_id=' . $review->r_id) }}" class="delete"><i class="fa-solid fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
@endsection
