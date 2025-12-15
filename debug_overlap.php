<?php

use App\Models\Car;
use App\Models\Maintenance;

$car = Car::where('license_plate', 'W 1234 ABC')->first();
$maintenance = Maintenance::where('car_id', $car->id)->first();

echo "Maintenance Details:\n";
echo "Start: " . $maintenance->date->format('Y-m-d H:i:s') . "\n";
echo "End: " . $maintenance->end_date->format('Y-m-d H:i:s') . "\n\n";

// Test 5: Overlapping end
$start5 = \Carbon\Carbon::parse('2025-12-26 10:00:00');
$end5 = \Carbon\Carbon::parse('2025-12-28 15:00:00');

echo "Test 5 Request:\n";
echo "Start: " . $start5->format('Y-m-d H:i:s') . "\n";
echo "End: " . $end5->format('Y-m-d H:i:s') . "\n\n";

echo "Overlap Check:\n";
echo "maintenance_start < requested_end: " . ($maintenance->date < $end5 ? 'true' : 'false') . "\n";
echo "  (" . $maintenance->date->format('Y-m-d H:i:s') . " < " . $end5->format('Y-m-d H:i:s') . ")\n";
echo "maintenance_end > requested_start: " . ($maintenance->end_date > $start5 ? 'true' : 'false') . "\n";
echo "  (" . $maintenance->end_date->format('Y-m-d H:i:s') . " > " . $start5->format('Y-m-d H:i:s') . ")\n\n";

echo "Should overlap: " . (($maintenance->date < $end5 && $maintenance->end_date > $start5) ? 'YES' : 'NO') . "\n";
echo "Available: " . ($car->isAvailable($start5, $end5) ? 'Yes' : 'No') . "\n";
