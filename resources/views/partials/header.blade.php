<header class="navbar navbar-expand-md d-print-none" >
    <div class="container-xl">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
        <a href=".">
          <img src="/static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
        </a>
      </h1>
    </div>
  </header>
  <header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
      <div class="navbar">
        <div class="container-xl">
          <ul class="navbar-nav">
            <li class="nav-item {{ ($title === 'Home' ? 'active' : '') }}">
              <a class="nav-link " href="/" >
                <span class="nav-link-title">
                  Home
                </span>
              </a>
            </li>

            <li class="nav-item {{ ($title === 'About' ? 'active' : '') }}">
              <a class="nav-link " href="/about" >
                <span class="nav-link-title">
                  About
                </span>
              </a>
            </li>

            <li class="nav-item {{ ($title === 'Blog' ? 'active' : '') }}">
              <a class="nav-link " href="/blog" >
                <span class="nav-link-title">
                  Blog
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>