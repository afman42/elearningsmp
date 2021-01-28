</div>
<footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<script src="<?= base_url();?>RuangAdmin/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url();?>RuangAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url();?>RuangAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url();?>RuangAdmin/js/ruang-admin.min.js"></script>
<script src="<?= base_url();?>RuangAdmin/vendor/chart.js/Chart.min.js"></script>
<script src="<?= base_url();?>RuangAdmin/js/demo/chart-area-demo.js"></script>
<script src="<?= base_url();?>RuangAdmin/vendor/tinymce/tinymce.min.js"></script>
<!-- Page level plugins -->
<script src="<?= base_url();?>RuangAdmin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>RuangAdmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable
      
      tinymce.init({
        selector: '#post-content',
        plugins: 'table advlist lists hr link autoresize',
        toolbar: 'formatselect bold forecolor backcolor | bullist numlist | anchor | table',
      });

      tinymce.init({
        selector: '#post-content1',
        plugins: 'table advlist lists image media anchor hr link autoresize',
        toolbar: 'formatselect bold forecolor backcolor | bullist numlist | link image media anchor | table | code',
      });

      tinymce.init({
        selector: '#post-content2',
        plugins: 'table advlist lists image media anchor hr link autoresize',
        toolbar: 'formatselect bold forecolor backcolor | bullist numlist | link image media anchor | table | code',
      });

      tinymce.init({
        selector: '#post-content3',
        plugins: 'table advlist lists image media anchor hr link autoresize',
        toolbar: 'formatselect bold forecolor backcolor | bullist numlist | link image media anchor | table | code',
      });

      tinymce.init({
        selector: '#post-content4',
        plugins: 'table advlist lists image media anchor hr link autoresize',
        toolbar: 'formatselect bold forecolor backcolor | bullist numlist | link image media anchor | table | code',
      });
    });
  </script>
</body>

</html>