<?php $this->load->view("page_template/header"); ?>

<div id="body" class="mbot">
    <card title="<?=($_SESSION['user'] === "admin") ? "Mes publications" : "Les publications de l'enseignante" ?>">
    	<div class="list-group mt-4">
          <list-item lien="/projetL3/uploads/publications/Papier1.pdf" target="_blank" titre="CBR-ODAF: A Case-Based Reasoning for the Online Diagnosis of All
internal Faults in Automated Production Systems" description=""></list-item>
          <list-item lien="/projetL3/uploads/publications/Papier2.pdf" target="_blank" titre="Machine Learning for a Context Mining Facility" description=""></list-item>
          <list-item lien="/projetL3/uploads/publications/Papier3.pdf" target="_blank" titre="A Framework for Classifying Web attacks while respecting ML Requirements" description=""></list-item>
        </div>
    </card>
</div>

</div>
<script src="/projetL3/application/views/page_template/components_vuejs/list_group.js"></script>

<?php $this->load->view("page_template/footer");?>
</body>
</html>