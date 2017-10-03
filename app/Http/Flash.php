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
    public function success($message)
    {
        return $this->create($message, 'success');
    }

    public function create($message, $level, $key = 'flash_message')
    {
        return session()->flash($key, [
            'message' => $message,
            'level' => $level
        ]);
    }

    public function error($message)
    {
        return $this->create($message, 'error');
    }

    public function info($message)
    {
        return $this->create($message, 'info');
    }


}