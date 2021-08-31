<template>
  <div>
    <div class="input-group align-items-center">
      <font-awesome-icon icon="search" class="ms-3" />
      <input
        v-model="search"
        type="text"
        placeholder="Pesquisar"
        class="search_bar form-control bg-white border-0 py-3 m-0"
      >
    </div>
    <v-list>
      <v-col
        v-if="contactsList <= 0"
        class="v-empty-list d-flex
        justify-content-center align-center"
      >
        Nenhum contato encontrado :(
      </v-col>
      <div v-for="contact in contactsList" :key="contact.id">
        <v-list-item two-line>
          <v-list-item-avatar size="50" class="pointer" @click="editContact(contact.id)">
            <v-img :src="contact.img_path || defaultImgUrl" />
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title
              class="d-flex justify-content-between align-items-center"
            >
              <v-col
                class="text-truncate pointer"
                @click="editContact(contact.id)"
                v-text="contact.name"
              />
              <div class="contact-icons">
                <v-btn
                  fab
                  small
                  elevation="0"
                  color="primary"
                  @click="editContact(contact.id)"
                >
                  <font-awesome-icon icon="edit" class="text-white" size="lg" />
                </v-btn>
                <v-btn
                  fab
                  small
                  elevation="0"
                  color="red"
                  @click="showDelete(contact.id)"
                >
                  <font-awesome-icon icon="trash" class="text-white" size="lg" />
                </v-btn>
              </div>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </div>
    </v-list>
    <DeleteModal
      v-model="isDeleteVisible"
      :contact="delContact"
      @close="showDelete"
      @contactDeleted="$emit('fetchContacts')"
    />
  </div>
</template>

<script>
import DeleteModal from './Modal/Delete.vue'

export default {
  name: 'ContactList',
  components: { DeleteModal },
  props: {
    contacts: {
      type: Array,
      default: null
    },
  },
  data() {
    return {
      defaultImgUrl: 'img/default_user.png',
      isDeleteVisible: false,
      delContact: null,
      search: '',
    }
  },
  computed: {
    contactsList() {
      if (this.search) {
        return this.contacts.filter(
          contact => contact.name.toLowerCase().includes(this.search.toLowerCase())
        )
      }
      return this.contacts;
    },
  },
  methods: {
    editContact(id) {
      this.$emit('editContact', id);
    },
    showDelete(id) {
      this.isDeleteVisible = !this.isDeleteVisible;
      this.delContact = id;
    },
  }
}
</script>

<style>
.v-list{
  height: 55vh;
  overflow-y: auto;
}

.v-list-item:hover {
  background-color: rgb(228, 228, 228) !important;
}

.pointer {
  cursor: pointer;
}

.v-empty-list {
  height: 50vh;
  overflow-y: auto;
  color: rgb(104, 97, 97)
}
</style>
