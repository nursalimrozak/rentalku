@extends('layouts.admin')

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h4 class="mb-1">Coupons / Vouchers</h4>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Coupons</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
        <div class="mb-2">
            <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary d-flex align-items-center"><i class="ti ti-plus me-2"></i>Add New Coupon</a>
        </div>
    </div>
</div>

<div class="custom-datatable-filter table-responsive">
    <table class="table datatable">
        <thead class="thead-light">
            <tr>
                <th>CODE</th>
                <th>TYPE</th>
                <th>VALUE</th>
                <th>DATE RANGE</th>
                <th>QUOTA (USED)</th>
                <th>APPLICABLE FOR</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vouchers as $voucher)
            <tr>
                <td class="fw-bold">{{ $voucher->code }}</td>
                <td>{{ ucfirst($voucher->type) }}</td>
                <td>
                    @if($voucher->type == 'fixed')
                        Rp {{ number_format($voucher->value, 0, ',', '.') }}
                    @else
                        {{ $voucher->value }}%
                    @endif
                </td>
                <td>
                    @if($voucher->start_date && $voucher->end_date)
                        {{ $voucher->start_date->format('d M') }} - {{ $voucher->end_date->format('d M Y') }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $voucher->quota }} <span class="text-muted">({{ $voucher->used_count }})</span></td>
                <td>{{ $voucher->brand ? 'Brand: ' . $voucher->brand : 'All Brands' }}</td>
                <td>
                    <span class="badge {{ $voucher->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $voucher->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-2">
                            <li>
                                <a class="dropdown-item rounded-1" href="{{ route('admin.vouchers.edit', $voucher->uuid) }}"><i class="ti ti-edit me-1"></i>Edit</a>
                            </li>
                            <li>
                                <form action="{{ route('admin.vouchers.destroy', $voucher->uuid) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item rounded-1"><i class="ti ti-trash me-1"></i>Delete</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
