@extends('layouts.admin')

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h4 class="mb-1">Seasonal Pricing</h4>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Seasonal Pricing</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
        <div class="mb-2">
            <a href="{{ route('admin.seasonal-prices.create') }}" class="btn btn-primary d-flex align-items-center"><i class="ti ti-plus me-2"></i>Add New Rule</a>
        </div>
    </div>
</div>

<div class="custom-datatable-filter table-responsive">
    <table class="table datatable">
        <thead class="thead-light">
            <tr>
                <th>NAME</th>
                <th>START DATE</th>
                <th>END DATE</th>
                <th>PRICE INCREASE</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seasonalPrices as $price)
            <tr>
                <td>{{ $price->name }}</td>
                <td>{{ $price->start_date->format('d M Y') }}</td>
                <td>{{ $price->end_date->format('d M Y') }}</td>
                <td>Rp {{ number_format($price->price_increase, 0, ',', '.') }}</td>
                <td>
                    <span class="badge {{ $price->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $price->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-2">
                            <li>
                                <a class="dropdown-item rounded-1" href="{{ route('admin.seasonal-prices.edit', $price->uuid) }}"><i class="ti ti-edit me-1"></i>Edit</a>
                            </li>
                            <li>
                                <form action="{{ route('admin.seasonal-prices.destroy', $price->uuid) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
