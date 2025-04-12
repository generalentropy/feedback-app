<?php include 'inc/header.php'; ?>

<div class="container my-5">
  
  <?php
$sql = 'SELECT * FROM feedback ORDER BY id DESC';
$result = mysqli_query($conn, $sql);
$feedbacks = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
  
  <h2 class="mb-4">Feedback</h2>
  
  <?php if (empty($feedbacks)): ?>
      <p class="lead">There is no feedback 👀</p>
  <?php else: ?>
      <?php foreach ($feedbacks as $item): ?>
          <div class="card mb-3 border">
              <div class="card-body">
                  <p class="card-text">
                     
                      <?php echo $item['body'] ?? ''; ?>
                  </p>
              </div>
              <div class="card-footer d-flex justify-content-between align-items-center bg-light">
                  <h5 class="mb-0">
                      <i class="bi bi-person-fill text-secondary me-1"></i>
                      <?php echo $item['name'] ?? ''; ?>
                  </h5>
                  <small class="text-muted"><?php echo $item['date']; ?></small>
              </div>
          </div>
      <?php endforeach; ?>
  <?php endif; ?>
</div>

<?php include 'inc/footer.php'; ?>
