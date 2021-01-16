<?= $this->include('layouts/header'); ?>

  <?= $this->renderSection('header_js'); ?>

</head>
  <?= $this->renderSection('auth_content'); ?>

  <?= $this->include('layouts/footer'); ?>

  <?= $this->renderSection('footer_js'); ?>

</body>
</html>