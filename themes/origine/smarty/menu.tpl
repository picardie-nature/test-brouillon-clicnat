<div class="container">
	<div class="navbar navbar-default" role="navigation">
		<div id="banniere" class="hidden-xs">
			<div id="banniere2"></div>
		</div>
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="?page=accueil">Clicnat</a>
		</div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				{assign var=menu_section value=$section->menu()}
				<li class="active"><a href="{$url_base}{$menu_section.chemin}/index">Accueil</a></li>
				{foreach from=$menu_section.entrees item=lien}
					<li class="active"><a href="{$url_base}{$menu_section.chemin}/{$lien.chemin}">{$lien.titre}</a></li>
				{/foreach}
			</ul>
		</div>
	</div>
</div>
