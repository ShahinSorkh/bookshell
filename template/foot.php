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
    <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<?php endif; ?>

</body>
</html>
<?php require_once __DIR__.'/../includes/terminate.php'; ?>
