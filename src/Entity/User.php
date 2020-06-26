<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
     
    private $roles = [];
    //rôle = role de l'utilisateur => on définit les fonctions de l'utilisateur

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;// proprité pour le mot de passe = le mot de passe haché on le convertit en md5-
    //on peut le faire avec Bcrypt pour plus de sécurité car le cryptage ne sera jamais le même.
    //le MD5 ne doit pas être utiliser pour des mots de passe 
    //on peut utiliser aussi le argon.
    //sur PHP on utilisera le password ASH ou verify (voir )

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */

     // ci dessous le gestusername =>identifie l'utilisateur et retourne this email. Attention, 
     //ici à la sécurité- Il faut faire attention à la configuration
    public function getUsername(): string

    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    //les  rôles sont simplement des chaines de caracteres et commence par ROLE_
    // ex ROLE_MANAGER ROLE_ADMIN
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';// voir au dessus 

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string // il s'agit de get et set simplement pour le hash
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
        // dans cette méthode il faut supprimer le mot de passe en clair et le remplacer par nul
    }
}
