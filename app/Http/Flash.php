<?php
/**
 * Created by PhpStorm.
 * User: juliatzin
 * Date: 01/02/2016
 * Time: 13:46
 */

namespace App\Http;


class Flash
{
    public function create($title, $message, $level, $key = 'flash_message' )
    {
        session()->flash($key, [
            'title' => $title,
            'message' => $message,
            'level' => $level
        ]);
    }

    public function success($title, $message)
    {
        return $this->create($title, $message, 'success');
    }

    public function error($title, $message)
    {
        return $this->create($title, $message, 'error');
    }

    public function info($title, $message)
    {
        return $this->create($title, $message, 'info');
    }


}