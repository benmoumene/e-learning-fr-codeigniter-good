<?php $this->load->view("page_template/header"); ?>

<div class="card" style="width: 60%;margin: 20px auto">
    <div class="card-body">
	<h2 class="card-title"><?=($_SESSION["user"] === "admin") ? "Mes publications" : "Les publications de l'enseignante" ?></h2>
    <div class="list-group mt-4">
      
      <list-item lien="https://www.google.com/" titre="Publication 1" description="Description publication 1"></list-item>
      <list-item lien="https://www.google.com/" titre="Publication 2" description="Description publication 2"></list-item>
    </div>

<script src="/projetL3/application/views/page_template/components_vuejs/list_group.js"></script>
</div>
</div>
<?php $this->load->view("page_template/footer");?>

</body>
</html>