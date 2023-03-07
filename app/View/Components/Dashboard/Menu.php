<?php

namespace App\View\Components\Dashboard;

use App\Core\Tree;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $tree = Tree::create();

        foreach (config('admin.menu') as $item) {
            if($item['route'] && !Gate::forUser(Auth::user())->check($item["route"])){
                continue;
            }
            $tree->add($item, 'menu');
        }
        $tree->items = core()->sortItems($tree->items);

        return view('components.dashboard.menu')->with("menu", $tree);
    }

}
