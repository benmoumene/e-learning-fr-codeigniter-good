<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Doctrine\Common\ClassLoader,
Doctrine\ORM\Configuration,
Doctrine\ORM\EntityManager,
Doctrine\Common\Cache\ArrayCache,
Doctrine\DBAL\Logging\EchoSQLLogger;
require './vendor/autoload.php';


class ExcelController extends CI_Controller {

	/**
	 * Charge les fonctions utilise pour
	 * le formulaire(present dans la vue)
	 * puis charge la vue de la page
	 *
	 * @uses $this->load->helper()
	 * @uses $this->load->view()
	 *
	 * @return void
	**/
    public function index() {
        $this->load->helper('cookie');
		$this->load->helper('form');
        $this->load->view('creer_acces');
    }
	
	/**
	 * Charge le fichier excel
	 * lit les donnees du fichier excel
	 * puis inserer les donnees du fichier excel
	 *
	 * @uses \PhpOffice\PhpSpreadsheet\IOFactory::identify()
	 * @uses \PhpOffice\PhpSpreadsheet\IOFactory::createReader()
	 * @uses \PhpOffice\PhpSpreadsheet\IOFactory::createReader()->load()
	 * @uses \PhpOffice\PhpSpreadsheet\IOFactory::createReader()->load()->getActiveSheet()
	 * @uses \PhpOffice\PhpSpreadsheet\IOFactory::createReader()->load()->getActiveSheet()->toArray()
	 *
	 * @return void
	**/
	public function import(){
		
		if(!empty($_FILES['file']['tmp_name'])){
			
			$inputFileType = 'Xlsx';
			$inputFileName = $_FILES['file']['tmp_name'];

			/**  Idenfication du type de $inputFileName  **/
			$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);

			/**  Creation d'un Reader du type identifiee  **/
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

			/**  Chargement de $inputFileName dans un objet Spreadsheet  **/
			$spreadsheet = $reader->load($inputFileName);

			/**  Conversion de la feuille de calcul en un tableau  **/
			$eleves = $spreadsheet->getActiveSheet()->toArray();
			
			/*creation objet eleve avec les donnees puis on le sauvegarde
			 dans la base de donnee avec notre ORM(Eleve herite de ORM)*/
			
			
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
			$driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH.'models/entity'));
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
			
			$schemaTool = new \Doctrine\ORM\Tools\SchemaTool($this->em);
			$classes = $this->em->getMetadataFactory()->getAllMetadata();
			$schemaTool->updateSchema($classes);
			
			$entitiesClassLoader = new ClassLoader('models', rtrim(APPPATH, "/" ));
			
			$entitiesClassLoader->register();
			
			$enseignant = new Enseignant();
			$enseignant->setNom("Nourhene Ben Rabah");
			$enseignant->setEmail("tt9814023@gmail.com");
		
			$this->load->library('encrypt');
			$mdp = $this->encrypt->encode('admin');
			$enseignant->setMotDePasse($mdp);
			$this->em->persist($enseignant);
			
			$i = 0;
			foreach( $eleves as $eleve )
			{          
				if($i++ >0){
					if(isset($eleve[0]) && isset($eleve[1])){
						
					      
					    $nouvelEleve = new Eleve();
					    $nouvelEleve->setNom($eleve[0]);
					    $nouvelEleve->setEmail($eleve[1]);
					    
					    $this->em->persist($nouvelEleve);
					    $this->em->flush();
					}
				}
			}
			
			
		}
	}
    
}