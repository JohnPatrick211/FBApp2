<ul class="sidebar-menu">
    
    <li>
        <a href="{{ url('/dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
 

    <li class="treeview">
        <a href="#">
            <i class="fa fa-bar-chart-o"></i>
            <span>Transaction <span class="badge badge-success">12</span></span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-truck"></i>
                    <span>Delivery</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    {{--<li><a href="{{ url('delivery/pending') }}"><i class="fa fa-angle-double-right"></i> Pending 
                        <span class="badge badge-success">12</span></a></li>
                    <li><a href="{{ url('delivery/preparing') }}"><i class="fa fa-angle-double-right"></i> Preparing 
                        <span class="badge badge-success">12</span></a></li>--}}
                    <li><a href="{{ url('delivery/dispatch') }}"><i class="fa fa-angle-double-right"></i> Dispatch 
                        <span class="badge badge-success">12</span></a></li>
                    <li><a href="{{ url('delivery/delivered') }}"><i class="fa  fa-angle-double-right"></i> Delivered</a></li>
                    <li><a href="{{ url('delivery/cancelled') }}"><i class="fa fa-angle-double-right"></i> Cancelled</a></li>
                </ul>
            </li>
        </ul>
    </li>
</ul>