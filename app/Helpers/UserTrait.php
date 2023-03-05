<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

trait UserTrait
{

    private $currentUser;

    /**
     * @return mixed
     */
    public function getCurrentUser()
    {
        return $this->currentUser = Auth::user();
    }

    /**
     * @param mixed $currentUser
     */
    public function setCurrentUser($currentUser): void
    {
        $this->currentUser = $currentUser;
    }

    /**
     * @return mixed
     */
    public function getCurrentUserID($isTesting = false)
    {
        if ($isTesting) {
            return 1;
        }

        $this->getCurrentUser();
        return ($this->currentUser) ? $this->currentUser->id : null;
    }

    /**
     * @return mixed
     */
    public function getCurrentUserFirstName()
    {
        $this->getCurrentUser();
        return ($this->currentUser) ? $this->currentUser->first_name : null;
    }

    /**
     * @return mixed
     */
    public function getCurrentUserLastName()
    {
        $this->getCurrentUser();
        return ($this->currentUser) ? $this->currentUser->last_name : null;
    }

    /**
     * @return mixed
     */
    public function getCurrentUserFullName()
    {
        $this->getCurrentUser();
        return ($this->currentUser) ? trim($this->currentUser->first_name . ' ' . $this->currentUser->last_name) : null;
    }

    /**
     * @return mixed
     */
    public function getCurrentUserEmail()
    {
        $this->getCurrentUser();
        return ($this->currentUser) ? $this->currentUser->email : null;
    }

    /**
     * @return mixed
     */
    public function getCurrentUserTenantID()
    {
        $this->getCurrentUser();
        return ($this->currentUser) ? $this->currentUser->tenant_id : null;
    }

    /**
     * @return mixed
     */
    public function getCurrentUserRole()
    {
        $this->getCurrentUser();
        return ($this->currentUser) ? $this->currentUser->role : null;
    }

    /**
     * @return mixed
     */
    public function getTenantSlug()
    {
        $this->getCurrentUser();
        return ($this->currentUser) ? $this->currentUser->tenant()->slug : null;
    }

    /**
     * @return mixed
     */
    public function getCurrentUserAssetDir()
    {
        $this->getCurrentUser();
        return ($this->currentUser) ? $this->currentUser->asset_dir_name : null;
    }

    public function isUserLoggedIn()
    {
        $this->getCurrentUser();
        return ($this->currentUser) ? ture : false;
    }

}
