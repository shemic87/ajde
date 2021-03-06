<?php

class MainController extends Ajde_Controller
{
    public function beforeInvoke()
    {
        if (isset($_GET['_route']) && substr($_GET['_route'], 0, 5) == 'admin') {
            Ajde::app()->getDocument()->setLayout(new Ajde_Layout(config('layout.admin')));
        }

        return true;
    }

    public function code403()
    {
        Ajde::app()->getDocument()->setTitle(trans('Forbidden'));

        return $this->render();
    }

    public function code404()
    {
        Ajde::app()->getDocument()->setTitle(trans('Not Found'));

        return $this->render();
    }

    public function code500()
    {
        Ajde::app()->getDocument()->setTitle(trans('Internal Server Error'));

        return $this->render();
    }
}
