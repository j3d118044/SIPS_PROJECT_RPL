<?= $this->extend('layouts/pages'); ?>

<?= $this->section('header_js'); ?>
<script>
</script>
<?= $this->endSection(); ?>

<?= $this->section('main_content'); ?>
<!-- Begin Page Content -->
<div class="row row-1">
  <div class="col-lg-12">
    <h1 class="h3 text-gray-900 mb-2 font-weight-bold text-center">Grafik Kuis</h1>
    <hr class="mt-1 mb-2">
    <div class="card o-hidden border-0 shadow-lg">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center" id="chart-container">FusionCharts will render here</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr class="mt-2 mb-1">
  </div>
</div>

<!-- /.container-fluid -->
<?= $this->endSection(); ?>

<?= $this->section('footer_js'); ?>
<!-- FusionCharts -->
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js">
</script>

<!-- jQuery-FusionCharts -->
<script type="text/javascript" src="https://rawgit.com/fusioncharts/fusioncharts-jquery-plugin/develop/dist/fusioncharts.jqueryplugin.min.js">
</script>

<!-- Fusion Theme -->
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js">
</script>

<script>
  const chartData = [{
    label: "Venezuela",
    value: "290"
  }, {
    label: "US",
    value: "30"
  }, {
    label: "China",
    value: "30"
  }]

  const chartConfigs = {
    type: "pie3d",
    width: "800",
    height: "400",
    dataFormat: "jsonurl", // json
    dataSource: window.location.href + '_data'

  }

  // Create a chart container
  $(document).ready(function() {
    $("#chart-container").insertFusionCharts(chartConfigs);
  });
</script>
<?= $this->endSection(); ?>