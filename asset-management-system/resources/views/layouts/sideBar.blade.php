<aside id="sidebar">
	<div class="d-flex">
	   <button class="toggle-btn" type="button">
			 <i class="lni lni-grid-alt"></i>
	   </button>
	   <div class="sidebar-logo">
			 <a href="#">PDSCI-Asset</a>
	   </div>
	</div>
	<ul class="sidebar-nav">
	   <li class="sidebar-item">
			 <a href="{{ route('dashboard') }}" class="sidebar-link">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-collection" viewBox="0 0 16 16">
					<path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5z"/>
				  </svg>
				<span class="ms-3">Dashboard</span>
			 </a>
	   </li>
	   <li class="sidebar-item">
			<a href="" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
				data-bs-target="#library" aria-expanded="false" aria-controls="library">
				<i class="bi bi-book"></i>
				<span>Library</span>
			</a>
			<ul id="library" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
				<li class="sidebar-item"><a href="{{ route('library.brand') }}" class="sidebar-link">Brands</a></li>
				<li class="sidebar-item"><a href="{{ route('library.department' )}}" class="sidebar-link">Departments</a></li>
				<li class="sidebar-item"><a href="{{ route('library.supplier')}}" class="sidebar-link">Suppliers</a></li>
				<li class="sidebar-item"><a href="#" class="sidebar-link">Users</a></li>
		
			</ul>
	   </li>
	   <li class="sidebar-item">
			 <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
				data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
				<i class="lni lni-protection"></i>
				<span>Auth</span>
			 </a>
			 <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
				<li class="sidebar-item">
				   <a href="#" class="sidebar-link">Login</a>
				</li>
				<li class="sidebar-item">
				   <a href="#" class="sidebar-link">Register</a>
				</li>
			 </ul>
	   </li>
	   <li class="sidebar-item">
			 <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
				data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
				<i class="lni lni-layout"></i>
				<span>Multi Level</span>
			 </a>
			 <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
				<li class="sidebar-item">
				   <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
						 data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
						 Two Links
				   </a>
				   <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
						 <li class="sidebar-item">
							<a href="#" class="sidebar-link">Link 1</a>
						 </li>
						 <li class="sidebar-item">
							<a href="#" class="sidebar-link">Link 2</a>
						 </li>
				   </ul>
				</li>
			 </ul>
	   </li>
	   <li class="sidebar-item">
			 <a href="#" class="sidebar-link">
				<i class="lni lni-popup"></i>
				<span>Notification</span>
			 </a>
	   </li>
	   <li class="sidebar-item">
			 <a href="#" class="sidebar-link">
				<i class="lni lni-cog"></i>
				<span>Setting</span>
			 </a>
	   </li>
	</ul>
	<div class="sidebar-footer">
	   <a href="{{ route('logout') }}" class="sidebar-link">
			 <i class="lni lni-exit"></i>
			 <span>Logout</span>
	   </a>
	</div>
 </aside>