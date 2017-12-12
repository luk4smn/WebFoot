<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
  <a class="navbar-brand" href="/">WebFoot
    <i class="fa fa-fw fa-soccer-ball-o"></i>
  </a>

  @if(auth()->user()->time_id)
    <div align="left">
      <a class="navbar-brand" href="#" id="toggleNavColor"><img
                src="{{ URL::asset(auth()->user()->time->escudo) }}" alt="">  {{auth()->user()->time->nome}}
      </a>
    </div>
  @endif

  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="/">
          <i class="fa fa-fw fa-home"></i>
          <span class="nav-link-text">Inicio</span>
        </a>
      </li>

      @if(auth()->user()->time_id)
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-area-chart"></i>
          <span class="nav-link-text">Meu Time</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseMulti">
          <li>
            <a href="/jogadores"><i class="fa fa-fw fa-user-circle"></i><span class="nav-link-text">Jogadores</span></a>
          </li>
          <li>
            <a href="/estadio"><i class="fa fa-bank"></i><span class="nav-link-text">Estádio</span></a>
          </li>
          <li>
            <a href="/ballance"><i class="fa fa-fw fa-bar-chart"></i><span class="nav-link-text">Ballance</span></a>
          </li>
        </ul>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
        <a class="nav-link" href="tables.html">
          <i class="fa fa-fw fa-table"></i>
          <span class="nav-link-text">Calendário</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
        <a class="nav-link" href="charts.html">
          <i class="fa fa-fw fa-sitemap"></i>
          <span class="nav-link-text">Classificação</span>
        </a>
      </li>
      @endif

    </ul>
    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
          <i class="fa fa-fw fa-sign-out"></i>Logout</a>
      </li>
    </ul>
  </div>
</nav>