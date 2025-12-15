@extends('layouts.admin')

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h4 class="mb-1">Bank Accounts</h4>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Bank Accounts</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
        <div class="mb-2">
            <a href="{{ route('admin.bank-accounts.create') }}" class="btn btn-primary d-flex align-items-center"><i class="ti ti-plus me-2"></i>Add New Account</a>
        </div>
    </div>
</div>

<div class="custom-datatable-filter table-responsive">
    <table class="table datatable">
        <thead class="thead-light">
            <tr>
                <th>BANK NAME</th>
                <th>ACCOUNT NUMBER</th>
                <th>ACCOUNT HOLDER</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bankAccounts as $account)
            <tr>
                <td class="fw-bold">{{ $account->bank_name }}</td>
                <td>{{ $account->account_number }}</td>
                <td>{{ $account->account_holder }}</td>
                <td>
                    <span class="badge {{ $account->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $account->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-2">
                            <li>
                                <a class="dropdown-item rounded-1" href="{{ route('admin.bank-accounts.edit', $account->id) }}"><i class="ti ti-edit me-1"></i>Edit</a>
                            </li>
                            <li>
                                <form action="{{ route('admin.bank-accounts.destroy', $account->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
