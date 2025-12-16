@php
    // Determine car status based on dates
    if ($pickupDate && $returnDate) {
        $isAvailable = $car->isAvailable($pickupDate, $returnDate);
        
        // Check if in maintenance
        $inMaintenance = $car->maintenances()
            ->whereIn('status', ['scheduled', 'ongoing'])
            ->where(function($q) use ($pickupDate, $returnDate) {
                $q->where(function($query) use ($pickupDate, $returnDate) {
                    $query->whereNotNull('end_date')
                        ->where('date', '<', $returnDate)
                        ->where('end_date', '>', $pickupDate);
                })->orWhere(function($query) use ($returnDate) {
                    $query->whereNull('end_date')
                        ->where('date', '<=', $returnDate);
                });
            })
            ->exists();
        
        if ($inMaintenance) {
            $statusText = 'Maintenance';
            $statusClass = 'badge-warning';
            $statusIcon = 'ti-tool';
        } elseif ($isAvailable) {
            $statusText = 'Tersedia';
            $statusClass = 'badge-success';
            $statusIcon = 'ti-check';
        } else {
            $statusText = 'Tidak Tersedia';
            $statusClass = 'badge-danger';
            $statusIcon = 'ti-x';
        }
    } else {
        // No dates selected, show general status
        if ($car->status == 'maintenance') {
            $statusText = 'Maintenance';
            $statusClass = 'badge-warning';
            $statusIcon = 'ti-tool';
        } elseif ($car->status == 'available') {
            $statusText = 'Tersedia';
            $statusClass = 'badge-success';
            $statusIcon = 'ti-check';
        } else {
            $statusText = 'Tidak Tersedia';
            $statusClass = 'badge-danger';
            $statusIcon = 'ti-x';
        }
    }
@endphp

<span class="badge {{ $statusClass }}">
    <i class="ti {{ $statusIcon }} me-1"></i>{{ $statusText }}
</span>
