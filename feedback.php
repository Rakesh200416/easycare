<?php
// Assuming you're already connected to your database
include 'db.php';

$feedbacks = [];

// Check if feedback is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['feedback_name'];
    $email = $_POST['feedback_email'];
    $comment = $_POST['feedback_comment'];
    $rating = $_POST['rating'];

    // Insert feedback into the database
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, comment, rating) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $email, $comment, $rating);
    $stmt->execute();
    $stmt->close();

    // Fetch all feedbacks to display
    $result = $conn->query("SELECT name, comment, rating FROM feedback ORDER BY id DESC");
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
    <link rel="stylesheet" href="path/to/your/bootstrap.css"> <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="feed.css"> <!-- Custom CSS -->
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
    <div class="feedback-section">
        <h1 class="mb-4 text-center">Feedback</h1>
        <form action="" method="post" class="bg-light p-4 rounded shadow feedback-form">
            <div class="row g-3">
                <div class="col-12 col-sm-6">
                    <input type="text" name="feedback_name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="col-12 col-sm-6">
                    <input type="email" name="feedback_email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="col-12">
                    <textarea name="feedback_comment" class="form-control" placeholder="Your Feedback" rows="5" required></textarea>
                </div>
                <div class="col-12">
                    <label for="rating" class="form-label">Rating:</label>
                    <select name="rating" class="form-select" required>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                </div>
                <div class="col-12">
                    <button class="btn btn-dark w-100 py-3" type="submit">Submit Feedback</button>
                </div>
            </div>
        </form>
    </div>
</div>


        <!-- Display submitted feedback -->
        <div class="feedback-display mt-4">
    <h2 class="mb-3 text-center">Submitted Feedback</h2>
    <?php if (!empty($feedbacks)): ?>
        <ul class="list-unstyled">
            <?php foreach ($feedbacks as $feedback): ?>
                <li class="feedback-item">
                    <strong><?php echo htmlspecialchars($feedback['name']); ?></strong>
                    <p><?php echo htmlspecialchars($feedback['comment']); ?></p>
                    <small class="rating">Rating: <?php echo str_repeat('⭐', $feedback['rating']); ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No feedback submitted yet.</p>
    <?php endif; ?>
</div>

</div>

<script src="path/to/your/bootstrap.bundle.js"></script> <!-- Bootstrap JS -->
</body>
</html>
