<?php
// patch.php
//php patch.php path/to/your/file.txt "New Content"

// Function to apply a patch
function applyPatch($filePath, $patchContent) {
    // Read the original file
    $originalContent = file_get_contents($filePath);
    
    // Apply the patch (this is a simple example, real patching is more complex)
    $patchedContent = str_replace("PLACEHOLDER", $patchContent, $originalContent);
    
    // Write the patched content back to the file
    file_put_contents($filePath, $patchedContent);
    
    echo "Patch applied successfully to $filePath\n";
}

// Usage
if ($argc !== 3) {
    echo "Usage: php patch.php <file_path> <patch_content>\n";
    exit(1);
}

$filePath = $argv[1];
$patchContent = $argv[2];

applyPatch($filePath, $patchContent);
?>
