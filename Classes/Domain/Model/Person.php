<?php

declare(strict_types=1);

namespace Hda\HdaPersonen\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2024 Hochschule Darmstadt
 *
 *  All rights reserved

 ***************************************************************/

/**
 * Person
 */
class Person extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
	/**
	 * username
	 *
	 * @var string
	 */
	protected $username = '';

	/**
	 * name
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * email
	 *
	 * @var string
	 */
	protected $email = '';
	
	/**
	 * telephone
	 *
	 * @var string
	 */
	protected $telephone  = '';
	
	/**
	 * fax
	 *
	 * @var string
	 */
	protected $fax = '';

	/**
	 * address 
	 *
	 * @var string
	 */
	protected $address  = '';

	/**
	 * city
	 *
	 * @var string
	 */
	protected $city = '';

	/**
	 * zip
	 *
	 * @var string
	 */
	protected $zip = '';

    /**
     * www
     *
     * @var string
     */
    protected $www = '';
    
	
    /**
     * ownemail
     *
     * @var string
     */
    protected $ownemail = '';  
	
    /**
     * orcid
     *
     * @var string
     */
    protected $orcid = '';  

    /**
     * title
     *
     * @var string
     */
    protected $title = '';

	/**
	 * first_name
	 *
	 * @var string
	 */
	protected $first_name = '';

	/**
	 * last_name 
	 *
	 * @var string
	 */
	protected $last_name  = '';

	/**
	 * company
	 *
	 * @var string
	 */
	protected $company = '';

	/**
	 * roles
	 *
	 * @var string
	 */
	protected $roles = '';

	/**
	 * subtitle
	 *
	 * @var string
	 */
	protected $subtitle = '';
	
	/**
	 * office
	 *
	 * @var string
	 */
	protected $office = '';

	/**
	 * employed
	 *
	 * @var string
	 */
	protected $employed = '';

	/**
	 * salutation
	 *
	 * @var string
	 */
	protected $salutation = '';

	/**
	 * consultation
	 *
	 * @var string
	 */
	protected $consultation = '';

	/**
	 * mobil
	 *
	 * @var string
	 */
	protected $mobil = '';


	/**
	 * profil
	 *
	 * @var string
	 */
	protected $profil = '';

    /**
     * educationalarea
     *
     * @var string
     */
    protected $educationalarea = '';
	
    /**
     * imageref
     *
     * @var string
     */
    protected $imageref = '';

    /**
	 * Returns the username
	 *
	 * @return string $username
	 */
	public function getUsername() {
		return $this->username;
	}
	
	/**
	 * Sets the username
	 *
	 * @param string $username
	 * @return void
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

    /**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

    /**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}


    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle(){
        $displayName = $this->getName();
        $nameArray = explode (',', $displayName);

        if (isset($nameArray[2])) {
            return $nameArray[2];
        } else {
            return;
        }
 
    }
     

	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}
	

	/**
	 * Returns the ownemail
	 *
	 * @return string $ownemail
	 */
	public function getOwnemail() {
		return $this->ownemail;
	}

	/**
	 * Sets the ownemail
	 *
	 * @param string $ownemail
	 * @return void
	 */
	public function setOwnemail($ownemail) {
		$this->ownemail = $ownemail;
	}
	
	/**
	 * Returns the telephone
	 *
	 * @return string $telephone
	 */
	public function getTelephone () {
	    return $this->telephone ;
	}
	
	/**
	 * Sets the telephone
	 *
	 * @param string $telephone
	 * @return void
	 */
	public function setTelephone ($telephone ) {
	    $this->telephone  = $telephone ;
	}

	/**
	 * Returns the fax
	 *
	 * @return string $fax
	 */
	public function getFax() {
		return $this->fax;
	}

	/**
	 * Sets the fax
	 *
	 * @param string $fax
	 * @return void
	 */
	public function setFax($fax) {
		$this->fax = $fax;
	}

	/**
	 * Returns the address 
	 *
	 * @return string $address 
	 */
	public function getAddress () {
		return $this->address ;
	}

	/**
	 * Sets the address 
	 *
	 * @param string $address 
	 * @return void
	 */
	public function setAddress ($address ) {
		$this->address  = $address ;
	}

	/**
	 * Returns the city
	 *
	 * @return string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Returns the zip
	 *
	 * @return string $zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param string $zip
	 * @return void
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

    /**
     * Returns the orcid
     *
     * @return string $orcid
     */
    public function getOrcid() {
        return $this->orcid;
    }

    /**
     * Sets the orcid
     *
     * @param string $orcid
     * @return void
     */
    public function setOrcid($orcid) {
        $this->orcid = $orcid;
    }

    /**
     * Returns the www
     *
     * @return string $www
     */
    public function getWww() {
        return $this->www;
    }

    /**
     * Sets the www
     *
     * @param string $www
     * @return void
     */
    public function setWww($www) {
        $this->www = $www;
    }

	/**
	 * Returns the subtitle
	 *
	 * @return string $subtitle
	 */
	public function getSubtitle() {
		return $this->subtitle;
	}

	/**
	 * Sets the subtitle
	 *
	 * @param string $subtitle
	 * @return void
	 */
	public function setSubtitle($subtitle) {
		$this->subtitle = $subtitle;
	}
	
	/**
	 * Returns the first_name
	 *
	 * @return string $first_name
	 */
	public function getFirstName() {
		//return $this->first_name;
        $displayName = $this->getName();
        $nameArray = explode (',', $displayName);
        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($nameArray);
        $nameArray = $nameArray[1];
        if(strpos($nameArray,"(Stud")!==false){
            $nameArray = substr($nameArray, 0, strpos($nameArray, '(', 0));
        };
        
        return $nameArray;
	}

	/**
	 * Sets the first_name
	 *
	 * @param string $first_name
	 * @return void
	 */
	public function setFirstName($first_name) {
		$this->first_name = $first_name;
	}

	/**
	 * Returns the last_name 
	 *
	 * @return string $last_name 
	 */
	public function getLastName() {
		//return $this->last_name ;
        $displayName = $this->getName();
        $nameArray = explode (',', $displayName);
        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($nameArray);
        return $nameArray[0];
	}

	/**
	 * Sets the last_name 
	 *
	 * @param string $last_name 
	 * @return void
	 */
	public function setLastName($last_name ) {
		$this->last_name  = $last_name ;
	}

	/**
	 * Returns the company
	 *
	 * @return string $company
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * Sets the company
	 *
	 * @param string $company
	 * @return void
	 */
	public function setCompany($company) {
		$this->company = $company;
	}

	/**
	 * Returns the roles
	 *
	 * @return string $roles
	 */
	public function getRoles() {
		return $this->roles;
	}

	/**
	 * Sets the roles
	 *
	 * @param string $roles
	 * @return void
	 */
	public function setRoles($roles) {
		$this->roles = $roles;
	}

	/**
	 * Returns the office
	 *
	 * @return string $office
	 */
	public function getOffice() {
		return $this->office;
	}

	/**
	 * Sets the office
	 *
	 * @param string $office
	 * @return void
	 */
	public function setOffice($office) {
		$this->office = $office;
	}

	/**
	 * Returns the employed
	 *
	 * @return string $employed
	 */
	public function getEmployed() {
		return $this->employed;
	}

	/**
	 * Sets the employed
	 *
	 * @param string $employed
	 * @return void
	 */
	public function setEmployed($employed) {
		$this->employed = $employed;
	}

	/**
	 * Returns the salutation
	 *
	 * @return string $salutation
	 */
	public function getSalutation() {
		return $this->salutation;
	}

	/**
	 * Sets the salutation
	 *
	 * @param string $salutation
	 * @return void
	 */
	public function setSalutation($salutation) {
		$this->salutation = $salutation;
	}

	/**
	 * Returns the consultation
	 *
	 * @return string $consultation
	 */
	public function getConsultation() {
		return $this->consultation;
	}

	/**
	 * Sets the consultation
	 *
	 * @param string $consultation
	 * @return void
	 */
	public function setConsultation($consultation) {
		$this->consultation = $consultation;
	}

	/**
	 * Returns the mobil
	 *
	 * @return string $mobil
	 */
	public function getMobil() {
		return $this->mobil;
	}

	/**
	 * Sets the mobil
	 *
	 * @param string $mobil
	 * @return void
	 */
	public function setMobil($mobil) {
		$this->mobil = $mobil;
	}

	/**
	 * Returns the profil
	 *
	 * @return string $profil
	 */
	public function getProfil() {
		return $this->profil;
	}

	/**
	 * Sets the profil
	 *
	 * @param string $profil
	 * @return void
	 */
	public function setProfil($profil) {
		$this->profil = $profil;
	}
	
	/**
	 * Returns the imageref
	 *
	 * @return string $imageref
	 */
	public function getImageref() {
		return $this->imageref;
	}

	/**
	 * Sets the imageref
	 *
	 * @param string $imageref
	 * @return void
	 */
	public function setImageref($imageref) {
		$this->imageref = $imageref;
	}

	/**
	 * Returns the educationalarea
	 *
	 * @return string $educationalarea
	 */
	public function getEducationalarea() {
		return $this->educationalarea;
	}

	/**
	 * Sets the educationalarea
	 *
	 * @param string $educationalarea
	 * @return void
	 */
	public function setEducationalarea($educationalarea) {
		$this->educationalarea = $educationalarea;
	}
	
}