<?php

use App\Models\Car;
use App\Models\Maintenance;

$car = Car::where('license_plate', 'W 1234 ABC')->first();
echo "Car: " . $car->name . " (" . $car->license_plate . ")\n";
echo "Car Status: " . $car->status . "\n\n";

$maintenances = Maintenance::where('car_id', $car->id)->get();
echo "Maintenances for this car:\n";
foreach ($maintenances as $m) {
    echo "- ID: " . $m->id . "\n";
    echo "  Date: " . $m->date->format('Y-m-d H:i:s') . "\n";
    echo "  End Date: " . ($m->end_date ? $m->end_date->format('Y-m-d H:i:s') : 'NULL') . "\n";
    echo "  Status: " . $m->status . "\n\n";
}

// Now test with exact same date format
echo "\n=== Testing Availability ===\n\n";

$start1 = \Carbon\Carbon::parse('2025-12-16 00:00:00');
$end1 = \Carbon\Carbon::parse('2025-12-18 23:59:59');
echo "Test 1 - During maintenance (16-18 Dec):\n";
echo "Start: " . $start1->format('Y-m-d H:i:s') . "\n";
echo "End: " . $end1->format('Y-m-d H:i:s') . "\n";
echo "Available: " . ($car->isAvailable($start1, $end1) ? 'Yes' : 'No') . "\n\n";
