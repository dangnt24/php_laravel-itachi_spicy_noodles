@extends("layouts.adminLayout")
@section("adminContent")
    <div class="container mt-4 mb-5">
        <div class="table-wrapper">
            <form action="{{ URL::to('/admin/orders/deleteManyItems') }}">
                <div class="table-title">
                    <div class="row">
                        <div class="col-6 text-start">
                            <h2><b>Orders</b></h2>
                        </div>
                        <div class="col-6 text-end">
                            {{-- <a href="{{ URL::to('/admin/orders/create') }}" class="btn btn-primary mb-3"><i class="fa-solid fa-plus me-1"></i> <span>Create Order</span></a> --}}
                            <button onclick="return confirm('Are you sure to delete the selected items?')" type="submit" class="btn btn-danger mb-3" id="deleteButton"><i class="fa-solid fa-trash me-1"></i> <span>Delete</span></button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <span>
                                        <input type="checkbox" name="selectAll" id="selectAll">
                                    </span>
                                </th>
                                <th>Order</th>
                                <th>Order Date</th>
                                <th>Customer</th>
                                <th>Delivery Method</th>
                                <th>Total Amount</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th class="text-center">Confirm</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>
                                    <span>
                                        <input type="checkbox" name="orders[]" value="{{ $order->o_id }}">
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ URL::to('/admin/orders/update?id='.$order->o_id) }}" class="edit me-3">#0{{ $order->o_id }}</a>
                                </td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->fullname }}</td>
                                <td>{{ $order->delivery_method }}</td>
                                <td>{{ $order->total_pay }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->order_note }}</td>
                                <td>{{ $order->status }}</td>
                                <td class="text-center">
                                    <a href="{{ URL::to("/admin/orders/confirmOrderStatus?id=".$order->o_id."&status=To Delivery") }}" class=""><i class="fa-solid fa-circle-check fs-1 text-primary"></i></a>
                                    <a onclick="return confirm('Do you want cancel confirmation of this order?')" href="{{ URL::to("/admin/orders/confirmOrderStatus?id=".$order->o_id."&status=Canceled") }}" class=""><i class="fa-solid fa-circle-xmark fs-1 text-danger"></i></a>
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
