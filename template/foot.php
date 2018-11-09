    </main>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">COPYRIGHT &copy; <?= date('Y'); ?></span>
      </div>
    </footer>

<?php if (DEBUG): ?>
    <script src="<?= ROOT_URL ?>/assets/js/jquery.min.js"></script>
    <script src="<?= ROOT_URL ?>/assets/js/bootstrap.min.js"></script>
<?php else: ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<?php endif; ?>

<script>
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
});
</script>

</body>
</html>
<?php require_once __DIR__.'/../includes/terminate.php'; ?>
