<template>
  <div class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-white" style="border-radius: 1rem;">
            <div class="card-header p-3">
              <div class="d-flex justify-content-between">
                <div class="col-3 font-weight-bold h3">
                  Contatos
                </div>
                <div class="col-3 text-end">
                  <label>16 contatos</label>
                  <v-btn
                    class="accent--text"
                    elevation="2"
                  >
                    Novo
                  </v-btn>
                </div>
              </div>
            </div>
            <div class="input-group d-flex align-items-center">
              <font-awesome-icon icon="search" class="ms-3" />
              <input
                type="text"
                placeholder="Pesquisar"
                class="search_bar form-control bg-white border-0 py-3"
              >
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">An item</li>
              <li class="list-group-item">A second item</li>
              <li class="list-group-item">A third item</li>
              <li class="list-group-item">An item</li>
              <li class="list-group-item">A second item</li>
              <li class="list-group-item">A third item</li>
              <li class="list-group-item">An item</li>
              <li class="list-group-item">A second item</li>
              <li class="list-group-item">A third item</li>
            </ul>
            <div class="card-body">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style>
  body {
    background-color: #5B5FE9;
  }

  .card-header {
    color: #5B5FE9;
  }

  .search_bar:focus {
    border-color: inherit;
    -webkit-box-shadow: none;
    box-shadow: none;
  }
</style>
