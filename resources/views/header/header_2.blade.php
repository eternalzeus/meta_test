<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <form action="/logout" method="POST">
            @csrf
            <button class="btn btn-danger ">Log out</button>
        </form>
        <div class="collapse navbar-collapse" id="navbarText">
        </div>
    </div>
  </nav>