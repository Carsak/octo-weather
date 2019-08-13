<?php

namespace App;

class Main
{
    private $presenter;

    public function run()
    {
        session_start();

        $save = $_GET['save'] ?? '';

        if (!empty($_GET['city'])) {
            $city             = $_GET['city'];
            $_SESSION['city'] = $city;
        } elseif (!empty($_SESSION['city'])) {
            $city = $_SESSION['city'];
        } else {
            $city = '';
        }

        $this->presenter = new \App\Presenter(new \App\Parser($city));

        // TODO создать фабрику
        if (!empty($save)) {
            if ($save == 'json') {
                $file = new \App\File\JsonFile();
                $file->save(new \App\Parser($city));
            }

            if ($save == 'xml') {
                $file = new \App\File\XmlFile();
                $file->save(new \App\Parser($city));
            }
        }
    }

    /**
     * @return \App\Presenter
     */
    public function getPresenter()
    {
        return $this->presenter;
    }
}