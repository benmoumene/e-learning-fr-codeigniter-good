<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CoursController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        /* REDIRECT IF CURRENT USER IS NOT ADMIN */
        if (is_null(get_cookie('ux_ad_1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && is_null(get_cookie('ux_ad_189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))) {
            redirect(site_url("accueil"));
        }
        $this->load->library('session');
        $this->load->helper('form');
        $this->doctrine->em->beginTransaction();
    }

    /**
     * Charge les fonctions utilise pour
     * le formulaire(present dans la vue)
     * puis charge la vue de la page
     *
     * @uses $this->load->helper()
     * @uses $this->load->view()
     *      
     * @return void
     */
    public function index()
    {
        $this->load->helper('cookie');
        $this->load->helper('form');
        $this->load->view('creer_cours');
    }

    /**
     * creer un cours dans la base de donn�es
     * le formulaire(present dans la vue)
     * si des documents sont joints au cours
     * alors on les upload avec la methode
     * do_upload
     *
     * @uses $this->load->model()
     * @uses $this->doctrine->em->persist()
     * @uses $this->do_upload()
     * @uses $this->doctrine->em->flush()
     *      
     * @return void
     */
    public function creer_cours()
    {
        // vérification que le champ intitule est rempli
        if ($this->input->post('nom_cours') == '') {
            $this->session->set_flashdata("cours_champ_required", "Veuillez saisir un nom pour le cours");
            redirect(site_url('cours'));
        }

        $this->load->model("entity/cours");
        $cours = new Cours();
        $this->load->model("entity/document");
        $cours->setIntitule($this->input->post('nom_cours'));
        $this->doctrine->em->persist($cours);

        if (! empty($_FILES['files']['tmp_name'][0])) {
            $this->do_upload($cours);
        }
        $this->doctrine->em->flush();
        $this->doctrine->em->commit();

        $this->session->set_flashdata("import", "Le cours a été crée");
        redirect(site_url("cours"));
    }

    /**
     * permet d'upload les documents
     * joints à un cours
     * dans le dossier uploads
     * situé à la racine du projet
     *
     * @uses $this->load->model()
     * @uses $this->doctrine->em->persist()
     * @uses $this->do_upload()
     * @uses $this->doctrine->em->flush()
     *      
     * @return void
     */
    public function do_upload($cours)
    {
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024"
        );

        $count = count($_FILES['files']['name']);
        $import = 'Le cours ';

        for ($i = 0; $i < $count; $i ++) {
            $config['file_name'] = $_FILES['files']['name'][$i];

            if (! empty($_FILES['files']['tmp_name'][$i])) {
                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('file')) {

                    $import .= 'a été importé';
                    $this->load->model("cours");
                    $this->load->model("document");
                    $document = new Document();

                    $document->setCours($cours);
                    $document->setNom($_FILES['file']['name']);
                    $document->setPath("./uploads/" . $_FILES['file']['name']);
                    $this->doctrine->em->persist($document);
                } else {
                    /*
                     * SI L'UN DES DOCUMENTS N'EST PAS DE TYPE
                     * PDF ALORS ON FAIT UN ROLLBACK
                     * ET AUCUN COURS NI DOCUMENT N'EST CREE
                     */
                    $import = 'Les documents doivent être de type pdf';
                    $this->doctrine->em->rollback();
                    $this->session->set_flashdata("import", $import);
                    redirect(site_url("cours"));
                }
                $this->doctrine->em->flush();
                $this->session->set_flashdata("import", $import);
            }
        }

        if ($count == 0) {
            $this->session->set_flashdata("import", "Le cours a été crée sans documents");
        } else {
            $this->session->set_flashdata("import", "Le cours a été crée avec " . $count . " documents associés");
        }
        $this->doctrine->em->commit();
        redirect(site_url("cours"));
    }
}

