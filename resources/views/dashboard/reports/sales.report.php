<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Report</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Optional for charts -->
</head>
<body>

    <h2>Stock Report</h2>

    <!-- Filter Form -->
    <form method="POST" action="">
        <label for="from_date">From:</label>
        <input type="date" id="from_date" name="from_date" required>
        
        <label for="to_date">To:</label>
        <input type="date" id="to_date" name="to_date" required>
        
        <button type="submit">Generate Report</button>
        <a href="generate_pdf.php" target="_blank">Download as PDF</a>
    </form>

    <!-- Report Table -->
    <table border="1">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Stock In</th>
                <th>Stock Out</th>
                <th>Remaining</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "generate_report.php";
            ?>
        </tbody>
    </table>

</body>
</html>
