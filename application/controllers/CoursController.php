<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Doctrine\Common\ClassLoader,
Doctrine\ORM\Configuration,
Doctrine\ORM\EntityManager,
Doctrine\Common\Cache\ArrayCache,
Doctrine\DBAL\Logging\EchoSQLLogger;
require './vendor/autoload.php';
class CoursController extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $connectionOptions = array(
            'driver' => 'pdo_mysql',
            'user' =>     'root',
            'password' => '',
            'host' =>     'localhost',
            'dbname' =>   'test'
        );
        
        
        // Set up caches
        $config = new Configuration;
        $cache = new ArrayCache;
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH.'models/'));
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);
        
        $config->setQueryCacheImpl($cache);
        
        // Proxy configuration
        $config->setProxyDir(APPPATH.'/models/proxies');
        $config->setProxyNamespace('Proxies');
        
        // Set up logger
        $logger = new EchoSQLLogger;
        $config->setSQLLogger($logger);
        
        $config->setAutoGenerateProxyClasses( TRUE );
        
        // Create EntityManager
        $this->em = EntityManager::create($connectionOptions, $config);
    }
    
    
    public function index() {
        $this->load->helper('cookie');
        $this->load->helper('form');
        $this->load->view('creer_cours');
    }
    
    public function creer_cours() {
        $this->load->model("cours");
        $cours = new Cours;
        $this->load->model("document");
        $cours->setIntitule($this->input->post('nom_cours'));
        $this->em->persist($cours);
        
        if(!empty($_FILES['files']['tmp_name'][0])){
            $this->do_upload($cours);    
        }
        $this->em->flush();
    }
    
    
    public function do_upload($cours) {
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024"
        );
        
        $count = count($_FILES['files']['name']);
        
        for ($i = 0; $i < $count; $i++) {
            $config['file_name'] = $_FILES['files']['name'][$i];
        
            if(!empty($_FILES['files']['tmp_name'][$i])){
                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];
                
                $this->load->library('upload', $config);
                if($this->upload->do_upload('file'))
                {            
                   
                    echo 'uploaded';
                    $this->load->model("cours");
                    $this->load->model("document");
                    $document = new Document;
                    
                    $document->setCours($cours);
                    $document->setNom($_FILES['file']['name']);
                    $document->setPath("./uploads/".$_FILES['file']['name']);
                    $this->em->persist($document);
                    
                }
                else
                {
                    echo 'not uploaded';
                }
                $this->em->flush();
            }
        }
   }
}
