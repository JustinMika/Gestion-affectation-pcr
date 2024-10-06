<aside id="sidebar"
	   class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64- h-full pt-16 font-normal duration-75 lg:flex transition-width"
	   aria-label="Sidebar" style="width:16rem!important">
	<div
			class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
		<div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto sidebar">
			<div
					class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700 sidebar"
					id="sidebar">
				<ul class="pb-2 space-y-2">
					@if (!empty(Auth::user()->hasRole) && Auth::user()->hasRole->name === "Administrateur")
						{{--Admin--}}
						@include('partials.sidebar_by_access.admin-sidebar')
					@endif

					@if (!empty(Auth::user()->hasRole) && Auth::user()->hasRole->name === "agent")
						{{--CP--}}
						@include('partials.sidebar_by_access.agent-pcr')
					@endif

					{{--Common for all user--}}
					<hr class="bg-white"/>
					{{-- Profil -- Logs des utilisateurs --}}
					<div class="pt-2 space-y-2 _hidden">
						<a href="{{ url("Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY/administration/profil-user") }}"
						   class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
							<svg
									class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
									aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
									fill="currentColor" viewBox="0 0 24 24">
								<path fill-rule="evenodd"
									  d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
									  clip-rule="evenodd"/>
							</svg>
							<span class="ml-3" sidebar-toggle-item>Profil</span>
						</a>
						<a href="{{ url("Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY/administration/log-users") }}"
						   class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
							<svg
									class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
									fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
								<path
										d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
								</path>
							</svg>
							<span class="ml-3" sidebar-toggle-item>Journal d'activité</span>
						</a>
						<a href="{{ url("Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY/administration/log-out") }}"
						   class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
							<svg
									class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
									fill="none" stroke="currentColor" viewBox="0 0 24 24"
									xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
								</path>
							</svg>
							<span class="ml-3" sidebar-toggle-item>Logout</span>
						</a>
					</div>
				</ul>
			</div>
		</div>

		<div
				class="absolute bottom-0 left-0 justify-center hidden w-full p-4 space-x-4 bg-white lg:flex dark:bg-gray-800"
				sidebar-bottom-menu>
			<a href="#"
			   data-tooltip-target="messagerie_interne"
			   class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
				<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
					 fill="currentColor" viewBox="0 0 24 24">
					<path fill-rule="evenodd"
						  d="M4 3a1 1 0 0 0-1 1v8c0 .6.4 1 1 1h1v2a1 1 0 0 0 1.7.7L9.4 13H15c.6 0 1-.4 1-1V4c0-.6-.4-1-1-1H4Z"
						  clip-rule="evenodd"/>
					<path fill-rule="evenodd"
						  d="M8 17.2h.1l2.1-2.2H15a3 3 0 0 0 3-3V8h2c.6 0 1 .4 1 1v8c0 .6-.4 1-1 1h-1v2a1 1 0 0 1-1.7.7L14.6 18H9a1 1 0 0 1-1-.8Z"
						  clip-rule="evenodd"/>
				</svg>
			</a>

			<a href="#"
			   data-tooltip-target="tooltip-settings"
			   class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
				<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
					 fill="none" viewBox="0 0 24 24">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						  d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1H7a1 1 0 0 1-1-1v-7c0-.6.4-1 1-1Z"/>
				</svg>
			</a>

			<a href="#" data-tooltip-target="profil"
			   class=" inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
				<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
					 fill="none" viewBox="0 0 24 24">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						  d="M21 13v-2a1 1 0 0 0-1-1h-.8l-.7-1.7.6-.5a1 1 0 0 0 0-1.5L17.7 5a1 1 0 0 0-1.5 0l-.5.6-1.7-.7V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.8l-1.7.7-.5-.6a1 1 0 0 0-1.5 0L5 6.3a1 1 0 0 0 0 1.5l.6.5-.7 1.7H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.8l.7 1.7-.6.5a1 1 0 0 0 0 1.5L6.3 19a1 1 0 0 0 1.5 0l.5-.6 1.7.7v.8a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.8l1.7-.7.5.6a1 1 0 0 0 1.5 0l1.4-1.4a1 1 0 0 0 0-1.5l-.6-.5.7-1.7h.8a1 1 0 0 0 1-1Z"/>
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						  d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
				</svg>
			</a>
			<div id="messagerie_interne" role=" tooltip"
				 class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
				Messagerie interne
				<div class="tooltip-arrow" data-popper-arrow></div>
			</div>

			<div id="tooltip-settings" role="tooltip"
				 class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
				logout | deconnexion
				<div class="tooltip-arrow" data-popper-arrow></div>
			</div>

			<div id="profil" role="tooltip"
				 class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
				Profil
				<div class="tooltip-arrow" data-popper-arrow></div>
			</div>
		</div>
	</div>
</aside>

<div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>
