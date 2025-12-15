<?php

use App\Models\Car;

$car = Car::where('license_plate', 'W 1234 ABC')->first();

echo "=== Maintenance Period: 24-26 Dec 2025 ===\n\n";

// Test 1: Exactly during maintenance (should be NOT available)
$start1 = \Carbon\Carbon::parse('2025-12-25 10:00:00');
$end1 = \Carbon\Carbon::parse('2025-12-25 15:00:00');
echo "Test 1 - During maintenance (25 Dec):\n";
echo "Available: " . ($car->isAvailable($start1, $end1) ? 'Yes ✅' : 'No ❌') . "\n\n";

// Test 2: Before maintenance (should be available)
$start2 = \Carbon\Carbon::parse('2025-12-20 10:00:00');
$end2 = \Carbon\Carbon::parse('2025-12-23 15:00:00');
echo "Test 2 - Before maintenance (20-23 Dec):\n";
echo "Available: " . ($car->isAvailable($start2, $end2) ? 'Yes ✅' : 'No ❌') . "\n\n";

// Test 3: After maintenance (should be available)
$start3 = \Carbon\Carbon::parse('2025-12-27 10:00:00');
$end3 = \Carbon\Carbon::parse('2025-12-28 15:00:00');
echo "Test 3 - After maintenance (27-28 Dec):\n";
echo "Available: " . ($car->isAvailable($start3, $end3) ? 'Yes ✅' : 'No ❌') . "\n\n";

// Test 4: Overlapping start (should be NOT available)
$start4 = \Carbon\Carbon::parse('2025-12-23 10:00:00');
$end4 = \Carbon\Carbon::parse('2025-12-25 15:00:00');
echo "Test 4 - Overlapping start (23-25 Dec):\n";
echo "Available: " . ($car->isAvailable($start4, $end4) ? 'Yes ✅' : 'No ❌') . "\n\n";

// Test 5: Overlapping end (should be NOT available)
$start5 = \Carbon\Carbon::parse('2025-12-26 10:00:00');
$end5 = \Carbon\Carbon::parse('2025-12-28 15:00:00');
echo "Test 5 - Overlapping end (26-28 Dec):\n";
echo "Available: " . ($car->isAvailable($start5, $end5) ? 'Yes ✅' : 'No ❌') . "\n\n";

// Test 6: Completely covers maintenance (should be NOT available)
$start6 = \Carbon\Carbon::parse('2025-12-23 10:00:00');
$end6 = \Carbon\Carbon::parse('2025-12-27 15:00:00');
echo "Test 6 - Covers maintenance (23-27 Dec):\n";
echo "Available: " . ($car->isAvailable($start6, $end6) ? 'Yes ✅' : 'No ❌') . "\n";
