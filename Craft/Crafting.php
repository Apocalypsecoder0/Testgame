<?php>
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to check resources and craft an item
function craft_item($conn, $item_name, $quantity) {
    // Get the crafting recipe for the item
    $sql = "SELECT resource_name, amount FROM crafting_recipes WHERE item_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $item_name);
    $stmt->execute();
    $result = $stmt->get_result();

    $total_required = [];
    while ($row = $result->fetch_assoc()) {
        $total_required[$row['resource_name']] = $row['amount'] * $quantity;
    }

    // Check if all required resources are available
    foreach ($total_required as $resource => $amount) {
        $sql = "SELECT quantity FROM resources WHERE resource_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $resource);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows == 0 || $res->fetch_assoc()['quantity'] < $amount) {
            return "Failure: Not enough resources to craft $quantity of $item_name";
        }
    }

    // If all resources are available, craft the item
    foreach ($total_required as $resource => $amount) {
        $sql = "UPDATE resources SET quantity = quantity - ? WHERE resource_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $amount, $resource);
        $stmt->execute();
    }

    return "Success: Crafted $quantity of $item_name!";
}

// Example of crafting items
echo craft_item($conn, 'wooden_sword', 2) . "<br>";  // Attempt to craft 2 wooden swords
echo craft_item($conn, 'stone_pickaxe', 1) . "<br>"; // Attempt to craft 1 stone pickaxe
echo craft_item($conn, 'metal_shield', 2) . "<br>";  // Attempt to craft 2 metal shields
echo craft_item($conn, 'wooden_sword', 5) . "<br>";  // Attempt to craft 5 wooden swords (should fail)

// Close the connection
$conn->close();
?>
