<?php

use App\Models\Car;

$car = Car::where('license_plate', 'W 1234 ABC')->first();

// Test 1: During maintenance (should be NOT available - maintenance starts 16 Dec with no end)
$start1 = new DateTime('2025-12-16');
$end1 = new DateTime('2025-12-18');
echo "Test 1 - During maintenance (16-18 Dec):\n";
echo "Available: " . ($car->isAvailable($start1, $end1) ? 'Yes' : 'No') . "\n\n";

// Test 2: Before maintenance (should be available)
$start2 = new DateTime('2025-12-10');
$end2 = new DateTime('2025-12-15');
echo "Test 2 - Before maintenance (10-15 Dec):\n";
echo "Available: " . ($car->isAvailable($start2, $end2) ? 'Yes' : 'No') . "\n\n";

// Test 3: After maintenance start with no end (should be NOT available)
$start3 = new DateTime('2025-12-20');
$end3 = new DateTime('2025-12-25');
echo "Test 3 - After maintenance start (20-25 Dec):\n";
echo "Available: " . ($car->isAvailable($start3, $end3) ? 'Yes' : 'No') . "\n\n";

// Test 4: Overlapping start (should be NOT available)
$start4 = new DateTime('2025-12-15');
$end4 = new DateTime('2025-12-17');
echo "Test 4 - Overlapping start (15-17 Dec):\n";
echo "Available: " . ($car->isAvailable($start4, $end4) ? 'Yes' : 'No') . "\n\n";

// Test 5: Way in the future (should be NOT available because no end date)
$start5 = new DateTime('2026-01-10');
$end5 = new DateTime('2026-01-15');
echo "Test 5 - Future date (10-15 Jan 2026):\n";
echo "Available: " . ($car->isAvailable($start5, $end5) ? 'Yes' : 'No') . "\n";
