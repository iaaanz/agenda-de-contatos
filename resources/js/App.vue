<template>
  <div>
    <notifications group="contact-notification" classes="custom-notification" />
    <v-app>
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
                    <div class="col-4 text-end">
                      <label>{{ contacts.length }} contatos</label>
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
              <ContactList
                :contacts="contacts"
                @editContact="editContactModal"
                @fetchContacts="fetchContacts"
              />
              <div class="card-body">
              </div>
            </div>
          </div>
        </div>
      </div>
      <Contact
        v-if="isContactVisible"
        :contact-id="contactId"
        @close="showContactModal"
        @fetchContacts="fetchContacts"
      >
      </Contact>
    </v-app>
  </div>
</template>

<script>
import Contact from './components/Modal/Contact.vue'
import ContactList from './components/ContactList.vue'

export default {
  name: 'App',
  components: { Contact, ContactList },
  data() {
    return {
      isContactVisible: false,
      isEditContact: false,
      contactId: null,
      contacts: []
    };
  },
  created() {
    this.fetchContacts();
  },
  methods: {
    showContactModal() {
      this.isContactVisible = !this.isContactVisible;
      this.contactId = null;
    },
    editContactModal(id) {
      this.showContactModal();
      this.contactId = id;
    },
    async fetchContacts() {
      await this.axios.get('/api/agenda')
        .then(res => {
          if (res.status === 200) {
            this.contacts = res.data;
          } else {
            this.$notify({
              group: 'contact-notification',
              type: 'error',
              title: 'Erro',
              text: 'Ops! Não foi possível obter os contatos, tente novamente mais tarde.',
            });
          }
        })
        .catch(() => {
          this.$notify({
            group: 'contact-notification',
            type: 'error',
            title: 'Erro',
            text: 'Ops! Não foi possível obter os contatos, tente novamente mais tarde.',
          });
        })
    }
  }
}
</script>

<style>

  .custom-notification {
    margin: 0 5px 5px;
    padding: 10px;
    font-size: 13px;
    background-color: #ffffff !important;
  }

  .custom-notification.success {
    margin-top: 10px;
    border-left: 10px solid #171b92;
    border-radius: 5px 0 0 5px;
  }

  .custom-notification.error {
    margin-top: 10px;
    border-left: 10px solid red;
    border-radius: 5px 0 0 5px;
  }

  .custom-notification.success > .notification-title {
    color: #171b92;
  }

  .custom-notification.error > .notification-title {
   color: red;
  }

  .v-application {
    background: #5B5FE9 !important;
  }
  .list-group-flush {
    padding: 0px !important;
  }

  .card-header {
    color: #5B5FE9;
  }

  .no-uppercase {
    text-transform: none;
  }

  .search_bar:focus {
    border-color: inherit;
    -webkit-box-shadow: none;
    box-shadow: none;
  }
</style>
