@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title d-flex align-items-center">
                                <div>Chi tiết hoá đơn</div>
                                <a href="{{ route('admin.orders.list') }}" class="btn btn-success text-white ml-3 p-1" style="font-size: 12px">Trở lại</a>
                            </h4>
                        </div>
                        <div class="card-body ">
                            @csrf()
                            <div class="row mx-2">
                                <div class="col-md-4 d-flex justify-content-between py-2 border-left border-right border-left border-right">
                                    <label class="d-flex align-items-center m-0">Mã hoá đơn</label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-group m-0">
                                            <strong class="text-primary p-2 bg-light">
                                                {{ $order->id }}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex justify-content-between py-2 border-left border-right">
                                    <label class="d-flex align-items-center m-0">Người đặt</label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-group m-0">
                                            <strong class="text-primary p-2 bg-light">
                                                {{ $order->user->name }} ({{$order->address_delivery->phone}})
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex justify-content-between py-2 border-left border-right">
                                    <label class="d-flex align-items-center m-0">Phương thức</label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-group m-0">
                                            <strong class="text-primary p-2 bg-light">
                                                {{ $order->payment->payment_type }}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex justify-content-between py-2 border-left border-right">
                                    <label class="d-flex align-items-center m-0">Đơn vị giao hàng</label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-group m-0">
                                            <strong class="text-primary p-2 bg-light">
                                                {{ $order->shipper->shipper_name }}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex justify-content-between py-2 border-left border-right">
                                    <label class="d-flex align-items-center m-0">Địa chỉ vận chuyển</label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-group m-0 change-delivery" style="cursor: pointer">
                                            <strong class="{{ $order->address_delivery? 'text-primary':'text-danger' }} p-2 bg-light">
                                                {{ $order->address_delivery?$order->address_delivery->address:'Chưa đặt' }}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex justify-content-between py-2 border-left border-right">
                                    <label class="d-flex align-items-center m-0">Trạng thái</label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-group m-0 change-delivery" style="cursor: pointer">
                                            <strong class="text-{{ $order->status_class }} p-2 bg-light transaction_status">
                                                {{ $order->status }}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex justify-content-between py-2 border-left border-right">
                                    <label class="d-flex align-items-center m-0">Tổng tiền</label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-group m-0 change-delivery" style="cursor: pointer">
                                            <strong class="p-2 bg-light">
                                                {{ number_format($order->total_price) }} đ
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex justify-content-between py-2 border-left border-right">
                                    <label class="d-flex align-items-center m-0">Phí vận chuyển</label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-group m-0 change-delivery" style="cursor: pointer">
                                            <strong class="p-2 bg-light">
                                                {{ number_format($order->ship_cost) }} đ
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-header">
                            <h4 class="card-title">Danh sách mặt hàng đã mua</h4>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive table-hover" style="overflow: hidden;">
                                <table class="table table-condensed">
                                    <thead class="text-primary">
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th class="text-center">
                                            <i class="fa fa-signature"></i>
                                        </th>
                                        <th class="text-center">
                                            <i class="fa fa-image"></i>
                                        </th>
                                        <th class="text-center">
                                            <i class="fa fa-sticky-note"></i>
                                        </th>
                                        <th class="text-center">
                                            <i class="fa fa-user"></i>
                                        </th>
                                        <th class="text-center">
                                            <i class="fa fa-eye"></i>
                                        </th>
                                        <th class="text-center">
                                            <i class="fa fa-dollar-sign"></i>
                                        </th>
                                        <th class="text-center">
                                            <i class="fa fa-ballot"></i>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (!count($flowers))
                                        <tr>
                                            <td class="text-center" colspan="12">Không có hoa nào trong cơ sở dữ
                                                liệu
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($flowers as $flower)
                                        <tr>
                                            <td class="text-center">
                                                {{$flower->id}}
                                            </td>
                                            <td>
                                                {{ $flower->name }}
                                            </td>
                                            <td width="10%">
                                                <img src="{{ '/images/'.$flower->image }}" alt="">
                                            </td>
                                            <td width="20%">
                                                {!! str_limit($flower->message, 100) !!}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.salers.view', ['id' => $flower->admin->id]) }}">{{ $flower->admin->name }}</a>
                                            </td>
                                            <td>
                                                {{ $flower->views }}
                                            </td>
                                            <td>
                                                {{ number_format($flower->salePrice) }}đ ({{ $flower->sale }})
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <a class="btn btn-success pull-right order-confirm-btn"
                                           {{ !$order->transaction_status ? '' : 'disabled' }}
                                           data-id="{{ $order->id }}" data-action="{{ route('admin.orders.confirm') }}">
                                            Chốt đơn
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
