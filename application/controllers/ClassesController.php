<?php
defined('BASEPATH') || exit('No direct script access allowed');
use Doctrine\Common\ClassLoader;

/**
 * Ce controller est le controller de la rubrique classes
 * permettant à l'enseignant de supprimer des eleves ou
 * l'une de ses classes ou de creer une classe
 *
 * @author Mickael GUDIN <mickaelgudin@gmail.com>
 */
class ClassesController extends CI_Controller
{
    private $page = 'classes';
    
    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model("dao/ClasseDAO");
        $this->load->model("dao/EleveDAO");
        $this->load->model("entity/Classe");
        $this->load->model("entity/Eleve");
        $this->load->model("entity/Evaluation");
        $this->load->model("entity/Cours");
        $this->load->model("entity/Quiz");
        
        $this->load->library('session');
        $this->load->library("encrypt");
        $this->load->helper('form');
    }
    
    /**
     * charge la vue de classe pour 
     * l'enseignante ou l'accueil pour les autres
     * @return void
     */
    public function index()
    {
        $data['controller'] = $this; 
        $this->load->view($this->page, $data);
    }
    
    public function getClasses() {
        // on recupere tous les classes
        $this->doctrine->em->beginTransaction();
        $this->doctrine->refreshSchema();
        $classes = $this->ClasseDAO->getListClasse();
        
        echo json_encode($classes);
        
    }
    
    public function getElevesByClasseId() {
        $this->doctrine->em->beginTransaction();
        $this->doctrine->refreshSchema();
        $eleves = $this->EleveDAO->getListElevesByClasseId();
        
        echo json_encode($eleves);
    }
    
    /**
     *  function permettant de 
     *  supprimer un Eleve
     *  @return void
     */
    public function removeEleve(){
        $this->doctrine->em->beginTransaction();
        $this->doctrine->refreshSchema();
        
        $eleve = $this->doctrine->em->find("Eleve", $this->input->post('eleve_id'));
        $this->doctrine->em->remove($eleve);
        $this->doctrine->em->commit();
        $this->doctrine->em->flush();
        redirect(site_url($this->page));
    }
    
    /**
     *  function permettant de
     *  supprimer une Classe
     *  @return void
     */
    public function removeClasse(){
        $this->doctrine->em->beginTransaction();
        $this->doctrine->refreshSchema();
       
        $classe = $this->doctrine->em->find("Classe", $this->input->post('classe_id'));
        
        $this->doctrine->em->remove($classe);
        $this->doctrine->em->commit();
        $this->doctrine->em->flush();
        redirect(site_url($this->page));
    }
    
    /**
     *  function permettant de
     *  creer une Classe
     *  @return void
     */
    public function createClasse(){
        $this->doctrine->em->beginTransaction();
        $this->doctrine->refreshSchema();
        $classe = new Classe();
        $classe->setNom($this->input->post('class_name'));
        $this->doctrine->em->persist($classe);
        $this->doctrine->em->commit();
        $this->doctrine->em->flush();
    }
}
