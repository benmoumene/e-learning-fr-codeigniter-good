<?php $this->load->view("header"); ?>

<div class="list-group">
  
  <?php foreach ($this->session->flashdata('coursList') as $cours): ?>
      <a href="publications?numero=1" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1"><?=$cours["intitule"]?></h5>
          <small>3 days ago</small>
        </div>
        <p class="mb-1">Description du cours</p>
      </a>
  <?php endforeach;?>
</div>
