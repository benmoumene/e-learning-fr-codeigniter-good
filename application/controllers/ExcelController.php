<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Doctrine\Common\ClassLoader;

class ExcelController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        /*REDIRECT IF CURRENT USER IS NOT ADMIN*/
        if (is_null(get_cookie('ux_ad_1C89DS7CDS8CD89CSD7CSDDSVDSIJPIOCDS')) && is_null(get_cookie('ux_ad_189CDS8CSDC98JCPDSCDSCDSCDSD8C9SD'))){
            redirect(site_url("accueil"));
        }
        
        $this->load->library('session');
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
        $import = $this->session->flashdata('import_success');
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
     */
    public function import()
    {
        /*
         * Si le fichier n'a pas de nom ou si sont extension n'est pas .xlsx alors on redirige vers la page en
         * affichant un message d'erreur
         */
        $inputFileType = 'Xlsx';
        $inputFileName = $_FILES['file']['tmp_name'];

        /**
         * Idenfication du type de $inputFileName *
         */
        try {
            $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
        } catch (Exception $e) {
            $this->session->set_flashdata("import_success", "Le fichier sélectionné n'est pas un fichier excel(avec l'extension .xlsx).");
            redirect(site_url("acces"));
        }

        /**
         * Creation d'un Reader du type identifiee *
         */
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

        /**
         * Chargement de $inputFileName dans un objet Spreadsheet *
         */
        $spreadsheet = $reader->load($inputFileName);

        /**
         * Conversion de la feuille de calcul en un tableau *
         */
        $eleves = $spreadsheet->getActiveSheet()->toArray();

        $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($this->doctrine->em);
        $classes = $this->doctrine->em->getMetadataFactory()->getAllMetadata();
        $schemaTool->updateSchema($classes);

        $entitiesClassLoader = new ClassLoader('models', rtrim(APPPATH, "/"));

        $entitiesClassLoader->register();

        /*
         * PERMET D'INSERER L'ENSEIGNANTE,
         * DECOMMENTER CE CODE UNIQUEMENT SI BESOIN
         * $enseignant = new Enseignant();
         * $enseignant->setNom("Nourhene Ben Rabah");
         * $enseignant->setEmail("tt9814023@gmail.com");
         *
         * $this->load->library('encrypt');
         * $mdp = $this->encrypt->encode('admin');
         * $enseignant->setMotDePasse($mdp);
         * $this->em->persist($enseignant);
         */

        $emailSent = true;
        $i = 0;
        foreach ($eleves as $eleve) {
            if ($i ++ > 0) {
                if (isset($eleve[0]) && isset($eleve[1])) {
                    $nouvelEleve = new Eleve();
                    $nouvelEleve->setNom($eleve[0]);
                    $nouvelEleve->setPrenom($eleve[1]);
                    $nouvelEleve->setEmail($eleve[2]);
                    /* Le mot de passe sera genere par le helper appelle dans la methode set */

                    $this->load->library('encrypt');
                    $mdpBeforeEncryption = $nouvelEleve->get_random_password();
                    $nouvelEleve->setMotDePasse($this->encrypt->encode($mdpBeforeEncryption));

                    echo ($mdpBeforeEncryption . '<br>');

                    /* On capture les exception afin de ne pas afficher les logs de doctrine à l'utilisateur */
                    try {
                        $this->doctrine->em->persist($nouvelEleve);
                        $this->doctrine->em->flush();
                    } catch (Doctrine\DBAL\DBALException | Doctrine\DBAL\ConnectionException $e) {
                        $this->session->set_flashdata("import_success", "L'importation des élèves a échoué.");
                        redirect(site_url("acces"));
                        exit();
                    }

                    if (! ($this->send_email_to_students($nouvelEleve->getEmail(), $mdpBeforeEncryption))) {
                        $emailSent = false;
                    }
                }
            }
        }

        if ($emailSent) {
            $this->session->set_flashdata("import_success", "L'importation des élèves a été effectué.");
        }
        redirect(site_url("acces"));
    }

    public function send_email_to_students($email, $mdp)
    {
        // Load email library
        $this->load->library('email');
        /*on appel le fichier de config email(non natif) qui contient un
         * tableau de config pour envoyer des emails
         * */
        $this->config->load('email');
        $config = $this->config->item('email');
       
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from($config['smtp_user']);
        $this->email->to($email);
        $this->email->subject("Votre inscription sur le site du cours UX a été effectuée");
        $this->email->message("Voici vos identifiant pour vous connecter sur le site du cours UX : <br>  <b>Email : </b>" . $email . "<br>   <b>Mot de passe : </b>" . $mdp);
        // Send mail
        if ($this->email->send()) {
            return true;
        }

        return false;
    }
}