<?php $this->load->view("page_template/header"); ?>

<div class="card" style="width: 60%;margin: 20px auto">
    <div class="card-body">

<div class="list-group">
  <a href="publications?numero=1" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Publication 1</h5>
      <small>3 days ago</small>
    </div>
    <p class="mb-1">Description publication 1</p>
  </a>
  <a href="publications?numero=2" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Publication 2</h5>
      <small class="text-muted">3 days ago</small>
    </div>
    <p class="mb-1">Description publication 2</p>
  </a>
</div>

</div>
</div>

<?php $this->load->view("page_template/footer");?>

</body>
</html>