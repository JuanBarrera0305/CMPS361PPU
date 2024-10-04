<?php

$apiURL = "http://localhost:8004/api/v1/library";

// Fetch the data
$response = file_get_contents($apiURL);
// Decode JSON response into an array
$data = json_decode($response, true);

// Validate if data exists
if ($data && is_array($data)) {
    // Pagination setup
    $limit = 10;
    $totalRecords = count($data);
    $totalPages = ceil($totalRecords / $limit); // Calculate number of pages
    
    // Capture the current page or set a default page
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Calculate the starting index of the current page
    if ($currentPage < 1) {
        $currentPage = 1;
    } elseif ($currentPage > $totalPages) {
        $currentPage = $totalPages;
    }

    // Calculate the starting index of the current page
    $startIndex = ($currentPage - 1) * $limit;
     
    // Get the subset of data for the current page
    $pageData = array_slice($data, $startIndex, $limit);

    // Build out the table
    echo "<table border='1' cellpadding='10'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID Number</th>";
    echo "<th>Book Type</th>";
    echo "<th>Book Name</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Loop through the data
    foreach ($pageData as $post) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($post['id']) . "</td>";
        echo "<td>" . htmlspecialchars($post['booktype']) . "</td>";
        echo "<td>" . htmlspecialchars($post['bookname']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
     
    // Pagination links
    echo "<div style='margin-top: 20px;'>";

    // Display previous link if not on first page
    if ($currentPage > 1) {
        echo '<a href="?page=' . ($currentPage - 1) . '">Previous</a> ';
    }

    // Display page numbers
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            echo "<strong>$i</strong> ";
        } else {
            echo '<a href="?page=' . $i . '">' . $i . '</a> ';
        }
    }

    // Display "Next" link if not on the last page
    if ($currentPage < $totalPages) {
        echo '<a href="?page=' . ($currentPage + 1) . '">Next</a>';
    }

    echo "</div>";
} else {
    echo "No data available.";
}
?>