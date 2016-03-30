<header class="top-nav">
	<nav>
	    <ul>
	        <li {{ Request::is('admin/dashboard') ? 'class=active' : '' }}><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
	     	<li {{ Request::is('admin/blog/posts') ? 'class=active' : '' }}><a href="{{ route('admin.blog.index') }}">Posts</a></li>
	     	<li {{ Request::is('admin/blog/categories') || Request::is('admin/blog/category') ? 'class=active' : '' }}><a href="{{ route('admin.blog.category') }}">Categories</a></li>
	     	<li {{ Request::is('admin/contact') ? 'class=active' : '' }}><a href="{{ route('admin.contact.index') }}">Contact Messages</a></li>
	     	<li><a href="{{ route('admin.logout') }}">Logout</a></li>
	     	<li><a href="{{ route('blog.index') }}">Front</a></li>
	    </ul>
	</nav>
</header>