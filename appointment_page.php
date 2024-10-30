<?php
$feedbacks = json_decode(file_get_contents('feedbacks.json'), true);
?>

<div class="feedback-display">
    <h2>Feedback from Patients</h2>
    <?php if (!empty($feedbacks)): ?>
        <ul>
            <?php foreach ($feedbacks as $feedback): ?>
                <li>
                    <strong><?php echo htmlspecialchars($feedback['name']); ?></strong> (Rating: <?php echo htmlspecialchars($feedback['rating']); ?>)
                    <p><?php echo htmlspecialchars($feedback['comment']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No feedback available.</p>
    <?php endif; ?>
</div>
