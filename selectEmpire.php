<?php
// Define empires and their classes
$empires = [
    "Empire A" => "Class 1",
    "Empire B" => "Class 2",
    "Empire C" => "Class 3",
    "Empire D" => "Class 4"
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedEmpire = $_POST['empire'];
    echo "You have selected: " . htmlspecialchars($selectedEmpire);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Empire</title>
</head>
<body>
    <h1>Select Your Empire</h1>
    <form method="post" action="">
        <label for="empire">Choose an empire:</label>
        <select name="empire" id="empire">
            <?php foreach ($empires as $empire => $class): ?>
                <option value="<?php echo $empire; ?>"><?php echo $empire . " - " . $class; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Select">
    </form>
</body>
</html>
