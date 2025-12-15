<?php

use App\Models\Maintenance;

$maintenance = Maintenance::where('car_id', function($q) {
    $q->select('id')->from('cars')->where('license_plate', 'W 1234 ABC');
})->first();

if ($maintenance) {
    echo "Current end_date: " . $maintenance->end_date->format('Y-m-d H:i:s') . "\n";
    echo "Timezone: " . date_default_timezone_get() . "\n\n";
    
    // Test Carbon endOfDay
    $testDate = \Carbon\Carbon::parse('2025-12-26');
    echo "Test parse '2025-12-26':\n";
    echo "  Original: " . $testDate->format('Y-m-d H:i:s') . "\n";
    echo "  End of day: " . $testDate->endOfDay()->format('Y-m-d H:i:s') . "\n\n";
    
    // Update with explicit time
    $newEndDate = \Carbon\Carbon::parse('2025-12-26 23:59:59');
    echo "Updating to: " . $newEndDate->format('Y-m-d H:i:s') . "\n";
    $maintenance->end_date = $newEndDate;
    $maintenance->save();
    
    $maintenance->refresh();
    echo "After save: " . $maintenance->end_date->format('Y-m-d H:i:s') . "\n";
}
