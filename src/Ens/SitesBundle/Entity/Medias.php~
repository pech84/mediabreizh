<?php

namespace Ens\SitesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medias
 */
class Medias
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    public $file;


    /**
     * @var string
     */
    private $type;


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
     * Set name
     *
     * @param string $name
     * @return Medias
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }



    /**
     * Set post_id
     *
     * @param  $postId
     * @return Medias
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
    
        return $this;
    }

    /**
     * Get post_id
     *
     * @return integer
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Medias
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }


    protected function getUploadDir()
    {
        return 'uploads/medias/'.date('y-m');
    }
     
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
     
    public function getWebPath()
    {
        return null === $this->name ? null : $this->getUploadDir().'/'.$this->name;
    }
     
    public function getAbsolutePath()
    {
        return null === $this->name ? null : $this->getUploadRootDir().'/'.$this->name;
    }



    /**
     * @ORM\PrePersist
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // do whatever you want to generate a unique name
            $this->name = date('y-m').'/'.$this->name.'-'.uniqid().'.'.$this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }
         
          // if there is an error when moving the file, an exception will
          // be automatically thrown by move(). This will properly prevent
          // the entity from being persisted to the database on error
          $this->file->move($this->getUploadRootDir(), $this->name);
         
          unset($this->file);
    }

    /**
     * @ORM\PostRemove
     */
    public function removeUpload()
    {
         if ($file = $this->getAbsolutePath()) {
            unlink($file);
          }
    }
    /**
     * @var integer
     */
    private $postId;


}