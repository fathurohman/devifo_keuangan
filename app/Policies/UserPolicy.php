<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function Transaksi(User $user)
    {
        return $this->getPermission($user, 1);
    }

    public function Transaksi_Order(User $user)
    {
        return $this->getPermission($user, 2);
    }

    public function Barang(User $user)
    {
        return $this->getPermission($user, 3);
    }

    public function Hak_Akses(User $user)
    {
        return $this->getPermission($user, 4);
    }

    public function Laporan_Offline(User $user)
    {
        return $this->getPermission($user, 5);
    }

    public function Report_lapoff(User $user)
    {
        return $this->getPermission($user, 6);
    }
    public function Report_TransaksiOrder(User $user)
    {
        return $this->getPermission($user, 7);
    }
    public function Bahan_Baku(User $user)
    {
        return $this->getPermission($user, 8);
    }
    // public function History_Sales_Data(User $user)
    // {
    //     return $this->getPermission($user, 8);
    // }
    // public function Pickup_Job(User $user)
    // {
    //     return $this->getPermission($user, 9);
    // }
    // public function Report_Profit(User $user)
    // {
    //     return $this->getPermission($user, 10);
    // }
    protected function getPermission($user, $p_id)
    {
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->id == $p_id) {
                    return true;
                }
            }
        }
        return false;
    }
}
