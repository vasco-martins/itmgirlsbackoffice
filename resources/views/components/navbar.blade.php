<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <h4 class="m-0">ITM Girls</h4>
    </div>
    <ul class="c-sidebar-nav">
        <x-navitem title="Artigos" :route="route('articles.index')" title="Artigos" activeRoute="articles/*" single />
	
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
