<?php

declare(strict_types=1);

namespace Hda\HdaPersonen\Domain\Model;

use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

/**
 * Person
 */
class Person extends AbstractEntity
{
    /**
     * @Extbase\Validate("StringLength", options={"maximum": 255})
     * @Extbase\Validate("NotEmpty")
     */
    protected $username = '';
    
    /**
     * @Extbase\Validate("StringLength", options={"maximum": 255})
     * @Extbase\Validate("NotEmpty")
     */
    protected $name = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $email = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $telephone  = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $fax = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $address  = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $city = '';
    
    /** @var int */
    protected $zip = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $www = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $ownemail = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $orcid = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $title = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $first_name = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $last_name  = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $company = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $roles = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $subtitle = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $office = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $employed = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $salutation = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $consultation = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $mobil = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $profil = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $educationalarea = '';
    
    /** @Extbase\Validate("StringLength", options={"maximum": 255}) */
    protected $imageref = '';
    
    /**
     * __construct
     */
    public function __construct()
    {
        // Do not remove the next line: It would break the functionality
        $this->initializeObject();
    }
    
    /**
     *
     * @return string $username
     */
    public function getUsername() {
        return $this->username;
    }
    
    /**
     * @param string $username
     * @return void
     */
    public function setUsername($username) {
        $this->username = $username;
    }
    
    /**
     *
     * @return string $name
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * @param string $name
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
    }
    
    
    /**
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
     * @return string $email
     */
    public function getEmail() {
        return $this->email;
    }
    
    /**
     * @param string $email
     * @return void
     */
    public function setEmail($email) {
        $this->email = $email;
    }
    
    
    /**
     * @return string $ownemail
     */
    public function getOwnemail() {
        return $this->ownemail;
    }
    
    /**
     * @param string $ownemail
     * @return void
     */
    public function setOwnemail($ownemail) {
        $this->ownemail = $ownemail;
    }
    
    /**
     * @return string $telephone
     */
    public function getTelephone () {
        return $this->telephone ;
    }
    
    /**
     * @param string $telephone
     * @return void
     */
    public function setTelephone ($telephone ) {
        $this->telephone  = $telephone ;
    }
    
    /**
     * @return string $fax
     */
    public function getFax() {
        return $this->fax;
    }
    
    /**
     * @param string $fax
     * @return void
     */
    public function setFax($fax) {
        $this->fax = $fax;
    }
    
    /**
     * @return string $address
     */
    public function getAddress () {
        return $this->address ;
    }
    
    /**
     * @param string $address
     * @return void
     */
    public function setAddress ($address ) {
        $this->address  = $address ;
    }
    
    /**
     * @return string $city
     */
    public function getCity() {
        return $this->city;
    }
    
    /**
     * @param string $city
     * @return void
     */
    public function setCity($city) {
        $this->city = $city;
    }
    
    /**
     * @return string $zip
     */
    public function getZip() {
        return $this->zip;
    }
    
    /**
     * @param string $zip
     * @return void
     */
    public function setZip($zip) {
        $this->zip = $zip;
    }
    
    /**
     * @return string $orcid
     */
    public function getOrcid() {
        return $this->orcid;
    }
    
    /**
     * @param string $orcid
     * @return void
     */
    public function setOrcid($orcid) {
        $this->orcid = $orcid;
    }
    
    /**
     * @return string $www
     */
    public function getWww() {
        return $this->www;
    }
    
    /**
     * @param string $www
     * @return void
     */
    public function setWww($www) {
        $this->www = $www;
    }
    
    /**
     * @return string $subtitle
     */
    public function getSubtitle() {
        return $this->subtitle;
    }
    
    /**
     * @param string $subtitle
     * @return void
     */
    public function setSubtitle($subtitle) {
        $this->subtitle = $subtitle;
    }
    
    /**
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
     * @param string $first_name
     * @return void
     */
    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }
    
    /**
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
     * @param string $last_name
     * @return void
     */
    public function setLastName($last_name ) {
        $this->last_name  = $last_name ;
    }
    
    /**
     * @return string $company
     */
    public function getCompany() {
        return $this->company;
    }
    
    /**
     * @param string $company
     * @return void
     */
    public function setCompany($company) {
        $this->company = $company;
    }
    
    /**
     * @return string $roles
     */
    public function getRoles() {
        return $this->roles;
    }
    
    /**
     * @param string $roles
     * @return void
     */
    public function setRoles($roles) {
        $this->roles = $roles;
    }
    
    /**
     * @return string $office
     */
    public function getOffice() {
        return $this->office;
    }
    
    /**
     * @param string $office
     * @return void
     */
    public function setOffice($office) {
        $this->office = $office;
    }
    
    /**
     * @return string $employed
     */
    public function getEmployed() {
        return $this->employed;
    }
    
    /**
     * @param string $employed
     * @return void
     */
    public function setEmployed($employed) {
        $this->employed = $employed;
    }
    
    /**
     * @return string $salutation
     */
    public function getSalutation() {
        return $this->salutation;
    }
    
    /**
     * @param string $salutation
     * @return void
     */
    public function setSalutation($salutation) {
        $this->salutation = $salutation;
    }
    
    /**
     * @return string $consultation
     */
    public function getConsultation() {
        return $this->consultation;
    }
    
    /**
     * @param string $consultation
     * @return void
     */
    public function setConsultation($consultation) {
        $this->consultation = $consultation;
    }
    
    /**
     * @return string $mobil
     */
    public function getMobil() {
        return $this->mobil;
    }
    
    /**
     * @param string $mobil
     * @return void
     */
    public function setMobil($mobil) {
        $this->mobil = $mobil;
    }
    
    /**
     * @return string $profil
     */
    public function getProfil() {
        return $this->profil;
    }
    
    /**
     * @param string $profil
     * @return void
     */
    public function setProfil($profil) {
        $this->profil = $profil;
    }
    
    /**
     * @return string $imageref
     */
    public function getImageref() {
        return $this->imageref;
    }
    
    /**
     * @param string $imageref
     * @return void
     */
    public function setImageref($imageref) {
        $this->imageref = $imageref;
    }
    
    /**
     * @return string $educationalarea
     */
    public function getEducationalarea() {
        return $this->educationalarea;
    }
    
    /**
     * @param string $educationalarea
     * @return void
     */
    public function setEducationalarea($educationalarea) {
        $this->educationalarea = $educationalarea;
    }
    
}