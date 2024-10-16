

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse{{$name}}"
       aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>{{$title}}</span>
    </a>
    <div id="collapse{{$name}}" class="collapse {{ activeSidebar($name, $include ?? []) ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{activeMenu('admin.'. $name .'.index') ? 'active' : ''}}" href="{{route('admin.'. $name .'.index')}}">List {{$name}}</a>
            <a class="collapse-item {{activeMenu('admin.'. $name .'.create') ? 'active' : ''}}" href="{{route('admin.'. $name .'.create')}}">Create</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
