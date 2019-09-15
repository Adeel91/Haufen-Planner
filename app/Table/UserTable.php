<?php

namespace App\Table;

class UserTable extends Table
{
    protected $i = 1;

    protected $primaryKey = 'name';

    protected $columns = [
        'name' => 'User Name',
        'email' => 'Email',
        'login_days' => 'Logins (in last 30 days)',
        'last_login' => 'Last Login Date'
    ];

    public function getColumnValue($column, $user)
    {
        $data = '';

        switch ($column) {
            case 'email':
                $data = '<a href="mailto:'.$user->email.'">'.$user->email.'</a>';
                break;

            case 'login_days':
                $data = '<span class="user-label members-initial is_'. $this->i . '">'. $user->login_days .'<span>';

                $this->i++;

                if ($this->i > 6) {
                    $this->i = 1;
                }

                break;

            case 'last_login':
                $userLoginAt = ($user->last_login_at) ? $user->last_login_at : 'N/A';
                $data = '<span class="user-label members-initial is_'. $this->i . '">'. $userLoginAt .'<span>';

                $this->i++;

                if ($this->i > 6) {
                    $this->i = 1;
                }

                break;
            
            default:
                $data = $this->defaultColumnValue($column, $user);
                break;
        }

        return $data;
    }

    public function generateQuickActionLinks($user)
    {
        return [
            'edit' => [
                'title' => 'Edit',
                'link' => route('users.edit', $user->id)
            ],
            'delete' => [
                'title' => 'Delete',
                'link' => route('users.destroy', $user->id)
            ]
        ];
    }
}
