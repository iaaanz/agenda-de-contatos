<template>
  <v-app>
    <div class="vh-100 gradient-custom">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-white" style="border-radius: 1rem;">
              <div class="card-header p-3">
                <div class="d-flex justify-content-between">
                  <div class="row">
                    <div class="col">
                      <label class="font-weight-bold h2">Agenda</label>
                      <div class="clear-fix" />
                      <label>de contatos</label>
                    </div>
                    <div class="col-3 text-end">
                      <label>16 contatos</label>
                      <v-btn
                        color="red"
                        class="white--text mt-2"
                        elevation="2"
                        @click="showContactModal"
                      >
                        Novo
                      </v-btn>
                    </div>
                  </div>
                </div>
              </div>
              <div class="input-group align-items-center">
                <font-awesome-icon icon="search" class="ms-3" />
                <input
                  type="text"
                  placeholder="Pesquisar"
                  class="search_bar form-control bg-white border-0 py-3 m-0"
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
                <!-- <ContactVue /> -->
              </ul>
              <div class="card-body">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <ContactModal
      v-show="isContactModalVisible"
      @close="showContactModal"
    />
  </v-app>
</template>

<script>
import ContactModal from './components/Modal/Contact.vue'

export default {
  name: 'App',
  components: { ContactModal },
  data() {
    return {
      isContactModalVisible: true,
    };
  },
  methods: {
    showContactModal() {
      this.isContactModalVisible = !this.isContactModalVisible;
    },
  }
}
</script>

<style>
  .v-application {
    background: #5B5FE9 !important;
  }
  .list-group-flush {
    padding: 0px !important;
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
