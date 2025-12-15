<?php

use App\Models\Maintenance;

// Update existing maintenance to test end of day normalization
$maintenance = Maintenance::where('car_id', function($q) {
    $q->select('id')->from('cars')->where('license_plate', 'W 1234 ABC');
})->first();

if ($maintenance) {
    echo "Before update:\n";
    echo "End Date: " . ($maintenance->end_date ? $maintenance->end_date->format('Y-m-d H:i:s') : 'NULL') . "\n\n";
    
    // Simulate controller logic
    $endDate = \Carbon\Carbon::parse($maintenance->end_date)->endOfDay();
    $maintenance->update(['end_date' => $endDate]);
    
    $maintenance->refresh();
    
    echo "After update:\n";
    echo "End Date: " . $maintenance->end_date->format('Y-m-d H:i:s') . "\n\n";
    
    // Now test availability
    $car = $maintenance->car;
    
    echo "=== Testing Availability ===\n\n";
    
    // Test during last day of maintenance
    $start = \Carbon\Carbon::parse('2025-12-26 10:00:00');
    $end = \Carbon\Carbon::parse('2025-12-26 15:00:00');
    echo "Test: 26 Dec 10:00-15:00 (during last day)\n";
    echo "Available: " . ($car->isAvailable($start, $end) ? 'Yes ✅' : 'No ❌') . "\n\n";
    
    // Test after maintenance
    $start2 = \Carbon\Carbon::parse('2025-12-27 10:00:00');
    $end2 = \Carbon\Carbon::parse('2025-12-27 15:00:00');
    echo "Test: 27 Dec 10:00-15:00 (after maintenance)\n";
    echo "Available: " . ($car->isAvailable($start2, $end2) ? 'Yes ✅' : 'No ❌') . "\n";
}
