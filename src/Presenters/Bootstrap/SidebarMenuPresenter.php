<?php

namespace Hechoenlaravel\JarvisMenus\Presenters\Bootstrap;

use Hechoenlaravel\JarvisMenus\Presenters\Presenter;

class SidebarMenuPresenter extends Presenter
{
    /**
     * Get open tag wrapper.
     *
     * @return string
     */
    public function getOpenTagWrapper()
    {
        return PHP_EOL . '<ul class="sidebar-menu">' . PHP_EOL;
    }

    /**
     * Get close tag wrapper.
     *
     * @return string
     */
    public function getCloseTagWrapper()
    {
        return '</ul>';
    }

    /**
     * Get menu tag without dropdown wrapper.
     *
     * @param \Hechoenlaravel\JarvisMenus\MenuItem $item
     *
     * @return string
     */
    public function getMenuWithoutDropdownWrapper($item)
    {
        return '<li'.$this->getActiveState($item).'><a href="'.$item->getUrl().'" '.$item->getAttributes().'>'.$item->getIcon().' <span>'.$item->title.'</span></a></li>'.PHP_EOL;
    }

    /**
     * {@inheritdoc }.
     */
    public function getActiveState($item, $state = ' class="active"')
    {
        return $item->isActive() ? $state : null;
    }

    /**
     * Get active state on child items.
     *
     * @param $item
     * @param string $state
     *
     * @return null|string
     */
    public function getActiveStateOnChild($item, $state = 'active')
    {
        return $item->hasActiveOnChild() ? $state : null;
    }

    /**
     * {@inheritdoc }.
     */
    public function getDividerWrapper()
    {
        return '<li class="divider"></li>';
    }

    /**
     * {@inheritdoc }.
     */
    public function getHeaderWrapper($item)
    {
        return '<li class="dropdown-header">'.$item->title.'</li>';
    }

    /**
     * {@inheritdoc }.
     */
    public function getMenuWithDropDownWrapper($item)
    {
        return '
      		<li class="treeview' . $this->getActiveStateOnChild($item, ' active') . '">
                <a href="#">
                    ' . $item->getIcon() . '
                    <span>' . $item->title . '</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    ' . $this->getChildMenuItems($item) . '
                </ul>
            </li>';
    }

    /**
     * Get multilevel menu wrapper.
     *
     * @param \Hechoenlaravel\JarvisMenus\MenuItem $item
     *
     * @return string`
     */
    public function getMultiLevelDropdownWrapper($item)
    {
        return '<li class="'.$this->getActiveStateOnChild($item, ' active').'">
		          <a href="#">
					'.$item->getIcon().' '.$item->title.'
			      	<i class="fa fa-angle-left pull-right"></i>
			      </a>
			      <ul class="treeview-menu">
			      	'.$this->getChildMenuItems($item).'
			      </ul>
		      	</li>'
        .PHP_EOL;
    }
}
