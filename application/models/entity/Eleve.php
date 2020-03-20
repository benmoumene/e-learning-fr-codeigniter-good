<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @Entity
 */
class Eleve
{

    /**
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     *
     * @Column(type="string", nullable = false)
     */
    private $nom;

    /**
     *
     * @Column(type="string", nullable = false)
     */
    private $prenom;

    /**
     *
     *  @Column(type="string", nullable = false, unique = true)
     */
    private $email;

    /**
     *
     *  @Column(type="string", nullable = false)
     */
    private $motDePasse;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get mot de passe
     *
     * @return string
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    /**
     * Generate a random password.
     *
     * get_random_password() will return a random password with length 6-8 of lowercase letters only.
     *
     * @access public
     * @param $chars_min the
     *            minimum length of password (optional, default 6)
     * @param $chars_max the
     *            maximum length of password (optional, default 8)
     * @param $use_upper_case boolean
     *            use upper case for letters, means stronger password (optional, default false)
     * @param $include_numbers boolean
     *            include numbers, means stronger password (optional, default false)
     * @param $include_special_chars include
     *            special characters, means stronger password (optional, default false)
     *            
     * @return string containing a random password
     */
    public function get_random_password($chars_min = 8, $chars_max = 10, $use_upper_case = true, $include_numbers = true, $include_special_chars = false)
    {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if ($include_numbers) {
            $selection .= "1234567890";
        }
        if ($include_special_chars) {
            $selection .= "!@\#$%&[]{}?|";
        }

        $password = "";
        for ($i = 0; $i < $length; $i ++) {
            $current_letter = $use_upper_case ? (rand(0, 1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];
            $password .= $current_letter;
        }

        return $password;
    }
}

?>