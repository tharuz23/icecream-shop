<td>
  <?php if ($status === 'completed'): ?>
    <button class="btn btn-success btn-sm" disabled>Completed</button>
  <?php else: ?>
    <a href="mark_completed.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-success">Mark as Completed</a>
  <?php endif; ?>
</td>
