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
        if ($_SESSION['user'] == 'admin') {
            // on recupere tous les classes
            $this->doctrine->em->beginTransaction();
            $this->doctrine->refreshSchema();
            $classeRepository = $this->doctrine->em->getRepository('Classe');
            $classes = $classeRepository->findAll();
            
            $eleveRepository = $this->doctrine->em->getRepository('Eleve');
            $elevesByClasseId = array();
            
            foreach ($classes as $classe){
                if(!array_key_exists($classe->getId(), $elevesByClasseId)){
                    $elevesByClasseId[$classe->getId()] = $eleveRepository->findBy(array('classe' => $classe->getId()));
                }
            }
            $data["eleveList"] = $elevesByClasseId;
            
            $data["classeList"] = $classes;
        } else {
            redirect(site_url("accueil"));
        }
        $this->load->view($this->page, $data);
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
        redirect(site_url($this->page));
    }
}
