<?php

class AdminCmsController extends AdminController
{
    /**
     * Default action for controller, returns the 'view.phtml' template body.
     *
     * @return string
     */
    public function view()
    {
        Ajde::app()->getDocument()->setTitle('CMS');

        return $this->render();
    }

    public function menu()
    {
        return $this->render();
    }

    public function nav()
    {
        return $this->render();
    }

    public function settingsmenu()
    {
        $settings = new SettingCollection();

        $this->getView()->assign('settings', $settings);

        return $this->render();
    }

    public function navJson()
    {
        $recursive = true;
        $parent = Ajde::app()->getRequest()->getInt('node', false);

        $nodes = new NodeCollection();
        $nodes->addFilter(new Ajde_Filter_Where('level', Ajde_Filter::FILTER_EQUALS, 0));

        if ($recursive) {
            $nodes->orderBy('sort');

            $json = [];
            foreach ($nodes as $node) {
                /* @var $node NodeModel */

                $nodeArray = [
                    'label' => $this->navLabel($node),
                    'id'    => $node->getPK(),
                ];

                $children = $node->getChildren();
                if ($children->count()) {
                    $nodeArray['children'] = $this->navChildrenArray($children);
                }

                $json[] = $nodeArray;
            }

            return $json;
        } else {
            if ($parent) {
                $nodes->addFilter(new Ajde_Filter_Where('parent', Ajde_Filter::FILTER_EQUALS, $parent));
            } else {
                $nodes->addFilter(new Ajde_Filter_Where('level', Ajde_Filter::FILTER_EQUALS, 0));
            }
            $nodes->getQuery()->addSelect('id AS aid');
            $nodes->getQuery()->addSelect('(SELECT count(b.id) FROM node b WHERE b.parent = aid) AS children');
            $nodes->orderBy('sort');

            $json = [];
            foreach ($nodes as $node) {
                /* @var $node NodeModel */
                $children = $node->get('children');
                $json[] = [
                    'label'          => $this->navLabel($node),
                    'id'             => $node->getPK(),
                    'load_on_demand' => $children ? true : false,
                ];
            }

            return $json;
        }
    }

    private function navLabel($node)
    {
        $nodetype = $node->has('nodetype_name') ? $node->get('nodetype_name') : $node->getNodetype()->displayField();
        $icon = $node->has('nodetype_icon') ? $node->get('nodetype_icon') : $node->getNodetype()->getIcon();
        $label = '<span class="badge-icon" title="'.esc($nodetype).'"><i class="'.$icon.'"></i></span>';

        return $label.' <span class="title">'.clean($node->getTitle()).'</span>';
    }

    private function navChildrenArray($collection)
    {
        $childrenArray = [];

        foreach ($collection as $node) {
            /* @var $node NodeModel */

            $nodeArray = [
                'label' => $this->navLabel($node),
                'id'    => $node->getPK(),
            ];

            $children = $node->getChildren();
            if ($children->count()) {
                $nodeArray['children'] = $this->navChildrenArray($children);
            }

            $childrenArray[] = $nodeArray;
        }

        return $childrenArray;
    }

    public function setupmenu()
    {
        return $this->render();
    }

    public function nodes()
    {
        Ajde::app()->getDocument()->setTitle('Nodes');

        return $this->render();
    }

    public function media()
    {
        Ajde::app()->getDocument()->setTitle('Media');

        return $this->render();
    }

    public function menus()
    {
        Ajde::app()->getDocument()->setTitle('Menus');

        return $this->render();
    }

    public function tags()
    {
        Ajde::app()->getDocument()->setTitle('Tags');

        return $this->render();
    }

    public function settings()
    {
        Ajde::app()->getDocument()->setTitle('Settings');

        $decorator = new Ajde_Crud_Cms_Meta_Decorator();
        $this->getView()->assign('decorator', $decorator);

        return $this->render();
    }
}
