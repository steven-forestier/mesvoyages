<?php

namespace App\Entity;

use Synfony\Component\validator\Constraints as Assert;

/**
 * Description of Contact
 *
 * @author Eydrin
 */
class Contact {
    
    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $nom;
    
    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;
    /**
     * @var string|null
     * @Assert\NotBlank()
     */
    private $message;
    
    function getNom(): ?string {
        return $this->nom;
    }

    function getEmail(): ?string {
        return $this->email;
    }

    function getMessage(): ?string {
        return $this->message;
    }

    function setNom($nom):self {
        $this->nom = $nom;
        return $this;
    }

    function setEmail($email):self {
        $this->email = $email;
        return $this;
    }

    function setMessage($message):self {
        $this->message = $message;
        return $this;
    }


}
