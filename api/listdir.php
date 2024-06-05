<?php
// Function to list all files and directories
function listFilesAndDirectories($dir) {
    // Open the directory
    if ($handle = opendir($dir)) {
        echo '<ul>';
        
        // Loop through the directory contents
        while (false !== ($entry = readdir($handle))) {
            // Skip the current and parent directory entries
            if ($entry != "." && $entry != "..") {
                echo '<li>' . htmlspecialchars($entry);

                // If the entry is a directory, list its contents recursively
                if (is_dir($dir . '/' . $entry)) {
                    listFilesAndDirectories($dir . '/' . $entry);
                }

                echo '</li>';
            }
        }

        echo '</ul>';
        
        // Close the directory handle
        closedir($handle);
    } else {
        echo "Unable to open directory: $dir";
    }
}

// Set the directory to the current working directory
$directory = getcwd();

echo "<h1>Contents of Directory: " . htmlspecialchars($directory) . "</h1>";
listFilesAndDirectories($directory);
?>
